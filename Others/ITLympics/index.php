<?php 
	require_once "auth/req1.php";
	include "auth/index.php";
?>
<!DOCTYPE html>
<html>
<head>
	<title>ITLympics</title>
	<script type="text/javascript" src="js/jquery.min.js"></script>
	<link rel="stylesheet" type="text/css" href="css/style.css">
	<script type="text/javascript" src="js/main.js"></script>
</head>
<body>
	<div class="container">
		<div class="banner">
			<img src="img/<?php echo $_SESSION['house']; ?>" class="house">
			<img src="img/header.png" class="banner-text">
		</div><br>
		<div class="attendanceform">
			<h3 class="title_header fadeout">ATTENDANCE</h3>
			<form action="<?php echo $_SERVER['PHP_SELF']; ?>" method="POST">
				<input type="number" name="idnumber" placeholder="ID Number" required="" value="<?php echo $idnumber; ?>">
				<input type="text" name="name" placeholder="Fullname" required="" value="<?php echo $name; ?>">
				<select name='year' id="year" onchange="updateSection(this.id, 'section')">
					<option value="">Year level</option>
					<option <?php if ($year == "1"){echo "selected='selected'";} ?>>1st Year</option>
					<option <?php if ($year == "2"){echo "selected='selected'";} ?>>2nd Year</option>
					<option <?php if ($year == "3"){echo "selected='selected'";} ?>>3rd Year</option>
					<option <?php if ($year == "4"){echo "selected='selected'";} ?>>4th Year</option>
				</select>
				<select name='section' id="section">
				</select>
				<button type="submit" name="submit" onclick="validate()">Submit</button>
			</form>
		</div>
	</div>
</body>
</html>