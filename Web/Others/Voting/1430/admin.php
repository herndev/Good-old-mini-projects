<?php
	include "../auth/conn.php";
	session_start();

	if(isset($_GET['pwd'])){
		$sql = "Select * from system_tb where action='system-pwd'";
		$result = $conn->query($sql);
		if($row = $result->fetch_assoc()){
			if($row['value']!=$_GET['pwd']){
				header("location: ../home.php");
			}
		}
		$_SESSION['pwd'] = $_GET['pwd'];
	}else{
		if(isset($_SESSION['pwd'])){
			$sql = "Select * from system_tb where action='system-pwd'";
			$result = $conn->query($sql);
			if($row = $result->fetch_assoc()){
				if($row['value']!=$_SESSION['pwd']){
					header("location: ../home.php");
				}
			}
		}else{
			header("location: ../home.php");
		}
	}

	$sql = "Select * from system_tb where action='system'";
	$result = $conn->query($sql);
	if(!($result->fetch_assoc())){
		$sql = "Insert into system_tb(action, value) value('system','true')";
		if($conn->query($sql)===TRUE);
	}

	if(!isset($_SESSION['message'])){
		$_SESSION['message'] = [];
	}
	else{
		foreach($_SESSION['message'] as $message){
			echo $message;
		}
		$_SESSION['message'] = [];
	}

	if (isset($_POST['partylist'])){
		$partylist = $_POST['partylist'];
		$color = ['Green', 'Blue', 'Orange', 'Violet', 'Gray', 'Red', 'Yellow', 'Yellow-green', 'Teal', 'Darkgoldenrod'];
		$color_state = false;
		$selected_color = $color[random_int(0,sizeof($color)-1)];

		$sql = "Select color from partylist_tb where color='$selected_color'";
		$result = $conn->query($sql);
		if($row = $result->fetch_assoc()){
			while($selected_color == $row['color']){
				$selected_color = $color[random_int(0,sizeof($color)-1)];
			}
		}
		
		$sql = "Insert into partylist_tb(partylist, color) value('$partylist','$selected_color')";
		if($conn->query($sql)===TRUE){
			echo "<div class='bg-success p-2 text-white'>Successfully created new Partylist.</div>";
		}
	}

	if (isset($_POST['position'])){
		$position = $_POST['position'];

		$sql = "Insert into position_tb(position) value('$position')";
		if($conn->query($sql)===TRUE){
			echo "<div class='bg-success p-2 text-white'>Successfully created new Position.</div>";
		}
	}

	if(isset($_POST['candidate-partylist'])){
		$partylist = $_POST['candidate-partylist'];
		$position = $_POST['candidate-position'];
		$yr_lvl = $_POST['yr_lvl'];
		$fname = $_POST['fname'];
		$mname = $_POST['mname'];
		$lname = $_POST['lname'];
		$candidate = 0;
		
		$sql = "INSERT INTO `candidate_tb`(`fname`, `mname`, `lname`, `year_level`) VALUES ('$fname','$mname','$lname',$yr_lvl)";
		if($conn->query($sql)===TRUE);

		$sql = "Select * from candidate_tb";
		$result = $conn->query($sql);
		while($row = $result->fetch_assoc()){
			$candidate = $row['id'];
		}

		$sql = "INSERT INTO `candidate_data_tb`(`candidate_id`, `position_id`, `partylist_id`) VALUES ($candidate, $position, $partylist)";
		if($conn->query($sql)===TRUE){
			echo "<div class='bg-success p-2 text-white'>Successfully created new Candidate.</div>";
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
	<link rel="stylesheet" href="../mini_lib/css/animate.css">
	<link rel="stylesheet" href="../mini_lib/css/bootstrap.css">
	<link rel="stylesheet" href="../mini_lib/css/hover.min.css">
	<link rel="stylesheet" href="../mini_lib/css/ionicons.css">
	<link rel="stylesheet" href="../css/style.css">
	<link rel="stylesheet" type="text/css" href="../gisttech/css/tableexport.min.css">
</head>
<body>
	<header>
		<div class="row ml-0 mr-0">
			<div class="col bg-primary">
				<h3 class="text-white font-weight-bold">SITE<span class="text-warning small"> Piniliay</span></h3>
			</div>
		</div>
	</header>

	<div class="container mt-5 mb-5">
		<div class="row">
			<div class="col-4">
				<div class="row">
					<div class="col">
						<div class="card">
							<div class="card-header">
								<h5 class="font-weight-bold text-center">Menu</h5>
							</div>
							<div class="card-body">
								<section id="admin_menus">
									<button class="btn btn-primary btn-block" onclick="admin_action('candidate')">Candidate</button>
									<button class="btn btn-warning btn-block" onclick="admin_action('partylist')">Partylist</button>
									<button class="btn btn-secondary btn-block" onclick="admin_action('position')">Positions</button>
								</section>

								<section id="admin_actions">
									<i class="btn ion-close float-right small pr-0" id="admin-action-close" onclick="admin_action(this.id)"></i>
									
									<section id="admin_partylist">
										<form action="<?php $_SERVER['PHP_SELF'] ?>" method="post" class="form-group">
											<input type="text" name="partylist" id="partylist" class="form-control" placeholder="Partylist">
											<button class="btn btn-success btn-block mt-2">Add partylist</button>
										</form>
										<table class="admin-table col">
											<tr>
												<th colspan="2">
													Partylists
												</th>
											</tr>
											<tr>
												<td>
													<span>Partylist</span>
												</td>
												<td>
													<span>Action</span>
												</td>
											</tr>
											<?php
												$sql = "Select * from partylist_tb";
												$result = $conn->query($sql);
												while($row = $result->fetch_assoc()){
											?>

												<tr>
													<td>
														<span><?php echo $row['partylist']; ?></span>
													</td>
													<td>
														<a href="../edit.php?table=Partylist&&edit='true'&&id=<?php echo $row['id']; ?>" class="btn btn-block btn-primary btn-sm mt-2">Edit</a>
														<a href="../edit.php?table=Partylist&&delete='true'&&id=<?php echo $row['id']; ?>" class="btn btn-block btn-danger btn-sm mb-2">Delete</a>
													</td>
												</tr>

											<?php
												}
											?>
										</table>
									</section>
									
									<section id="admin_position">
										<form action="<?php $_SERVER['PHP_SELF']; ?>" method="post" class="form-group">
											<input type="text" name="position" id="position" class="form-control" placeholder="Position">
											<button class="btn btn-success btn-block mt-2">Add position</button>
										</form>
										<table class="admin-table col">
											<tr>
												<th colspan="2">
													Positions
												</th>
											</tr>
											<tr>
												<td>
													<span>Position</span>
												</td>
												<td>
													<span>Action</span>
												</td>
											</tr>
											<?php
												$sql = "Select * from position_tb";
												$result = $conn->query($sql);
												while($row = $result->fetch_assoc()){
											?>

												<tr>
													<td>
														<span><?php echo $row['position']; ?></span>
													</td>
													<td>
														<a href="../edit.php?table=Position&&edit='true'&&id=<?php echo $row['id']; ?>" class="btn btn-block btn-primary btn-sm mt-2">Edit</a>
														<a href="../edit.php?table=Position&&delete='true'&&id=<?php echo $row['id']; ?>" class="btn btn-block btn-danger btn-sm mb-2">Delete</a>
													</td>
												</tr>

											<?php
												}
											?>
										</table>
									</section>

									<section id="admin_candidate">
										<section id="admin_new_candidate">
											<form action="<?php $_SERVER['PHP_SELF']; ?>" method="POST" class="form-group">
												<select name="candidate-partylist" id="candidate-partylist" class="form-control">
													<option value="none">Partylist</option>
													<?php
													$sql = "Select * from partylist_tb";
													$result = $conn->query($sql);
													while($row = $result->fetch_assoc()){
														?>
															<option value="<?php echo $row['id'] ?>"><?php echo $row['partylist'] ?></option>
													<?php
														}
													?>
												</select>
												<select name="candidate-position" id="candidate-position" class="form-control mt-2">
													<option value="none">Position</option>
													<?php
														$sql = "Select * from position_tb";
														$result = $conn->query($sql);
														while($row = $result->fetch_assoc()){
															?>
																<option value="<?php echo $row['id'] ?>"><?php echo $row['position'] ?></option>
													<?php
														}
													?>
												</select>
												<select name="yr_lvl" id="yr_lvl" class="form-control mt-2">
													<option value="0">Year level</option>
													<option value="1">1st year</option>
													<option value="2">2nd year</option>
													<option value="3">3rd year</option>
													<option value="4">4th year</option>
												</select>
												<input type="text" name="fname" id="fname" class="form-control mt-2" placeholder="First name">
												<input type="text" name="mname" id="mname" class="form-control mt-2" placeholder="Middle name">
												<input type="text" name="lname" id="lname" class="form-control mt-2" placeholder="Last name">
												<button type="submit" class="btn btn-success btn-block mt-2">Add candidate</button>
											</form>
										</section>
										<section id="admin_vew_candidates">
											<table class="admin-table col mt-3">
												<tr>
													<th colspan="4">
														Candidates
													</th>
												</tr>
												<tr>
													<td>
														<span>Partylist</span>
													</td>
													<td>
														<span>Position</span>
													</td>
													<td>
														<span>Name</span>
													</td>
													<td>
														<span>Action</span>
													</td>
												</tr>
												<?php
												$sql = "Select *,C.id as 'iid' from candidate_data_tb A join partylist_tb B on B.id = A.partylist_id join candidate_tb C on C.id = A.candidate_id join position_tb D on D.id = A.position_id";
												$result = $conn->query($sql);
												while($row = $result->fetch_assoc()){
											?>

												<tr>
													<td>
														<span><?php echo $row['partylist']; ?></span>
													</td>
													<td>
														<span><?php echo $row['position']; ?></span>
													</td>
													<td>
														<span><?php echo $row['fname']." ".$row['mname']." ".$row['lname']; ?></span>
													</td>
													<td>
														<a href="../edit.php?table=Candidate&&edit='true'&&id=<?php echo $row['iid']; ?>" class="btn btn-block btn-primary btn-sm mt-2">Edit</a>
														<a href="../edit.php?table=Candidate&&delete='true'&&id=<?php echo $row['iid']; ?>" class="btn btn-block btn-danger btn-sm mb-2">Delete</a>
													</td>
												</tr>

											<?php
												}
											?>
											</table>
										</section>
									</section>
								</section>

								<hr>
								<div class="row mt-3">
									<div class="col-6">
										<a href="../edit.php?system=true" class="btn btn-block btn-primary">Open Voting</a>
									</div>
									<div class="col-6">
										<a href="../edit.php?system=false" class="btn btn-block btn-danger">Close Voting</a>
									</div>
								</div>
							</div>

								<?php 
									$sql = "SELECT * FROM `system_tb` WHERE action = 'system'";
									$result = $conn->query($sql);
									if($row=$result->fetch_assoc()){
										if($row['value'] == 'true'){
								?>		
											<div class="card-footer bg-success">
											<span class="small text-white">Voting is running . .</span>
								<?php
										}
										else if ($row['value'] == 'false'){
								?>
											<div class="card-footer bg-danger">
											<span class="small text-white">Voting is offline . .</span>
								<?php
										}
									}
								?>
							</div>
						</div>
					</div>
				</div>
			</div>
			<div class="col-8">
				<div class="row">
					<div class="col">
						<div class="card admin-updates">
							<div class="card-header">
								UPDATES
							</div>
							<div class="card-body admin-scroll">
								<table class="col mb-5 admin-table-data table-data">

								<?php 
									$sql = "SELECT * FROM position_tb";
									$result = $conn->query($sql);
									while($row=$result->fetch_assoc()){
										$position_id = $row['id'];
										if($row['filter_by_year']){
											$year = '';
											for($i = 1; $i <= 4; $i++){
												if($i == 1){
													$year = "1st year";
												}
												else if($i == 2){
													$year = "2nd year";
												}
												else if($i == 3){
													$year = "3rd year";
												}
												else if($i == 4){
													$year = "4th year";
												}
												?>

											<tr>
												<th colspan="3"><span class="text-secondary">Position:</span> <?php echo $row['position']." (".$year.")"; ?></th>
											</tr>
											<tr>
												<td class="pl-2">
													<h6>Rank</h6>
												</td>
												<td class="pl-2">
													Name
												</td>
												<td class="pl-2">
													# of Votes
												</td>
											</tr>

											<?php
												$sql = "SELECT B.*, (SELECT count(*) FROM votes_tb C where C.candidate_data_id = A.id) as 'votes' FROM candidate_data_tb A join candidate_tb B on B.id = A.candidate_id where A.position_id=$position_id and B.year_level=$i order by votes desc";
												$result2 = $conn->query($sql);
												$c_num = 0;
												while($row2=$result2->fetch_assoc()){
													$c_num ++;
													$bgcol = "";
													if($c_num%2 == 1){
														$bgcol = "bg-gray text-White";
													}
													?>

													<tr class="<?php echo $bgcol; ?> dynamic-tr">
														<td class="pl-2">
															<?php echo $c_num;?>.
														</td>
														<td class="pl-2">
															<?php echo $row2['fname']." ".$row2['mname']." ".$row2['lname'];?>
														</td>
														<td class="pl-2">
															<?php echo $row2['votes'];?>
														</td>
													</tr>

													<?php
												}
												?>
											
											<tr>
												<th class="pt-5" colspan="3"></th>
											</tr>

												<?php
											}
										}
										else{
										?>
											<tr>
												<th colspan="3"><span class="text-secondary">Position:</span> <?php echo $row['position'] ?></th>
											</tr>
											<tr>
												<td class="pl-2">
													<h6>Rank</h6>
												</td>
												<td class="pl-2">
													Name
												</td>
												<td class="pl-2">
													# of Votes
												</td>
											</tr>

											<?php
												$sql = "SELECT B.*, (SELECT count(*) FROM votes_tb C where C.candidate_data_id = A.id) as 'votes' FROM candidate_data_tb A join candidate_tb B on B.id = A.candidate_id where A.position_id=$position_id order by votes desc";
												$result2 = $conn->query($sql);
												$c_num = 0;
												while($row2=$result2->fetch_assoc()){
													$c_num ++;
													$bgcol = "";
													if($c_num%2 == 1){
														$bgcol = "bg-gray text-White";
													}
													?>

													<tr class="<?php echo $bgcol; ?> dynamic-tr">
														<td class="pl-2">
															<?php echo $c_num;?>.
														</td>
														<td class="pl-2">
															<?php echo $row2['fname']." ".$row2['mname']." ".$row2['lname'];?>
														</td>
														<td class="pl-2">
															<?php echo $row2['votes'];?>
														</td>
													</tr>

													<?php
												}
												?>
											
											<tr>
												<th class="pt-5" colspan="3"></th>
											</tr>

										<?php
										}
									}
								?>
										</table>
								
							</div>
						</div>
					</div>
				</div>

				<div class="row">
					<div class="col">
						<div class="card admin-log mt-5">
							<div class="card-header">
								LOG
							</div>
							<div class="card-body admin-scroll">
								<table class="col admin-table">
									<tr>
										<td>
											Time
										</td>
										<td>
											ID Number
										</td>
										<td>
											Voted
										</td>
									</tr>

									<?php
										$sql = "Select distinct voter_id_number, time from votes_tb order by time desc limit 10";
										$result = $conn->query($sql);
										while($row = $result->fetch_assoc()){
											$id_number = $row['voter_id_number'];
											$time = $row['time'];
											?>

												<tr>
													<td>
														<?php echo $time; ?>
													</td>
													<td>
														<?php echo $id_number; ?>
													</td>
													<td>

											<?php
											$sql = "Select candidate_data_id, (select count(*) from `votes_tb` where voter_id_number = A.voter_id_number) as 'count' from votes_tb A where A.voter_id_number=".$id_number;
											$result2 = $conn->query($sql);
											while($row2 = $result2->fetch_assoc()){
												$candidate_data_id = $row2['candidate_data_id'];
												$size = $row2['count'];
												$count = 0;
												$sql = "Select * from candidate_data_tb A join candidate_tb B on B.id = A.candidate_id where A.id=".$candidate_data_id;
												$result3 = $conn->query($sql);
												if($row3 = $result3->fetch_assoc()){
													$fname = $row3['fname'];
													$mname = $row3['mname'];
													$lname = $row3['lname'];
													$count++;
													if($count != intval($size)){
														echo $fname." ".$mname." ".$lname.", ";
													}
													else{
														echo $fname." ".$mname." ".$lname;
													}
													
												}


												// foreach($names as $name){
												// 	if($name){
												// 		echo $name.", ";
												// 	}else{
												// 		echo $name;
												// 	}
												// }
											}
											?>

													</td>
													</tr>

											<?php
										}
									?>
								</table>
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
	
	<footer>
		<div class="row ml-0 mr-0">
			<div class="col bg-primary pt-2 pb-3">
				<span class="small text-white">Copyright 2020 @ Hernie Jabien All rights reserved</span>
				<h5 class="text-white font-weight-bold float-right">/-/ <span class="text-warning">v/</span></h5>
			</div>
		</div>
	</footer>
	<script src="../mini_lib/js/jquery.min.js"></script>
	<script src="../mini_lib/js/bootstrap.min.js"></script>
	<script src="../js/main.js"></script>
	<script type="text/javascript" src="../gisttech/js/FileSaver.min.js"></script>
	<script type="text/javascript" src="../gisttech/js/tableexport.min.js"></script>
	<script>
		$('.table-data').tableExport();
	</script>
</body>
</html>