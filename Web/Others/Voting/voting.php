<?php
	include "auth/conn.php";
	session_start();

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

	if(!$status){
		header("location: home.php");
	}

	$color = ['Green', 'Orange', 'Violet', 'Gray', 'Red', 'Yellow', 'Yellow-green', 'Teal', 'Darkgoldenrod'];
	$color_state = false;
	$selected_color = $color[random_int(0,sizeof($color)-1)];

	if(isset($_GET['page']) and isset($_SESSION['id_number']) and isset($_SESSION['year_level'])){
		$page = intval($_GET['page']);
		$number_of_pages = 0;

		$sql = "Select count(*) as 'pages' from position_tb";
		$result = $conn->query($sql);
		if($row=$result->fetch_assoc()){
			$number_of_pages = $row['pages'];
		}
	}else{
		header("location: home.php");
	}

	if(isset($_POST['next'])){
		$voted = $_POST['candidate'];
		$position = $_SESSION['voting_position'];
		$_SESSION['voted'][$position] = $voted;
		$page += 1;
		header("location: voting.php?page=".$page);
	}

	if(isset($_POST['submit'])){
		$voted = $_POST['candidate'];
		$position = $_SESSION['voting_position'];
		$_SESSION['voted'][$position] = $voted;
		$id_number = $_SESSION['id_number'];
		$fname = $_SESSION['fname'];
		$mname = $_SESSION['mname'];
		$lname = $_SESSION['lname'];

		foreach($_SESSION['voted'] as $position => $voted){
			if(is_array($voted)){
				foreach($voted as $vote){
					$sql = "INSERT INTO `votes_tb`(`voter_id_number`, `candidate_data_id`, fname, mname, lname) VALUES ($id_number, $vote, '$fname', '$mname', '$lname')";
					if($conn->query($sql)===TRUE);
				}
			}else{
				$sql = "INSERT INTO `votes_tb`(`voter_id_number`, `candidate_data_id`, fname, mname, lname) VALUES ($id_number, $voted, '$fname', '$mname', '$lname')";
				if($conn->query($sql)===TRUE);
			}
		}

		session_destroy();
		header("location: thankyou.php?voter={$fname}");
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
<body class="voting-page">
	<div class="container">
		<div class="row">
			<div class="col-6 offset-3 mobile-fullWidth mobile-votingPage">
				<?php
					$sql = "Select * from position_tb limit ".$page;
					$result = $conn->query($sql);
					while($row=$result->fetch_assoc()){
						$id=$row['id'];
						$position=$row['position'];
						$filter=$row['filter_by_year'];
						$num_of_candidates=$row['number_of_candidates'];
					}
					$_SESSION['voting_position'] = $position;
					?>

					<div class="card animated bounceInRight fly-right-black">
						<div class="card-header <?php echo $selected_color;?>">
							<span class="font-weight-bold"><?php echo $position; ?></span>
							<span class="">
								<?php
									if($filter){
										$yr_lvl = $_SESSION['year_level'];
										$year='';
										if($yr_lvl == 1){
											$year = "1st year";
										}
										else if($yr_lvl == 2){
											$year = "2nd year";
										}
										else if($yr_lvl == 3){
											$year = "3rd year";
										}
										else if($yr_lvl == 4){
											$year = "4th year";
										}
										echo "( ".$year." )";
									}
								?>
							</span>
						</div>
						<div class="card-body voting-body pt-2 pb-2">
							<span class="text-danger font-weight-bold small" id="invalid"></span>
							<form action="<?php $_SERVER['PHP_SELF']; ?>" method="post">

				<?php
					$sql = "Select A.id, B.color, C.fname, C.mname, C.lname, C.year_level from candidate_data_tb A join partylist_tb B on B.id = A.partylist_id join candidate_tb C on C.id = A.candidate_id where A.position_id = ".$id." order by fname";
					$result = $conn->query($sql);
					while($row=$result->fetch_assoc()){
						if($filter){
							if($row['year_level'] == $_SESSION['year_level']){
				?>

						<div class="row mt-2 mx-auto">
							<div class="form-inline col-12">
								<span class="mr-2 <?php echo $row['color']; ?>">_</span>

								<?php
									if($num_of_candidates>1){
								?>
										<input type="checkbox" name="candidate[]" id="<?php echo $row['id']; ?>" class="col-1 mr-3" value="<?php echo $row['id']; ?>" onclick="return checkboxLimit()">
								<?php
									}
									else{
								?>
										<input type="radio" name="candidate" id="<?php echo $row['id']; ?>" class="col-1 mr-3" value="<?php echo $row['id']; ?>">
								<?php	
									}
								?>

								<label for="<?php echo $row['id']; ?>" class="col form-control mobile-candidateName"><?php echo $row['fname']." ".$row['mname']." ".$row['lname']; ?></label><br>
							</div>
						</div>

				<?php
							}
						}else{
				?>

						<div class="row mt-2 mx-auto">
							<div class="form-inline col-12">
								<span class="mr-2 <?php echo $row['color']; ?>">_</span>

								<?php
									if($num_of_candidates>1){
								?>
										<input type="checkbox" name="candidate[]" id="<?php echo $row['id']; ?>" class="col-1 mr-3" value="<?php echo $row['id']; ?>" onclick="return checkboxLimit()">
								<?php
									}
									else{
								?>
										<input type="radio" name="candidate" id="<?php echo $row['id']; ?>" class="col-1 mr-3" value="<?php echo $row['id']; ?>">
								<?php	
									}
								?>

								<label for="<?php echo $row['id']; ?>" class="col form-control mobile-candidateName"><?php echo $row['fname']." ".$row['mname']." ".$row['lname']; ?></label><br>
							</div>
						</div>

				<?php
						}
					}
				?>

					</div>
					<div class="card-footer">
								<?php
									if($page != $number_of_pages){
										echo "<button type='submit' name='next' class='btn btn-primary float-right'>Next";
									}else{
										echo "<button type='submit' name='submit' class='btn btn-primary float-right'>Submit";
									}
								?>
							</button>
						</form>
					</div>
				</div>
				<div class="row mt-5 mb-3 animated fadeIn">
					<div class="text-center page-state-container">
							<?php
								for($i=1; $i <= $number_of_pages; $i++){
									if($i<=$page){
							?>
								<div class="page-state page-state-true"></div>
							<?php
									}
									else{
							?>
								<div class="page-state page-state-false"></div>
							<?php
									}
								}
							?>
					</div>
				</div>
			</div>
		</div>
	</div>

	<!-- <footer>
		<div class="row ml-0 mr-0">
			<div class="col bg-primary pt-2 pb-3">
				<span class="small text-white">Copyright 2020 @ Hernie Jabien All rights reserved</span>
				<h5 class="text-white font-weight-bold float-right">/-/ <span class="text-warning">v/</span></h5>
			</div>
		</div>
	</footer> -->
	<script src="mini_lib/js/jquery.min.js"></script>
	<script src="mini_lib/js/bootstrap.min.js"></script>
	<!-- <script src="js/main.js"></script> -->
	<script src="js/mobile.js"></script>
	<script>
		// Voting script
		function checkboxLimit() {
			var checks = document.getElementsByName("candidate[]");
			var num_selections = 0;
			
			for(var count=0; count<checks.length; count++){
				if(checks[count].checked==true){
					num_selections = num_selections + 1;
				}
			}

			if(num_selections > <?php echo $num_of_candidates; ?>){
				document.getElementById("invalid").innerHTML = "* You can only select " + <?php echo $num_of_candidates; ?> + " candidates.";
				document.getElementById("invalid").style.padding = "0px 5px";
				return false;
			}

			for(var count=0; count<checks.length; count++){
				if(checks[count].checked==true){
					console.log($($(checks[count].parentNode)[0].childNodes[5]).addClass('font-weight-bold'));
				}else{
					console.log($($(checks[count].parentNode)[0].childNodes[5]).removeClass('font-weight-bold'));
				}
			}
			
		}
	</script>
</body>
</html>