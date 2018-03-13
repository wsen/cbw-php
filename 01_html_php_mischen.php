<?php
	$myText = 'Lorem ipsum dolor sit amet, consetetur sadipscing elitr, sed 
	diam nonumy eirmod tempor invidunt ut labore et dolore magna aliquyam erat, 
	sed diam voluptua. At vero eos et accusam et justo duo dolores et ea rebum. 
	Stet clita kasd gubergren, no sea takimata sanctus est Lorem ipsum dolor 
	sit amet. Lorem ipsum dolor sit amet, consetetur sadipscing elitr, 
	sed diam nonumy eirmod tempor invidunt ut labore et dolore magna aliquyam 
	erat, sed diam voluptua. At vero eos et accusam et justo duo dolores et ea rebum. 
	Stet clita kasd gubergren, no sea takimata sanctus est Lorem ipsum dolor 
    sit amet.';
    
    $myText2 = '<p><strong>Text als PHP: </strong>Lorem ipsum dolor sit amet, consetetur sadipscing elitr, sed 
	diam nonumy eirmod tempor invidunt ut labore et dolore magna aliquyam erat, 
	sed diam voluptua. At vero eos et accusam et justo duo dolores et ea rebum. 
	Stet clita kasd gubergren, no sea takimata sanctus est Lorem ipsum dolor 
	sit amet. Lorem ipsum dolor sit amet, consetetur sadipscing elitr, 
	sed diam nonumy eirmod tempor invidunt ut labore et dolore magna aliquyam 
	erat, sed diam voluptua. At vero eos et accusam et justo duo dolores et ea rebum. 
	Stet clita kasd gubergren, no sea takimata sanctus est Lorem ipsum dolor 
    sit amet.</strong></p>';

    $ausgabe = '<table>';
    for($i=0; $i < 10; $i++) {
        if($i%2==0) {
            $ausgabe .= '<tr><td class="gerade">'.$i.'</td></tr>';
        } else {
            $ausgabe .= '<tr><td class="ungerade">'.$i.'</td></tr>';
        }
    }
    $ausgabe .= '</table>';

?>

<!DOCTYPE html>
<html>
	<head>
		<title>01_html_php_mischen</title>
		<meta charset="utf-8" />
		<link href="./styles/global_style.css" type="text/css" rel="stylesheet" media="screen" />
		<script src="../script/jquery-3.3.1.min.js"></script>
		<!-- <script src="http://10.10.56.134/script/jquery-3.3.1.min.js"></script> -->
		<style>
			td.gerade { border: 2px solid tomato; }
            td.ungerade { border: 2px solid blue; }
		
		</style>

		<script>
		
		</script>
	</head>
	
	<body>
	<p>
	<strong>Text als PHP: </strong>
	<?php echo $myText; ?></p>
		<h1>Überschrift der Seite</h1>

		<h2>Keine gute Idee, HTML mit php zu schreiben</h2>
        <?php echo $myText2; ?>

        <h2>For Schleifen Ausgabe</h2>
		<?php   
            echo $ausgabe;
        ?>
		<p>Lorem ipsum dolor sit amet, consetetur sadipscing elitr, sed diam nonumy eirmod tempor invidunt ut labore et dolore magna aliquyam erat, sed diam voluptua. At vero eos et accusam et justo duo dolores et ea rebum. Stet clita kasd gubergren, no sea takimata sanctus est Lorem ipsum dolor sit amet. Lorem ipsum dolor sit amet, consetetur sadipscing elitr, sed diam nonumy eirmod tempor invidunt ut labore et dolore magna aliquyam erat, sed diam voluptua. At vero eos et accusam et justo duo dolores et ea rebum. Stet clita kasd gubergren, no sea takimata sanctus est Lorem ipsum dolor sit amet.</p>
	</body>
</html>
