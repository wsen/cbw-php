<?php
    if(isset($_POST['username']) && $_POST['username']=='cbw' && $_POST['pass']=='geheim') {
        session_start();
        $_SESSION['my_log_id'] = 'fa76';
    //} elseif(!empty($_POST['logout'])) {
    } elseif(isset($_POST['logout'])) {
        session_start();
        $_SESSION['my_log_id'] = '';
        unset($_SESSION['my_log_id']);
        session_destroy();
    }
    //https://www.youtube.com/watch?v=sssVKXQWcOI
?>

<!DOCTYPE html>
<html>
	<head>
		<title>014 login</title>
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
    <?php
        if(!isset($_SESSION['my_log_id']) || $_SESSION['my_log_id']!=='fa76') {
    ?>
	    <h2>014 $_SESSION - LOGIN</h2>

        <form id="myForm" action="<?php echo $_SERVER['PHP_SELF'].'?ts='.time(); ?>" method="post">
			<input type="text" name="username" value="" placeholder="Username" required="required" />
			<input type="password" name="pass" value="" placeholder="Passwort" required="required" />
			<button type="submit">Login</button>			
		</form>
	<?php } else { ?>	
        <h2>LOGIN-Bereich</h2>
        <p>Lorem ipsum trallalla</p>
        <form id="myForm2" action="<?php echo $_SERVER['PHP_SELF'].'?ts='.time(); ?>" method="post">
			<button type="submit" name="logout">LogOut</button>			
		</form>
        <div><?php echo 'Dies ist die Session: '.$_SESSION['my_log_id']; ?></div>

    <?php } ?>

    <script>
        <?php echo 'console.log("Session: "'. $_SESSION['my_log_id'] .');' ?>;
    </script>
    </body>
</html>
