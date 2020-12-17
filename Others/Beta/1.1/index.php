<?php 
	$tz = ini_get('date.timezone');
	$dtz = new DateTimeZone($tz);
	$dt = new DateTime('now', $dtz);

	$dt = $dt->format('H:m:i');
	echo $dt;
?>