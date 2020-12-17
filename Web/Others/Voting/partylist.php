<?php
	include "auth/conn.php";

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
<body>
	<div class="container mt-5 mobile-fullWidth">
		<div class="row">
			<div class="col-6 offset-3 mobile-fullWidth">
				<a href="home.php" class="btn btn-warning btn-sm ion-ios-arrow-left"> Go back</a>
			</div>
		</div>
		<div class="row mt-3">
			<div class="col-6 offset-3 mobile-fullWidth">
				<?php
					$sql = "Select * from partylist_tb";
					$result = $conn->query($sql);
					while($row = $result->fetch_assoc()){
						?>
							<div class="card mb-4 fly-right">
							<div class="card-header <?php echo $row['color']; ?>">
								<h5 class="font-weight-bold"><?php echo $row['partylist']; ?></h5>
							</div>
							<div class="card-body">
							<div class="row">
								<div class="col">
									<ul class="list-unstyled">
						<?php
						$sql = "select * from position_tb order by priority";
						$result2 = $conn->query($sql);
						while($row2 = $result2->fetch_assoc()){
							?>

									<li>
										<span class="font-weight-bold"><?php echo $row2['position']; ?>: </span>
										<span class="font-italic">

							<?php
							$sql = "select * from candidate_data_tb A join candidate_tb B on B.id = A.candidate_id where position_id=".$row2['id']." and partylist_id=".$row['id'];
							$result3 = $conn->query($sql);
							$count = 0;
							$year = '';
							while($row3 = $result3->fetch_assoc()){
								if($row2['filter_by_year']){
									if($row3['year_level'] == 1){
										$year = "1st year: ";
									}
									else if($row3['year_level'] == 2){
										$year = "2nd year: ";
									}
									else if($row3['year_level'] == 3){
										$year = "3rd year: ";
									}
									else if($row3['year_level'] == 4){
										$year = "4th year: ";
									}
									?>

										<span class="ml-2">
											<?php echo "<br>",$year; ?>
											<?php echo $row3['fname']." ".$row3['lname']; ?>
										</span>

									<?php
								}else{
								?>

										<?php if($count){echo ", ";} echo $row3['fname']." ".$row3['lname']; ?>

								<?php
								}
								$count = 1;
							}
							?>

										</span>
									</li>

							<?php
						}
						echo "
												<ul>
											</div>
										</div>
									</div>
									</div>
									
									";
					}
				?>
			</div>
		</div>
	</div>
	
	<footer>
		<div class="row ml-0 mr-0">
			<div class="col-10 offset-1 mt-5">
				<!-- <span class="small">Copyright 2020 @ Hernie Jabien All rights reserved</span>
				<h5 class="font-weight-bold float-right">/-/ <span class="text-warning">v/</span></h5> -->
			</div>
		</div>
	</footer>
	<script src="mini_lib/js/jquery.min.js"></script>
	<script src="mini_lib/js/bootstrap.min.js"></script>
	<script src="js/main.js"></script>
	<script src="js/mobile.js"></script>
</body>
</html>