<?php
/*
• a - "am" oder "pm"
• A - "AM" oder "PM"
• B - Tage bis Jahresende
• d - Tag des Monats *( 01 – 31 )
• D - Tag der Woche ( Wed – 3stellig)
• F - Monatsangabe (December – ganzes Wort)
• g - Stunde im 12-Stunden-Format (1-12 )
• G - Stunde im 24-Stunden-Format (0-23 )
• h - Stunde im 12-Stunden-Format *(01-12 )
• H - Stunde im 24-Stunden-Format *(00-23 )
• i - Minuten *(00-59)
• I - (großes i) 1 bei Sommerzeit, 0 bei Winterzeit
• j - Tag des Monats (1-31)
• l - (kleines L) ausgeschriebener Wochentag (Monday)
• L - Schaltjahr = 1, kein Schaltjahr = 0
• m - Monat *(01-12)
• n - Monat (1-12)
• M - Monatsangabe (Feb – 3stellig)
• O - Zeitunterschied gegenüber Greenwich (GMT) in Stunden (z.B.: +0100)
• r - Formatiertes Datum (z.B.: Tue, 6 Jul 2004 22:58:15 +0200)
• s - Sekunden *(00 – 59)
• S - Englische Aufzählung (th für 2(second))
• t - Anzahl der Tage des Monats (28 – 31)
• T - Zeitzoneneinstellung des Rechners (z.B. CEST)
• U - Sekunden seit Beginn der UNIX-Epoche (1.1.1970)
• w - Wochentag (0(Sonntag) bis 6(Samstag))
• W - Wochennummer des Jahres (z.B.: 28)
• Y - Jahreszahl, vierstellig (2001)
• y - Jahreszahl, zweistellig (01)
• z - Tag des Jahres (z.B. 148 (entspricht 29.05.2001))
• Z - Offset der Zeitzone gegenüber GTM (-43200 – 43200) in Minuten
*/

$datum = '17.04.2006';
$uhrzeit = '23:05:00';

?>

<!DOCTYPE html>
<html>
	<head>
		<title>09 datum-zeit</title>
		<meta charset="utf-8" />
		<link href="./styles/global_php_style.css" type="text/css" rel="stylesheet" media="screen" />
		
		<style>
			
		</style>
		
	</head>
	
	<body>
		<h2>Datum- und Zeitfunktionen</h2>
		<h3>time()</h3>
		<!-- Sekunden seit dem 1.1.1970 -->
		<?php echo 'Seit dem 1.1.1970 sind. '.time().' Sekunden vergangen. (unix timestamp)'; ?>
		<h3>date()</h3>
		<!--	 -->
		<?php 
			echo 'Die Zählung des timestamps begann:  <b>'. date('d.m.Y H:i:s', 0).'</b><br />'; 
			echo 'Aktuelle Datum- und Zeit:  <b>'.date('d.m.Y H:i:s', time()). '</b>';
		?>
		<h3>mktime()</h3>
		<!--	 -->
		<?php 
			list($tag, $monat, $jahr) = explode('.', $datum);
			list($stunde, $minute, $sekunde) = explode(':', $uhrzeit);

			$timestamp = mktime($stunde, $minute, $sekunde, $monat, $tag, $jahr);

			echo 'Timestamp mit mktime() für den 17.04.2006, 23:05:00 : <b>'.$timestamp.'</b><br />'; 
			
		?>
		<h3>Wochentag des Geburtstags</h3>
		<!--	 -->
		<?php 
			$geb_datum = '29.01.1960';
			//$geb_datum = '29.01.1961';
			list($gtag, $gmonat, $gjahr) = explode('.', $geb_datum);

			$gtimestamp = mktime(0, 0, 1, $gmonat, $gtag, $gjahr);
			$wochengtag = date('w', $gtimestamp);
			$wochentag = ['So','Mo','Di','Mi','Do','Fr','Sa'];
			$schaltjahr = date('L', $gtimestamp);

			//echo 'Wars denn ein <b>'.date('L', $gtimestamp).'</b> Schaltjahr.<br />'; 
			echo 'Sie sind am <b>'.$wochentag[date('w', $gtimestamp)].'</b> ('.$wochengtag.') geboren worden.<br />'; 
			echo ($schaltjahr?'Und es war ein Schaltjahr':'');
		?>
	</body>
</html>