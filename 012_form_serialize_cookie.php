<?php
	session_start();

	$postStr = '';
	if( !empty($_POST['vorname']) && !empty($_POST['nachname']) && !empty($_POST['email'])) {
		// ev sogar besser
        $postStr = serialize($_POST);
        setcookie("persdata",$postStr,time()+(600));

	}
	
?>

<!DOCTYPE html>
<html>
	<head>
		<title>012 PHP-serialize-cookie</title>
		<meta charset="utf-8" />
		<link href="../styles/global_style.css" type="text/css" rel="stylesheet" media="screen" />
		
		<style>
			
		</style>
		
	</head>
	
	<body>
		<form id="myForm" action="<?php echo $_SERVER['PHP_SELF'].'?ts='.time(); ?>" method="post">
			<input type="text" name="vorname" value="" placeholder="Vorname" required="required" />
			<input type="text" name="nachname" value="" placeholder="Nachname" required="required" />
			<input type="email" name="email" value="" placeholder="Email" required="required" />
			<button type="submit">Speichern</button>
			
		</form>
		<h3>setcookie() - set cookie data:</h3>
		<div>
		Lets zeig the Cookie:
		<?php 
			foreach($_COOKIE as $key=>$value) {
				echo $key . ' - ' . $value . '<br />';
			}
		
		echo $postStr; ?></div>
		<div>echt faszinierend</div>

		<h3>unserialize() - cookie data:</h3>
		---- Unserialize It ----:
		<div>
		<?php 
			if(isset($_COOKIE['persdata'])) {
				$persdata_arr = unserialize($_COOKIE['persdata']);
				echo $persdata_arr['vorname'] .  '<br />' .' ' . $persdata_arr['nachname'] . '<br />' .' von aus : ' . $persdata_arr['email'];			
			}
		?>
		</div>

		<h3>$_SESSION - cookie data:</h3>
		<div>
		<?php 
			echo $_SESSION['abc'];
		?>
		</div>
	</body>
</html>