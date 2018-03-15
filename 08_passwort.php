<?php
    // ZIEL: 'kvkvddd' 100 Stpck

    $k = 'b c d f g h k m n p q r s t v z';
    $kons = explode(' ', $k);
    $v = 'a e o u';
    $vocs = explode(' ', $v);
    $d = '0 1 2 3 4 5 6 7 8 9';
    $digits = explode(' ', $d);

    $ausgabe = '';
    for($i=0; $i<=100; $i++){

        $pass = '';
        shuffle($kons);
        shuffle($vocs);
        $pass = $kons[0] . $vocs[0] . $kons[1] . $vocs[1];    

        for($ii=1; $ii<=3; $ii++) {
            shuffle($digits);
            $pass .= $digits[0];
        }

        if($i<100) {
            $ausgabe .= $pass . ' - ';
        } else {
            $ausgabe .= $pass;
        }
    }

    

?>

<!DOCTYPE html>
<html>
	<head>
		<title>08 passwort</title>
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
	<p>
		<h2>Mnemonische Passwörter</h2>
		<div>
            <?php echo $ausgabe; ?>        
        </div>
	</body>
</html>
