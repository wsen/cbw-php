<?php
    session_start();
    // $_SESSION

    $_SESSION['abc'] = '123';

    // FIREFOX STELLT ALTEW SESSIONS MEISTENS WIEDER HER; DESSHALB:
    // $_SESSION['abc'] = '':
    // unset $_SESSION['abc'];
    // session_destroy();
?>

<!DOCTYPE html>
<html>
	<head>
		<title>013 session</title>
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
	<p>
		<h2>013 Session</h2>
	<?php
      if(isset($_COOKIE['PHPSESSID'])) {
        echo $_COOKIE['PHPSESSID'];			
      }
    ?>
	</body>
</html>
