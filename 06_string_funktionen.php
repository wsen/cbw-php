<?php
    include 'lorem_ipsum.php';
?>

<!DOCTYPE html>
<html>
	<head>
		<title>06_string_funktionen</title>
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
		<h1>06_string_funktionen/h1>
		<h2>String Funktionen)</h2>
        <h3>$lorem_str - original</h3>
            <p><?php echo $lorem_str; ?></p>
		<h3>strpos()</h3>
            <div>Das Wort "ipsum" befindet sich an der Position <?php echo strpos( $lorem_str, 'ipsum'); ?> des Lorem Ipsum</div>

        <h3>substr()</h3>
            <div>Ab dem Wort "ipsum" 13 Zeichen: <i><?php echo substr( $lorem_str, strpos($lorem_str,'ipsum'), 13); ?></i></div>
        <h3>substr(): 12 letzte Zeichen</h3>
            <div>Ab dem Wort "ipsum" 12 Zeichen: <i><?php echo substr( $lorem_str, -12); ?></i></div>
        <h3>substr(): 14 erste Zeichen</h3>
            <div>Ab dem Wort "ipsum" 14 Zeichen: <i><?php echo substr( $lorem_str, 0, 14); ?></i></div>
        <h3>substr_replace()</h3>
            <div>Das Wort "ipsum" ersetztn mit "XXX": <i><?php echo substr_replace( $lorem_str, 'XXX', 6, 5); ?></i></div>
        <h3>str_replace(): Alle Leerzeichen mit Leerstring ersetzen</h3>
            <div><i><?php echo str_replace(' ', '',  $lorem_str); ?></i></div>
        <h3>strlen()</h3>
            <div>Lorem_String enthält: <i><?php echo strlen($lorem_str); ?></i> Zeichen</div>
        <h3>String-Analyse</h3>
        <?php
            $zeichen_anz = strlen($lorem_str);
            // raw: ohne LZ
            $lorem_condensed_anz = strlen(str_replace(' ','',$lorem_str));
            // preg_match('/[a-zA-Z]+/',$lorem_str, $treffer, PREG_OFFSET_CAPTURE); //$treffer Array !!
            $leerzeichen = substr_count($lorem_str,' ');
            $kommata = substr_count($lorem_str,',');
            $punkte = substr_count($lorem_str,'.');
            $buchstaben = $lorem_condensed_anz - $kommata - $punkte;
        ?>
            <div>Lorem_String enthält: <i><?php echo strlen($lorem_str); ?></i> Zeichen davon:</div>
            <div><?php echo $buchstaben; ?> Buchstaben,</div>
            <div><?php echo $leerzeichen; ?> Leerzeichen,</div>
            <div><?php echo $kommata; ?> Kommata und</div>
            <div><?php echo $punkte; ?> Punkte</div>

    </body>
</html>
