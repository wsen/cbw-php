<?php
    function get_navi() {
        // externe nav.data öffnen und zeilenweise lesen
        $datei = 'nav.data';
        $nav_arr = file($datei);

        // <li>-Elemente erstellen
        $ausgabe = '';
        for($i=0; $i < count($nav_arr); $i++) {
            $link_arr = explode('|', $nav_arr[$i]);
            $ausgabe .= '<li><a href="index.php?pid='.$link_arr[1].'">'.$link_arr[0].'</a></li>';
        }   
        
        return $ausgabe;
    }

    function get_page_cont($pid) {
        echo '<script>console.log('.$pid.')</script>';
        $datei = $pid.'.data';
        $page_arr = file($datei);
        $var_arr = array();

        for($i=0; $i < count($page_arr); $i++) {
            $line_arr = explode('|', $page_arr[$i]);
            $var_arr[$line_arr[0]] = $line_arr[1];

            // if($line_arr[0] == 'h1') {
            // $$line_arr[0] = $line_arr[1];
            //     $h1 = $line_arr[1];
            // } if($line_arr[0] == 'h2') {
            //     $h2 = $line_arr[1];
            // } if($line_arr[0] == 'p') {
            //     $P = $line_arr[1];
            // }          
        }
        return $var_arr;
    }
?>