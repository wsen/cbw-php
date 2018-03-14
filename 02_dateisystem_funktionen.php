<?php
echo '<b>file()</b> - <u>Liest eine Datei zeilenweise in ein Array</u><br />';
$datei = 'cms/1.data';
$array = file($datei);

// for($x=0; $x < count($array); $x++) {
//     echo $array[$x] . '<br />';
// }
// echo '<hr>';

// alternativ
foreach($array as $zeile) {
    echo $zeile.'<br />';
}
echo '<hr>';

echo '<b>copy()</b> - <u>Datei in ein anderes Verzeichnis kopieren</u><br />';
$datei = 'cms/1.data';
$datei_neu = '1_copy.data';

// ignoriere Fehlermeldung
// if (@copy( $datei, '../tmp/'. $datei_neu)) {

// mit Fehlermeldung
if (copy( $datei, '../tmp/'. $datei_neu)) {
    echo 'DAtei wurde kopiert</br>';
    echo 'Neuer Dateiname: ' . $datei_neu;
}

echo '<hr>';

echo '<b>filectime()</b> - <u>Datum und Uhrzeit mit "date()" der letzten Änderung einer Datei</u><br />';
$datei = '../tmp/1_copy.data';

$zeit = filectime($datei);

echo 'Letzte Änderung (timestamp): ' . $zeit . '<br />';
echo 'Formatiert: ' .date('d.M Y H:i:s', $zeit) . '<br />';
echo 'Aktuell: ' .date('d.m.Y H:i:s', time()) . '<br />';
// echo 'Formatiert: ' .date('d.M Y H:i:s', $zeit) . '<br />';
// echo 'Formatiert: ' .date('d.M Y H:i:s', $zeit) . '<br />';

echo '<hr>';

echo '<b>readfile()</b> - <u>um eine Datei einzulesen und im Browser aszugeben (http oder ftp)</u><br />';
$byte = readfile ('cms/index.php');
echo '<br / >Die Datei hat ein Größe von: ' . $byte;

echo '<hr>';

echo '<b>unlink()</b> - <u>löscht eine Datei unwiderruflich (weg is wech)</u><br />';
$datei = '../tmp/1_copy.data';

if ( @unlink ( $datei )) {
    echo '<br / >Die Datei ' . $datei .' wurde gelöscht';
} else {
    echo 'Konnte die Datei ' . $datei. ' nix löschen!';
}
echo '<hr>';

echo '<b>file_exists()</b> - <u>prüft ob eine Datei vorhanden ist</u><br />';
$datei = '../tmp/1_copy.data';

if ( file_exists ( $datei )) {
    echo '<br / >Die Datei ' . $datei .' gibt es mit höchster Wahrscheinlichkeit';
} else {
    echo 'Die Datei ' . $datei. ' konnte so rein gar nicht gefunden werden!';
}
echo '<hr>';
?>

