<?php
	$postStr = '';
	if( !empty($_POST['vorname']) && !empty($_POST['nachname']) && !empty($_POST['email'])) {
		// ev sogar besser
		$postStr = serialize($_POST);

	}
	
?>

<!DOCTYPE html>
<html>
	<head>
		<title>11 PHP-serialize</title>
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
		<h3>serialize() - serialized form data:</h3>
		<div><?php echo $postStr; ?></div>
		<div>echt faszinierend</div>
	</body>
</html>