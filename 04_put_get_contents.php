<?php
    $ausgabe = '';
    $text = "Hallo Welt\n";
    file_put_contents('hallo.txt',$text, FILE_APPEND);

    $inhalt = file('hallo.txt');
    foreach($inhalt as $zeile) {
        $ausgabe .= $zeile;
    }

    // file_get_contents
    $daten = file_get_contents('hallo.txt');//,NULL,NULL,4);
    $ausgabe2 = nl2br($daten);

?>

<!DOCTYPE html>
<html>
	<head>
		<title>04 put/get contents</title>
		<meta charset="utf-8" />
		<link href="../../styles/global_php_style.css" type="text/css" rel="stylesheet" media="screen" />
        <script src="../../script/jquery-3.3.1.min.js"></script>
		<!-- <script src="http://10.10.56.134/script/jquery-3.3.1.min.js"></script> -->
		<style>
			
		
		</style>

		<script>
		
		</script>
	</head>
	
	<body>
        <h1>04 put/get contents</h1>
        <textarea><?php echo $ausgabe ?></textarea>
        <div><?php echo ($ausgabe); ?></div>
        <div><?php echo nl2br($ausgabe2); ?></div>

        <p>
	</body>
</html>
