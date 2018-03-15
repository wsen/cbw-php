<?php

?>

<!DOCTYPE html>
<html>
	<head>
		<title>010 Variablen Funktionen</title>
		<meta charset="utf-8" />
		<link href="./styles/global_php_style.css" type="text/css" rel="stylesheet" media="screen" />
        <script src="../../script/jquery-3.3.1.min.js"></script>
		<!-- <script src="http://10.10.56.134/script/jquery-3.3.1.min.js"></script> -->
		<style>
			
		
		</style>

		<script>
		
		</script>
	</head>
	
	<body>
		<h2>zweite &Uuml;berschrift der Seite</h2>
        <h3>isset()</h3>
        <?php
            $xyz = 'Ich bin xyz höchstpersönlich<br />';
            // $xyz = '';
            $var1 = '';
            if(!isset($xyz)) {
                echo 'Variable $xyz ist nicht vorhanden/gesetzt<br />';
            } else {
                echo $xyz;
            }
        ?>
        <h3>empty()</h3>
        <?php
            if(empty($xyz)) {
                echo 'Variable $xyz ist empty()<br />';
            }

            if(empty($var1)) {
                echo 'Variable $var1 ist gesetzt aber empty()<br />';
            }
        ?>
        
        <h3>is_numeric()</h3>
        <?php
            $var2 = '12';
            $var2 = 12;
            $var2 = [112, 24];
            //$var2 => { temp : 24 };
            //if(is_numeric($var2[0])) {
            if(is_numeric($var2)) {
                echo 'Variable $var2 is_numeric()<br />';
            } else {
                echo 'gar NIX numeric<br />';
            }
        ?>
        
        <h3>is_numeric(), is_float()</h3>
        <?php
            $flott = '12.5';
            //$flott2 = $flott;
            $flott2 = floatval($flott);
            echo "<hr>";
            echo "flott2: ".$flott2;
            echo "<hr>";


            // $flott = [112, 24];
            //$var2 => { temp : 24 };
            //if(is_numeric($var2[0])) {
            if(is_numeric($flott2)) {
                echo 'Variable $flott2 is_numeric()<br />';
            } else {
                echo 'gar NIX numeric<br />';
            }

            if(is_float($flott2)) {
                echo 'Variable $flott2 ist is_float()<br />';
            } else {
                echo 'gar NIX float<br />';
            }
		?>
	</body>
</html>
