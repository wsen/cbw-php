<?php

/**
*	@file
*	Listet und importiert existierende Daten aus der TDVHD App in tvDigital (Drupal CMS),
*	Texte, Bilder u. Bilderstrecken + Kategoriezuweisung
*	http://tvdhdcms.tvdigital.de -> edit.tvdigital.de
*	DB: hzndb1-app - tvdhd_app_cms
*
*	Aufruf:
*	edit.tvdigital.de/external_cms/list/YYYY-MM-DD  //Listet alle TVDHD Einträge ab Datum
*	edit.tvdigital.de/external_cms/list/1111  		//Listet Content 1111 mit Details
*	edit.tvdigital.de/external_cms/1111	  			//Importiert Content 1111
*	edit.tvdigital.de/external_cms/1111/1120  		//Importiert Content 1111 bis 1120 (Bulk Import), !! Auf 20 limitiert wg. ev. Server TimeOut !!
*/


/**
 * Implements hook_menu().
 */

setlocale(LC_TIME, "de_DE");  	//für start_datum

function external_cms_menu() {
  $items['external_cms'] = array(
    'title' => t('External CMS'),
    'page callback' => 'external_cms',
    'access arguments' => array('access content'),
    'type' => MENU_CALLBACK,
    //'access callback' => TRUE,
  );

  $items['external_cms/list'] = array(
    'title' => t('External CMS Content List'),
    'page callback' => 'external_cms_list',
    'access arguments' => array('access content'),
    'type' => MENU_CALLBACK,
    //'access callback' => TRUE,
  );

  return $items;
}

/* ---------- LIST APP CONTENT ------------*/
function external_cms_list($arg1 = NULL) {
	$pattern_dat = '/^[0-9]{4}-(0[1-9]|1[0-2])-(0[1-9]|[1-2][0-9]|3[0-1])$/';
	$pattern_id = '/^[1-9]+[0-9]*$/';

 	echo '-- Listing TVD-App Content ---<br>';

 	if (!empty($arg1) && preg_match($pattern_dat,$arg1)) {
 		$idfile = "/tmp/.tvdhd-app_lastimport";
		$fh = @fopen($idfile, "r");
		if ($fh) {
			while (($buffer = fgets($fh, 4096)) !== false) {
				echo "Letzter Import: <strong>$buffer</strong><br>";
			}
			if (!feof($fh))  echo "Fehler: unerwarteter fgets() Fehlschlag\n";
			fclose($fh);
		}
		$db_values = from_external_db('appcms_entertainment_guide','start_date',"'".$arg1."'","'3000-12-31'",'start_date','multi');
 		_list_ext_data($db_values,'list');
 	} else if (!empty($arg1) && $arg1 > 0  && (preg_match($pattern_id,$arg1))) {
 		$db_values = from_external_db('appcms_entertainment_guide','id',$arg1,NULL,NULL,'single');
 		_list_ext_data($db_values,'item');
 	} else {
 		echo "Eingabe Datum: /2000-12-31 oder id: /11 am Ende der URL" ;
 	}
}

function _list_ext_data($dr,$mode){
	/* APP-TVDHD
	"id","title","category","start_date","detail_gallery_teaser","homepage_teaser_text",
	"detail_story","detail_background","detail_critics","detail_fazit","meta_year",
	"meta_country","meta_original_title","actor_data","crew_data","meta_runtime",
	"technical_data","detail_cover"*/

	/* tvdigital.de
	content_field_magazin_caption: "Bilder: © Paramount"
	*/

	if (isset($dr)){
		foreach ($dr as $key => $val) {
			//--- Schreibe neue Nodes mit folgenden Inhalten ---
			foreach ($dr["$key"] as $keey => $vaal) {
				//echo "keey: $keey ---- vaal: $vaal<br>";
				switch ($keey) {
					case "id":
						$id = $vaal;
						break;
					case "title":
						$title	= $vaal;
						break;
					case "category":
						$category = $vaal;
						break;
					case "start_date":  //2014-07-10 -> 10. Juli 2014
						$start_date  =  $vaal;
						if($start_date) $start_datum = strftime("%d. %B %Y", strtotime($start_date));
						break;
					case "detail_story":
						$body_app_story  =  $vaal;
						break;
					case "detail_background":
						$body_app_background  =  $vaal;
						break;
					case "detail_critics":
						$body_app_critics  =  $vaal;
						break;
					case "detail_fazit":
						$body_app_fazit  =  $vaal;
						break;
					case "meta_year":
						$body_app_year  =  $vaal.";";
						break;
					case "meta_country":
						$body_app_country  =  "<strong>$vaal</strong>";
						break;
					case "homepage_teaser_text":
						$body_app_teasertext =  $vaal;
						break;
					case "meta_original_title":
						$body_app_meta_original_title  =  $vaal;
						if($body_app_meta_original_title) $body_app_meta_original_title = "<strong>OT</strong> $body_app_meta_original_title;";
						break;
					case "actor_data":
						$body_app_actor_data  =  $vaal;
						if($body_app_actor_data) $body_app_show_actors = "<strong>D </strong> ".crack_str2array($body_app_actor_data,3).";";
						//"<strong>D </strong> "
						break;
					case "crew_data":
						$body_app_crew_data  =  $vaal;
						if($body_app_crew_data) $body_app_show_crew = crack_str2array_selected($body_app_crew_data,10,"Regie|Drehbuch|Kamera|Musik|Produzent|Schnitt|Maske|Effekte");
						break;
					case "meta_runtime":
						$body_app_meta_runtime  =  $vaal;
						if($body_app_meta_runtime) $body_app_show_runtime = $body_app_meta_runtime." Min.";
						break;
					case "technical_data":
						$body_app_technical_data  =  $vaal;
						if($body_app_technical_data) $body_app_show_fsk = "<strong>FSK </strong> ".crack_str2array_lastitem($body_app_technical_data).";";
						break;
					case "detail_cover":
						$body_app_detail_cover  =  $vaal;
						break;
				}
			}
			if($mode == 'item') {
				echo '<p>id: <strong>'.$id.'</strong>  >'.$start_datum.'<  Kategorie: <strong>'.$category.'</strong> <h2>'.$title.'</h2>
				</p>'.
					$body_app_teasertext
				.'<h2>Story:</h2> <strong>'.$body_app_story.'</strong>
				<h2>Hintergrund:</h2>
				'.$body_app_background.'
				<h2>Kritik:</h2>
				'.$body_app_critics.'
				<h2>Fazit:</h2>
				'.$body_app_fazit.'
				<p>'.$body_app_country.' '.$body_app_year.' '.$body_app_meta_original_title.' '.$body_app_show_actors.' '.$body_app_show_crew .' '.$body_app_show_fsk.' '.$body_app_show_runtime.'
				</p>
				<hr style=\"margin: 2em 0 1em\"/>
				<a href="/external_cms/'.$id.'" target="_self">import</a>
								';
			} else if ($mode == 'list') {
				echo 'id: <strong>'.$id.'</strong>  > '.$start_datum.' -- <a href="/external_cms/list/'.$id.'" target="_blank">see</a> -- <a href="/external_cms/'.$id.'" target="_blank">import</a> -- <strong> '.preg_replace('/(<br \/>)|(<br>)/',' ',$title).'</strong> ('.$category.') <br>';
			}
 		}
	}
}
/* --- END LIST CONTENT ----*/

/* ---------- IMPORT APP CONTENT ------------*/
function picture($app_img_id) {
	$db_values = from_external_db('appcms_files','id',$app_img_id,NULL,NULL,'single');
	$file_path = $db_values[0]["path"];
	$from_adr 	= '/www/htdocs/tvdhdcms.tvdigital.de/web'.$file_path;

	return $from_adr;
}

/* Für alle {""} Einträge in DB */
function convert_doublequotes ($expr){
	$converted = preg_replace('/"/', "\'\'", $expr);
	return $converted;
}

//UTF-8 Zeichen dekodieren
//IN: unicode -> OUT: latin
function _unicode2latin1($raw){
	$patterns = array(); $replacements = array();
	$patterns[0] = '/u00c4/';	$replacements[0] = 'Ä';
	$patterns[1] = '/u00d6/';	$replacements[1] = 'Ö';
	$patterns[2] = '/u00dc/';	$replacements[2] = 'Ü';
	$patterns[3] = '/u00e4/';	$replacements[3] = 'ä';
	$patterns[4] = '/u00f6/';	$replacements[4] = 'ö';
	$patterns[5] = '/u00fc/';	$replacements[5] = 'ü';
	$patterns[6] = '/u2019/';	$replacements[6] = "'";
	$patterns[7] = '/u201e/';	$replacements[7] = '"';
	$patterns[8] = '/u201c/';	$replacements[8] = '"';
	$patterns[9] = '/u00e9/';	$replacements[9] = 'é';
	$patterns[10] = '/u00f3/';	$replacements[10] = 'ó';
	$patterns[11] = '/u00f0/';	$replacements[11] = 'ð';
	$patterns[12] = '/u00ef/';	$replacements[12] = 'ï';
	$patterns[13] = '/u00c9/';	$replacements[13] = 'É';
	$patterns[14] = '/u00e2/';	$replacements[14] = 'â';
	$patterns[15] = '/u00e1/';	$replacements[15] = 'á';
	$patterns[16] = '/u00e3/';	$replacements[16] = 'ã';
	$patterns[17] = '/u00e7/';	$replacements[17] = 'ç';
	$patterns[18] = '/u00f1/';	$replacements[18] = 'ñ';
	$patterns[19] = '/u00fa/';	$replacements[19] = 'ú';
	$patterns[20] = '/u00e6/';	$replacements[20] = 'æ';
	$patterns[21] = '/u00f8/';	$replacements[21] = 'ø';

	$latin = preg_replace($patterns, $replacements, $raw);
	return stripslashes($latin);
}

//Actor Data
function crack_str2array($raw,$amount) {
	// Treats: ["T.S. Spivet|Kyle Catlett ","T.S.\u2019 Mutter|Helena Bonham Carter"] extracting an amount of 2nd names
	$rest = substr($raw, 1, -1);
	$nochmehrrest = explode(",",$rest);
	$l = 0;
	$uebrig = "";
	foreach ($nochmehrrest as $key => $wal) {
		if($l <= $amount) $uebrig .= substr(strstr($wal, '|'),1,-1).", ";
		++$l;
	}
	return _unicode2latin1(substr($uebrig,0,-2));
}

//Crew Data
function crack_str2array_selected($raw,$amount=10,$catch_item = "Regie|Drehbuch|Kamera|Musik|Produzent|Effekte"){	//Schnitt|Maske|
	$patterns 		= array('/Regie/','/Drehbuch/','/Kamera/','/Musik/','/Produzent/','/Schnitt/','/Maske/','/Effekte/');
	$replacements 	= array('R','B','K','MU','P','S','MA','E');

	$rep_size = count($replacements);
	for($m=0;$m < $rep_size; $m++){
		$replacements[$m] = '<strong>' . $replacements[$m] . '</strong>';
	}

	$rest = substr($raw, 1, -1);
	$nochmehrrest = explode(",", $rest);

	$l = 0;
	$uebrig = "";
	foreach ($nochmehrrest as $key => $wal) {
		if($l <= $amount) {
			if(preg_match('/'.$catch_item.'/', $wal)) {
				$schwertwal = preg_replace('/\|/', ' ', preg_replace('/\"/','',$wal));
				$uebrig .= rtrim($schwertwal).', ';
			}
		}
		++$l;
	}
	$nichtsuebrig = preg_replace($patterns, $replacements, $uebrig);
	return _unicode2latin1(substr($nichtsuebrig, 0, -2)).';';
}

//Technical Data
function crack_str2array_lastitem($raw) {
	$rest = substr($raw, 1, -1);
	$nochmehrrest = explode(",", $rest);
	$fsk = array_pop ($nochmehrrest);
	$uebrig = substr(strstr($fsk, ':'),5,-1);
	return "$uebrig";
}

function ext_data_2_drupal_node($dr){
	/* APP-TVDHD
	"id","title","category","start_date","detail_gallery_teaser","homepage_teaser_text",
	"detail_story","detail_background","detail_critics","detail_fazit","meta_year",
	"meta_country","meta_original_title","actor_data","crew_data","meta_runtime",
	"technical_data","detail_cover"*/

	/* tvdigital.de
	content_field_magazin_caption: "Bilder: © Paramount"
	*/

	if (isset($dr)){
		foreach ($dr as $key => $val) {
			//--- Schreibe neue Nodes mit folgenden Inhalten ---
			$start_date = $body_app_meta_original_title = NULL;
			$node = new stdClass();
			foreach ($dr["$key"] as $keey => $vaal) {
				//echo "keey: $keey ---- vaal: $vaal<br>";
				switch ($keey) {
					case "id":
						$id = $vaal;
						break;
					case "title":
						$title	= $vaal;
						$node->title = $title;
						break;
					case "category":
					/*
					APP CATEGORIES bluray, dvd, dvdserie, kino
					tid		vid	name	description	weight
				>	8		1	Entertainment		11
	 			>	11		1	DVDs				1
	 			>	30		1	Kino				0
	 				1779	8	Kino				0
	 				1808	8	Kinotipp			0
	 				*/
	 					if($vaal == "dvd" OR $vaal == "dvdserie" OR $vaal == "bluray") $tid = "11";
	 					else if($vaal == "kino") $tid = "30";
	 					$pretitle = ($tid == 30 ? "Im Kino: " : "Auf DVD: ");
	 					$pre_start_date  = ($tid == 30 ? "Kinostart: " : "Erscheinungstermin: ");
	 					$node->taxonomy = array($terms[0]->tid = $tid);
						break;
					case "start_date":  //2014-07-10 -> 10. Juli 2014
						$start_date  =  $vaal;
						if($start_date) $start_datum = strftime("%d. %B %Y", strtotime($start_date));
						break;
					case "detail_gallery_teaser":
						$body_app_gallery_teaser_img_id  =  $vaal;
						$bilddatei = picture($body_app_gallery_teaser_img_id);
						/* filefield/field_file.inc	*/
						$file = field_file_save_file($bilddatei,NULL,'files/images/magazin',NULL);
						$file['data'] = array(
        					'alt' 	=> ''.$pretitle.''.convert_doublequotes($title).'',
        					'title' => ''.$pretitle.''.convert_doublequotes($title).'',
        					);
						$cck_field = 'field_magazin_image';
						$node->{$cck_field}[0] = $file;
						break;
					case "homepage_teaser_text":
						$node->field_magazin_teasertext[0]["value"] =  $vaal;
						break;
					case "detail_story":
						$body_app_story  =  $vaal;
						break;
					case "detail_background":
						$body_app_background  =  $vaal;
						break;
					case "detail_critics":
						$body_app_critics  =  $vaal;
						break;
					case "detail_fazit":
						$body_app_fazit  =  $vaal;
						break;
					case "meta_year":
						$body_app_year  =  $vaal.";";
						break;
					case "meta_country":
						$body_app_country  =  "<strong>$vaal</strong>";
						break;
					case "meta_original_title":
						$body_app_meta_original_title  =  $vaal;
						if($body_app_meta_original_title) $body_app_meta_original_title = "<strong>OT</strong> $body_app_meta_original_title;";
						break;
					case "actor_data":
						$body_app_actor_data  =  $vaal;
						if($body_app_actor_data) $body_app_show_actors = "<strong>D </strong> ".crack_str2array($body_app_actor_data,3).";";
						//"<strong>D </strong> "
						break;
					case "crew_data":
						$body_app_crew_data  =  $vaal;
						if($body_app_crew_data) $body_app_show_crew = crack_str2array_selected($body_app_crew_data,10,"Regie|Drehbuch|Kamera|Musik|Produzent|Effekte");
						break;
					case "meta_runtime":
						$body_app_meta_runtime  =  $vaal;
						if($body_app_meta_runtime) $body_app_show_runtime = $body_app_meta_runtime." Min.";
						break;
					case "technical_data":
						$body_app_technical_data  =  $vaal;
						if($body_app_technical_data) $body_app_show_fsk = "<strong>FSK </strong> ".crack_str2array_lastitem($body_app_technical_data).";";
						break;
					case "detail_cover":
						$body_app_detail_cover  =  $vaal;
						break;
					case "field_magazin_image_imagestretch": //INUTIL: Kein Bestandteil von tvd-appcms
						$body_app_gallery_teaser_img_id  =  $vaal;
						$bilddatei = picture($body_app_gallery_teaser_img_id);

						/* filefield/field_file.inc	*/
						$file = field_file_save_file($bilddatei,NULL,'files/images/magazin',NULL);
						$pretitle = ($tid == 30 ? "Im Kino: " : "Auf DVD: ");
						$file['data'] = array(
        					'alt' 	=> ''.$pretitle.''.convert_doublequotes($title).'',
        					'title' => ''.$pretitle.''.convert_doublequotes($title).'',
        					);

						$cck_field = 'field_magazin_image';
						$node->{$cck_field}[0] = $file;
						break;
				}

			}
			$node->body =	'<h2>'.$pre_start_date.' '.$start_datum.'</h2>
			<h2>Story:</h2> <strong>
			'.$body_app_story.'</strong>
			<h2>Hintergrund:</h2>
			'.$body_app_background.'
			<h2>Kritik:</h2>
			'.$body_app_critics.'
			<h2>Fazit:</h2>
			'.$body_app_fazit.'
			<p>'.$body_app_country.' '.$body_app_year.' '.$body_app_meta_original_title.' '.$body_app_show_actors.' '.$body_app_show_crew .' '.$body_app_show_fsk.' '.$body_app_show_runtime.'
			</p>
			<hr style=\"margin: 2em 0 1em\"/>
			';

			/* Bilderstrecke */
			// Abfrage an externe DB
			$db_values = from_external_db('appcms_entertainment_guide_gallery','entertainment_guide_id',$id,NULL,NULL,'single');

/*			id,entertainment_guide_id,image,image_thumb	*/
			$imagestretch = array();
			if (isset($db_values)){
				foreach ($db_values as $key => $val) {
				//echo "key: $key ---- val: $val<br>";
					//--- Bearbeite einzelnes Image ---
					//$pictures = new stdClass();
					foreach ($db_values["$key"] as $keey => $vaal) {
						//echo "keey: $keey ---- vaal: $vaal<br>";
						switch ($keey) {
							case "entertainment_guide_id":
								$app_eg_id = $vaal;
								break;
							case "image":
								$app_eg_img_id  =  $vaal;
								$app_eg_img = picture($app_eg_img_id);
								$imagestretch = field_file_save_file($app_eg_img,NULL,'files/images/magazin',NULL);
								// filefield/field_file.inc

								//$pretitle = ($tid == 30 ? "Im Kino: " : "Auf DVD: ");
								$imagestretch['list'] = '1';
								$imagestretch['data'] = array(
									'alt' 	=> ''.$pretitle.''.convert_doublequotes($title).'',
									'title' => ''.$pretitle.''.convert_doublequotes($title).' - ',
									);
								$cck_field = 'field_magazin_image_imagestretch';
								$node->{$cck_field}[$key] = $imagestretch;
								break;
						}
					}
				}
			}

			$node->type = 'magazin';
			$node->uid = 5521;		//tvdh_app User (Drupal)
			$node->language = 'de';
			$node->promote = 0;
			$node->status = 0;
  			$node->comment = 0;
  			$node->promote = 0;
  			$node->moderate = 0;
  			$node->sticky = 0;
  			$node->tnid = 0;
  			$node->translate = 0;
  			$node->vid = NULL;
  			$node->revision_uid = 1;

			# ----- save the node; and get the new nid -----
			node_save($node);
			$nid = $node->nid;
			unset($node);
			//
			echo "------ TVD-app: $id -> TVD: $nid --- $title  IMPORT OK!-----<br>";
			$lastnode = " TVD-app: $id -> TVD: $nid --- $title";
			//--- Node erstellt !---//
 		}
	}
	//Speichern der id des letzten Imports
	$idfile = "/tmp/.tvdhd-app_lastimport";
	if (file_exists($idfile)) {
			$fh = @fopen($idfile, "w");
			fputs ($fh, $lastnode);
			fclose ($fh);
	} else {
			$fh = @fopen($idfile, "w");
			if($fh==false)
				die("unable to create file $idfile");
			fputs ($fh, $lastnode);
			fclose ($fh);
	}
}

// Hole externe Daten
function from_external_db($db_table,$field_name,$id_min,$id_max,$orderarg,$dbmode='single'){
	db_set_active('tvdhd');

	$db_table_keys = array();

	$query = 'SHOW COLUMNS FROM `'.$db_table.'`';
	$result = db_query($query);
	if (!$result) {
	   echo 'Could not run query: ' . mysql_error();
	   exit;
	} else {
	   while ($row = db_fetch_array($result))  {
		   $db_table_keys[] = $row['Field'];
	   }
	   $num_db_keys = count($db_table_keys);
	}

	/*
	$app_keys = array("id","title","category","start_date","detail_gallery_teaser","homepage_teaser_text",
				 "detail_story","detail_background","detail_critics","detail_fazit","meta_year",
				 "meta_country","meta_original_title","actor_data","crew_data","meta_runtime",
				 "technical_data","detail_cover");
	*/

	if($dbmode == 'single') {
		$query = 'SELECT *
					FROM  `'.$db_table.'`
					WHERE `'.$field_name.'` = '.$id_min.'';
	} else if ($dbmode == 'multi') {
	$orderby = ($orderarg ? ' ORDER BY `'.$orderarg.'`' : NULL);
		$query = 'SELECT *
					FROM  `'.$db_table.'`
					WHERE `'.$field_name.'` >= '.$id_min.' AND `'.$field_name.'` <= '.$id_max.''.$orderby.'';
	echo "$query<br><br>";
	}

	$result = db_query($query);
	// Ermittel der Anzahl der Datensätze
	//$anzahl_datensaetze = db_num_rows($result);//ERROR in Drupal -> Mechanismus ob Datensätze gefunden wurden erst mal weggelassen. UNKRITISCH!
	 $dr = array();
	 $i = 0;

	while ($row = db_fetch_array($result))
	{
		for ($j = 0;$j < $num_db_keys; $j++) {
			if ($row["$db_table_keys[$j]"] != NULL) $db_values[$i]["$db_table_keys[$j]"] = $row["$db_table_keys[$j]"];
			/*
			$db_values[$i]["id"]					= $row["id"];
			$db_values[$i]["title"] 				= $row["title"];
			...
			*/
		}
		$i++;
	}
	// Zurücksetzen zur Drupal-Datenbank
	db_set_active('default');
	return ($db_values);
}

function external_cms($arg1 = NULL, $arg2 = NULL) {
  $pattern = '/^[1-9]+[0-9]*/';

  if (!empty($arg1) && $arg1 > 0 && preg_match($pattern,$arg1)) {
  	echo '<div>id: ' . $arg1 . '</div>';
  	//Hole Daten aus externer DB: 1 Datensatz
  	$arg1_ok = TRUE;
  	if (empty($arg2)) $db_values = from_external_db('appcms_entertainment_guide','id',$arg1,NULL,'single');
  } else {
    $arg1_ok = FALSE;
  	echo "Eingabe im Format: <br><strong>www.adresse.de/external_cms/1.Zahl</strong><br>";
  }

  if (!empty($arg2) && $arg1_ok && preg_match($pattern,$arg2) && $arg1 < $arg2 && ($arg2 - $arg1 < 21)) {
  	echo '<div>bis id: ' . $arg2 . '</div>';
  	//Hole Daten aus externer DB: max. 20 Datensätze (wg. Server Timeout)
  	$db_values = from_external_db('appcms_entertainment_guide','id',$arg1,$arg2,'multi');
  } else if (!empty($arg2)){
  	echo "Eingabe im Format: <br><strong>www.adresse.de/external_cms/1.Zahl/2.Zahl</strong> <br>(2.Zahl > 1.Zahl und <br>! 2.Zahl - 1.Zahl < 21).<br> ";
  }

  //DB Daten für Drupal Node Items
  ext_data_2_drupal_node($db_values);
}
