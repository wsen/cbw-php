<!DOCTYPE html>
<html lang="de">
  <head>
    <meta charset="utf-8" />
    <title>Globals</title>
  </head>
  
  <body>
		<?php
			// echo 'PHP_SELF - aktuelle Datei: '.$_SERVER['PHP_SELF'].'<br />';
			// echo 'HTTP_USER_AGENT: '.$_SERVER['HTTP_USER_AGENT'].'<br />';
			// echo 'SERVER_SOFTWARE: '.$_SERVER['SERVER_SOFTWARE'].'<br />';
			// echo 'REQUEST_METHOD: '.$_SERVER["REQUEST_METHOD"].'<br />';
		
		?>
    <p><b>PHP_SELF</b> - aktuelle Datei: <br /><?php echo $_SERVER['PHP_SELF']; ?></p>
    <p><b>HTTP_USER_AGENT: </b><br /><?php echo $_SERVER['HTTP_USER_AGENT']; ?></p>
    <p><b>SERVER_SOFTWARE: </b><br /><?php echo $_SERVER['SERVER_SOFTWARE']; ?></p>
    <p><b>REQUEST_METHOD: </b><br /><?php echo $_SERVER["REQUEST_METHOD"]; ?></p>
    <p><b>REMOTE_ADRESS: </b><br /><?php echo $_SERVER["REMOTE_ADRESS"]; ?></p>
  </body>
</html>