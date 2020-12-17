<?php
	include "auth/admin.php";
?>
<!DOCTYPE html>
<html>
<head>
	<title>ADMIN</title>
	<link rel="stylesheet" type="text/css" href="css/bootstrap.min_1.css">
	<link rel="stylesheet" type="text/css" href="css/tableexport.min.css">
	<link rel="stylesheet" type="text/css" href="css/style.css">
	<script type="text/javascript" src="js/main.js"></script>
	<script type="text/javascript" src="js/jquery.min.js"></script>
	<script type="text/javascript" src="js/bootstrap.min_1.js"></script>
	<script type="text/javascript" src="js/FileSaver.min.js"></script>
	<script type="text/javascript" src="js/tableexport.min.js"></script>
</head>
<body>
	<!-- div class='black-background' id='black-background' hidden="hidden">
	</div>
	<div class='dlgbox' id='dlgbox' hidden="hidden">
		<div class='dlgbox-header'>Admin</div>
			<div class='admin-dlgbox-content'>
				<input type="password" name="pwd" id="pwd">
			</div>
			<button type="submit" class='dlgbox-btn admin-btn' name="login" onclick="ok()">Login</button>
	</div -->
	<div class="admin-container">
		<div class="admin-header">
			<nav>
				<div class="srch-box">
					<form action="<?php echo $_SERVER['PHP_SELF']; ?>" method="POST">
						<input type="text" name="srch-text" class="srch-text">
						<button class="srch-btn" name="srch">Search</button>
					</form>
				</div>
				<ul>
					<li>
						<a href="<?php echo $_SERVER['PHP_SELF']; ?>?log=">Log</a>
					</li><!-- 
					<li>
						<a href="<?php echo $_SERVER['PHP_SELF']; ?>?print=">Print</a>
					</li> -->
				</ul>
			</nav>
		</div>
		<div class="admin-content">
			<div class="log">
				<?php
					echo $data;
				?>
				</table>
			</div>
		</div>
	</div>
</body>
<script>
	$('.table-data').tableExport();
</script>
</html>