<?php
	include "auth/conn.php";
	session_start();

	$status = true;

	if(!isset($_SESSION['try-id_number'])){
		$_SESSION['try-id_number'] = '';
	}

	$sql = "Select * from system_tb where action='system'";
	$result = $conn->query($sql);
	if($row = $result->fetch_assoc()){
		if($row['value'] == 'true'){
			$status = true;
		}
		else{
			$status = false;
		}
	}else{
		$status = false;
	}
	
	$message='';
	$goodmessage='';
	if(isset($_POST['id_number'])){
		$id_number = intval($_POST['id_number']);
		$_SESSION['try-id_number'] = $_POST['id_number'];
		$yr_lvl = $_POST['yr_lvl'];
		$fname = $_POST['fname'];
		$mname = $_POST['mname'];
		$lname = $_POST['lname'];

		if ($yr_lvl == 0){
			$message = "Please specify year level.";
		}else if($id_number <= 2000000000){
			$message = "Invalid ID number !!";
		}
		else{
			$sql = "Select * from votes_tb where voter_id_number=$id_number or fname='$fname' and lname='$lname' and mname='$mname'";
			$result = $conn->query($sql);
			if($row = $result->fetch_assoc()){
				$goodmessage = "Already voted @ ".$row['time'];
			}
			else{
				$_SESSION['id_number'] = $id_number;
				$_SESSION['fname'] = $fname;
				$_SESSION['mname'] = $mname;
				$_SESSION['lname'] = $lname;
				$_SESSION['year_level'] = $yr_lvl;
				$_SESSION['voted'] = array();
				header("location: voting.php?page=1");
			}
		}
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
<body class="home-page">
	<?php
		if($message){
	?>
		<div class="bg-warning btn-block p-2 btn">
			<span class="font-weight-bold text-danger">Error: </span>
			<span class="font-italic text-white"><?php echo $message; ?></span>
		</div>
	<?php
		}
		else if($goodmessage){
	?>
		<div class="bg-success btn-block p-2 btn text-white">
			<span class="font-weight-bold">SITE: </span>
			<span class="font-italic"><?php echo $goodmessage; ?></span>
		</div>
	<?php
		}
	?>
	<header>
		<div class="row ml-0 mr-0">
			<div class="col-6 offset-3 text-center home-banner-container">
				<img src="img/banner2.png" alt="#" class="home-banner">
			</div>
		</div>
	</header>

	<div class="container mt-5 mb-5">
		<div class="row">
			<div class="col-6 mobile-hide">
				<img src="img/banner1.png" alt="#" class="home-chill">
			</div>
			<div class="col-6 mobile-fullWidth">
				<?php 
					if($status){
						?>

						<div class="row">
							<div class="col">
								<form action="<?php $_SERVER['PHP_SELF']; ?>" method="post" class="form-group col-9 mt-5 mobile-fullWidth home-form">
									<input type="integer" name="id_number" id="id_number" class="form-control" placeholder="ID number" value="<?php echo $_SESSION['try-id_number']; ?>">
									
									<div class="row mt-2 mobile-name">
										<div class="col-4 pr-0">
											<input type="text" name="fname" id="fname" class="form-control" placeholder="First name">
										</div>
										<div class="col-4 pr-2 pl-2">
											<input type="text" name="mname" id="mname" class="form-control" placeholder="Middle name">
										</div>
										<div class="col-4 pl-0">
											<input type="text" name="lname" id="lname" class="form-control" placeholder="Last name">
										</div>
									</div>
									
									<select name="yr_lvl" id="yr_lvl" class="form-control mt-2">
										<option value="0">Year level</option>
										<option value="1">1st year</option>
										<option value="2">2nd year</option>
										<option value="3">3rd year</option>
										<option value="4">4th year</option>
									</select>

									<input type="submit" value="Vote now" class="btn btn-primary font-weight-bold btn-block mt-3 btn-lg">
								</form>
								<a href="partylist.php" class="pl-4 nav-link">List of Partylists</a>
							</div>
						</div>

						<?php
					} 
					else{
						?>

							<div class="row mt-5">
								<div class="col">
									<h4 class="text-danger font-weight-bold">Voting closed</h4>
									<p>Voting was finnished or intentionally closed by the admin.</p>
								</div>
							</div>

						<?php
					}
				?>
			</div>
		</div>
	</div>
	
	<footer>
		<div class="row ml-0 mr-0">
			<div class="col-10 offset-1 mt-5">
				<!-- <span class="small">Copyright 2020 @ Hernie Jabien All rights reserved</span> -->
				<!-- <h5 class="font-weight-bold float-right">/-/ <span class="text-warning">v/</span></h5> -->
			</div>
		</div>
	</footer>
	<script src="mini_lib/js/jquery.min.js"></script>
	<script src="mini_lib/js/bootstrap.min.js"></script>
	<script src="js/main.js"></script>
	<script src="js/mobile.js"></script>
</body>
</html>