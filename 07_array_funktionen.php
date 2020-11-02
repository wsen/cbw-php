<?php
    $vnamen = file('./data/vornamen.csv');
    $vornamen = array_unique($vnamen);
    $vornamen = array_values($vnamen); //array neue indiziert

    $nnamen = file('./data/nachnamen.csv');
    $nachnamen = array_unique($nnamen);
    $nachnamen = array_values($nachnamen); //array neue indiziert

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
    print_r($namen_assoc);
?>

<!DOCTYPE html>
<html>
	<head>
		<title>07_array_funktionen</title>
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

		<h1>07_array_funktionen</h1>
		<h2>zweite &Uuml;berschrift der Seite</h2>
		
		<p>Lorem ipsum dolor sit amet, consetetur sadipscing elitr, sed diam nonumy eirmod tempor invidunt ut labore et dolore magna aliquyam erat, sed diam voluptua. At vero eos et accusam et justo duo dolores et ea rebum. Stet clita kasd gubergren, no sea takimata sanctus est Lorem ipsum dolor sit amet. Lorem ipsum dolor sit amet, consetetur sadipscing elitr, sed diam nonumy eirmod tempor invidunt ut labore et dolore magna aliquyam erat, sed diam voluptua. At vero eos et accusam et justo duo dolores et ea rebum. Stet clita kasd gubergren, no sea takimata sanctus est Lorem ipsum dolor sit amet.</p>
	</body>
</html>
