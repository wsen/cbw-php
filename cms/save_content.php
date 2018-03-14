<?php
if(isset($_POST['elem']) && isset($_POST['inhalt']) && isset($_POST['pid'])) {
    echo '<script>console.log('.$_POST['pid'].')</script>';
    $pid = $_POST['pid'];
    $datei = $pid.'.data';

    $elem = trim($_POST['elem']);
    $inhalt = trim($_POST['inhalt']);
    $eintrag = $elem.'|'.$inhalt;

    if(file_exists($datei)) {
       // echo($datei + " exisitiert");
        $file_arr = file($datei);
        $file_arr = array_map('trim',$file_arr);

        for($i=0; $i < count($file_arr); $i++) {
            $zeile_arr = explode('|', $file_arr[$i]);
            if($zeile_arr[0] == $elem) {
                $file_arr[$i]  = $eintrag;
                break;
            } 
        }       
    

        //console.log($file_arr);
        // Array Elemente in Datai schreiben
        $content_str = implode("\n", $file_arr); 
        //!! Doppelte AnfZ das Escape Seq interpretiert werden müssen !!1

        file_put_contents($datei, $content_str);
    }
} else {
    echo "nix POST";
}

    // foreach($file_arr as $zeile) {
    // for($ii=0; $ii < count($file_arr); $ii++) {
    //     if(count($file_arr)-1 == $ii){   
    //         file_put_contents($datei, $file_arr[$ii], FILE_APPEND);
    //     } else {
    //         file_put_contents($datei, $file_arr[$ii] . "\n");
    //     }
    // }
//}
//echo $_POST['elem'];

?>
