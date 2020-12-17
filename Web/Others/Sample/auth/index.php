<?php
	include('UserInfo.php');
	echo UserInfo::getIP();
	echo "<br>";
	echo UserInfo::getLanguage();
	echo "<br>";
	// echo UserInfo::getDevice();
	// $a = new UserInfo;
	// echo $a->get_browser();

	echo $_SERVER['REMOTE_PORT'];
?>
<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<title>Document</title>
</head>
<body>
	
</body>
</html>