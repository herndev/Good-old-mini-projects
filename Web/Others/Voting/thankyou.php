<?php
	if(isset($_GET['voter'])){
		$voter = $_GET['voter'];
	}

	if(isset($_GET['a'])){
		echo "<script>window.close();</script>";
	}
?>
<!-- Copyright 2020 @ Hernie Jabien All rights reserved. -->
<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<title>Home</title>
	<link rel="stylesheet" href="mini_lib/css/animate.css">
	<link rel="stylesheet" href="mini_lib/css/bootstrap.css">
	<link rel="stylesheet" href="mini_lib/css/hover.min.css">
	<link rel="stylesheet" href="mini_lib/css/ionicons.css">
	<link rel="stylesheet" href="css/style.css">
</head>
<body class="end-page">
	<div class="container pb-5 mb-5">
		<div class="row">
			<div class="col-4 offset-4 text-center fly-left-black curved mobile-fullWidth mobile-thanks">
				<div class="row">
					<div class="col bg-success p-3">
						<h1 class="ion-ios-checkmark-outline text-white font-weight-bold large"></h1>
					</div>
				</div>
				<div class="row">
					<div class="col bg-light">
						<h4 class="mt-3 font-weight-bold">Greate!</h4>
						<p class="mt-2"><?php echo $voter; ?>, your vote has been successfully submitted.</p>
					</div>
				</div>
			</div>
		</div>
	</div>
	
	<!-- <footer>
		<div class="row ml-0 mr-0">
			<div class="col-10 offset-1 mt-5">
				<span class="small">Copyright 2020 @ Hernie Jabien All rights reserved</span>
				<h5 class="font-weight-bold float-right small">/-/ <span class="text-warning">v/</span></h5>
			</div>
		</div>
	</footer> -->
	<script src="mini_lib/js/jquery.min.js"></script>
	<script src="mini_lib/js/bootstrap.min.js"></script>
	<script src="js/main.js"></script>
	<script src="js/mobile.js"></script>
	<script>
		// Close window
		function closeWindow(){
			window.open('a','_self');
			// window.open(window.location, '_blank');
		}
	</script>
</body>
</html>