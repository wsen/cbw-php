<?php
    $vnamen = file('./data/vornamen.csv');
    $vornamen = array_unique($vnamen);
    $vornamen = array_values($vnamen); //array neue indiziert
    $vornamen = array_map('trim', $vornamen);

    $nnamen = file('./data/nachnamen.csv');
    $nachnamen = array_unique($nnamen);
    $nachnamen = array_values($nachnamen); //array neue indiziert
    $nachnamen = array_map('trim', $nachnamen);

    //print_r($nachnamen);
    $suche = array('ä','ü','ö','Ä','Ü','Ö','ß');
    $ersetzung = array('ae','ue','oe','ÄE','UE','OE','ss');
 
    $namen_assoc = array();
    for($i=0; $i<count($nachnamen); $i++) {
        $key = str_replace($suche, $ersetzung, $nachnamen[$i]);
        shuffle($vornamen);
        $namen_assoc[trim($key)] = trim($vornamen[0]);
    }
    echo $namen_assoc['Daeberitz'];
    echo "<hr/>";
    $n_namen_klein = array_slice($nachnamen, 0, 10);
    //print_r($n_namen_klein);
?>

<!DOCTYPE html>
<html>
	<head>
		<title>07b_array_funktionen</title>
		<meta charset="utf-8" />
		<link href="../styles/global_php_style.css" type="text/css" rel="stylesheet" media="screen" />
        <script src="../../script/jquery-3.3.1.min.js"></script>
		<!-- <script src="http://10.10.56.134/script/jquery-3.3.1.min.js"></script> -->
		<style>
			
		
		</style>

		<script>
		
		</script>
	</head>
	
	<body>
	<p>

		<h1>07b_array_funktionen</h1>
        <h2> var_dump()</h2>      
        <?php var_dump($n_namen_klein);?>
        <hr />
        <h2> is_array()</h2>
        <?php
		if(is_array($n_namen_klein)) {
            echo '$n_namen_klein ist ein Array';
        }
        ?>

        <h2>count()</h2>
        <?php
		 echo '$vornamen enthält: '.count($vornamen).' Array-Elemente';
        ?>

        <h2>implode()</h2>
        <?php
        $namen_str =  implode(' - ', $n_namen_klein);
         echo '$namen_str ist ein: '.gettype($namen_str);
         echo '<br />';
         echo $namen_str;
        ?>

        <h2>array_search()</h2>
        <?php
        $erdogan =  in_array('Klotz', $n_namen_klein); // in array boolean;
        print_r("erdogan: ".$erdogan."<br />");
        ?>
        <script>
            //hans = 
            console.log("erdogan: " + <?php echo $erdogan ?>);
        </script>
        <?php
            echo '$array_search liefert: '.($erdogan?"TRUE":"FALSE").' und ist ein: '.gettype($erdogan);
            echo '<br />';
        ?>

        <h2>sort()</h2>
        <?php
            sort($n_namen_klein); // default SORT_STRING
            var_dump($n_namen_klein);
        ?>

        <h2>foreach()</h2>
        <?php
            $n_namen_klein = array_slice($namen_assoc, 0, 10); //
            foreach($n_namen_klein as $key=>$value){
                echo $key . ' : ' . $value . '<br />';
            }
        ?>
	</body>
</html>
