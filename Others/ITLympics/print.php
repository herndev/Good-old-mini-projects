<?php
	include "./config/conn.php";
?>
<!DOCTYPE html>
<html>
<head>
	<title>PRINT</title>
	<link rel="stylesheet" type="text/css" href="css/print.css">
</head>
<body>
	<div class="printer">
		<?php
			session_start();
			echo $_SESSION['data'];
		?>
	</div>
</body>
</html>