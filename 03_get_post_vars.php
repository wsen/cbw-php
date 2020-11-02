<?php
	$ausgabe = '';
	if($_SERVER['REQUEST_METHOD'] == 'GET') {
		$ausgabe .= 'Seitenaufrufe mit GET-(standard)<br />';
		if(count($_GET) > 0) {
			foreach($_GET as $schluessel => $wert) {
				$ausgabe .= $schluessel . ' - ' . $wert. '<br />';
			}
		} else {
			$ausgabe .= ' Variablen ohne Inhalte<br />';
		}
	} else {
		$ausgabe .= 'Seitenaufrufe mit POST-Variablen<br />';
		foreach($_POST as $schluessel => $wert) {
			$ausgabe .= $schluessel . ' - ' . $wert . '<br />';
		}

	}
?>

<!DOCTYPE html>
<html>
	<head>
		<title>03_get_post_vars</title>
		<meta charset="utf-8" />
		<link href="../../styles/global_php_style.css" type="text/css" rel="stylesheet" media="screen" />
        <script src="../../script/jquery-3.3.1.min.js"></script>
		<!-- <script src="http://10.10.56.134/script/jquery-3.3.1.min.js"></script> -->
		<style>
			#myFrame { 
				border: red 1px solid;
				padding: 20px; 
			}
		
		</style>

		<script>
			function senden_data() {
				$('#abs1').html('<img src="../media/images/loader.gif" />');
				//$.post("03_get_post_vars.php",
				$.post("../script/formularversand.php",
				{ cantalle: "koslowski", variable2: "xyz", inhalt: "weissnix" },
				function(data, status) {
					//console.log(data + " - " + status);
					//$('#myFrame').html(data);
					$('#abs1').html(data);
				});
			}
		</script>
	</head>
	
	<body>
		<h1>03_get_post_var</h1>
		<nav>
			<a href="<?php echo $_SERVER['PHP_SELF']; ?>">Link</a></br>
			<a href="03_get_post_vars.php?chantalle=koslowski&variable2=xyz">Link</a></br>
			<a href="javascript: senden_data();">Link mit POST-Variablen</a>
		</nav>
		<p id="abs1"><?php echo $ausgabe ?></p>
		<div id="myFrame" width="700" height="350"></div>
				
	</body>
</html>
