<?php
	include "auth/conn.php";
	session_start();

	if(isset($_POST['candidate-edit-fname'])){
		$fname = $_POST['candidate-edit-fname'];
		$mname = $_POST['candidate-edit-mname'];
		$lname = $_POST['candidate-edit-lname'];
		$yr_lvl = $_POST['candidate-edit-yrlvl'];
		$id = $_SESSION['table-id'];

		$sql = "Update candidate_tb set fname='$fname',mname='$mname',lname='$lname', year_level='$yr_lvl' where id = $id";
		if($conn->query($sql)===TRUE){
			$_SESSION['message'] = ["<div class='bg-success p-2 text-white'>Successfully updated candidate.</div>"];
		}
		header("location: 1430/admin.php");
	}
	
	if(isset($_POST['position-edit'])){
		$position = $_POST['position-edit'];
		$priority = $_POST['position-edit-priority'];
		$filter = $_POST['position-edit-filter_by_year'];
		$num_of_candidates = $_POST['position-edit-num_of_candidates'];
		$id = $_SESSION['table-id'];

		$sql = "Update position_tb set position='$position', priority='$priority', filter_by_year='$filter', number_of_candidates='$num_of_candidates' where id = $id";

		if($conn->query($sql)===TRUE){
			$_SESSION['message'] = ["<div class='bg-success p-2 text-white'>Successfully updated $position position.</div>"];
		}
		header("location: 1430/admin.php");
	}

	if(isset($_POST['partylist-edit'])){
		$partylist = $_POST['partylist-edit'];
		$color = $_POST['partylist-edit-color'];
		$id = $_SESSION['table-id'];

		$sql = "Update partylist_tb set partylist='$partylist', color='$color' where id = $id";
		if($conn->query($sql)===TRUE){
			$_SESSION['message'] = ["<div class='bg-success p-2 text-white'>Successfully updated $partylist partylist.</div>"];
		}
		header("location: 1430/admin.php");
	}

	if(isset($_GET['table'])){
		$table = $_GET['table'];
		$id = $_GET['id'];
		$_SESSION['table-id'] = $id;
	}

	if(isset($_GET['system'])){
		if ($_GET['system'] == 'true'){
			$sql = "UPDATE `system_tb` SET `value`='true' WHERE action = 'system'";
			if($conn->query($sql)===TRUE);
		}
		else if($_GET['system'] == 'false'){
			$sql = "UPDATE `system_tb` SET `value`='false' WHERE action = 'system'";
			if($conn->query($sql)===TRUE);
		}
	}
?>
<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<title>Admin</title>
	<link rel="stylesheet" href="mini_lib/css/animate.css">
	<link rel="stylesheet" href="mini_lib/css/bootstrap.css">
	<link rel="stylesheet" href="mini_lib/css/hover.min.css">
	<link rel="stylesheet" href="mini_lib/css/ionicons.css">
	<link rel="stylesheet" href="css/style.css">
</head>
<body>
	<div class="container">
		<div class="row">
			<div class="col-6 offset-3">
				<div class="card mt-5">
						<div class="card-header">
							<?php echo $table; ?>
						</div>
						<div class="card-body">
							<form action="<?php $_SERVER['PHP_SELF']; ?>" method="post" class="form-group">
								<?php 
									if (isset($_GET['edit'])){
										if($table == "Partylist"){
											$sql = "Select * from partylist_tb where id = $id";
											$result = $conn->query($sql);
											if($row=$result->fetch_assoc()){
												$partylist = $row['partylist'];
											}
											?>
											
												<input type="text" name="partylist-edit" id="partylist-edit" placeholder="Partylist" class="form-control" value="<?php echo $partylist; ?>">
												<select class="form-control mt-2" name="partylist-edit-color">
													<option>Green</option>
													<option>Blue</option>
													<option>Orange</option>
													<option>Darkgoldenrod</option>
													<option>Violet</option>
													<option>Gray</option>
													<option>Red</option>
													<option>Yellow</option>
													<option>Yellow-green</option>
													<option>Teal</option>
												</select>

											<?php
										}
										else if($table == "Position"){
											$sql = "Select * from position_tb where id = $id";
											$result = $conn->query($sql);
											if($row=$result->fetch_assoc()){
												$priority = $row['priority'];
												$position = $row['position'];
												$filter = $row['filter_by_year'];
												$num_of_candidates = $row['number_of_candidates'];
											}
											?>
												<input type="text" name="position-edit" id="position-edit" placeholder="Position" class="form-control" value="<?php echo $position; ?>">
												<input type="number" name="position-edit-priority" id="position-edit-priority" placeholder="Priority" class="form-control mt-2" value="<?php echo $priority; ?>">
												<input type="number" name="position-edit-filter_by_year" id="position-edit-filter_by_year" placeholder="Filter by year?" class="form-control mt-2" value="<?php echo $filter; ?>" min="0" max="1">
												<input type="number" name="position-edit-num_of_candidates" id="position-edit-num_of_candidates" placeholder="Number of candidates to be selected" class="form-control mt-2" value="<?php echo $num_of_candidates; ?>" min="1">

											<?php
										}
										else if($table == "Candidate"){
											$sql = "Select * from candidate_tb where id = $id";
											$result = $conn->query($sql);
											if($row=$result->fetch_assoc()){
												$fname = $row['fname'];
												$mname = $row['mname'];
												$lname = $row['lname'];
												$yr_lvl = $row['year_level'];
											}
											?>
												<input type="text" name="candidate-edit-fname" id="candidate-edit-fname" placeholder="First name" class="form-control" value="<?php echo $fname; ?>">
												<input type="text" name="candidate-edit-mname" id="candidate-edit-mname" placeholder="Middle name" class="form-control mt-2" value="<?php echo $mname; ?>">
												<input type="text" name="candidate-edit-lname" id="candidate-edit-lname" placeholder="Last name" name" class="form-control mt-2" value="<?php echo $lname; ?>">
												<input type="number" name="candidate-edit-yrlvl" id="candidate-edit-yrlvl" placeholder="Year level" class="form-control mt-2" value="<?php echo $yr_lvl; ?>">
											<?php
										}
									}else{
										if($table == "Partylist"){
											$sql = "Delete from partylist_tb where id = $id";
											if($conn->query($sql)===TRUE);
											$sql = "Select * from candidate_data_tb where partylist_id = $id";
											$result = $conn->query($sql);
											while($row = $result->fetch_assoc()){
												$sql = "Delete from candidate_data_tb where partylist_id = $id";
												if($conn->query($sql)===TRUE);
												$sql = "Delete from candidate_tb where id = ".$row['candidate_id'];
												if($conn->query($sql)===TRUE);
											}
										}
										else if($table == "Position"){
											$sql = "Delete from position_tb where id = $id";
											if($conn->query($sql)===TRUE);
											$sql = "Select * from candidate_data_tb where position_id = $id";
											$result = $conn->query($sql);
											while($row = $result->fetch_assoc()){
												$sql = "Delete from candidate_data_tb where position_id = $id";
												if($conn->query($sql)===TRUE);
												$sql = "Delete from candidate_tb where id = ".$row['candidate_id'];
												if($conn->query($sql)===TRUE);
											}
										}
										else if($table == "Candidate"){
											$sql = "Delete from candidate_tb where id = $id";
											if($conn->query($sql)===TRUE);
											$sql = "Delete from candidate_data_tb where candidate_id = $id";
											if($conn->query($sql)===TRUE);
										}										
										header("location: 1430/admin.php");
									}
								?>
					</div>
					<div class="card-footer">
							<a href="1430/admin.php" class="btn btn-danger">Cancel</a>
							<input type="submit" value="Update" class="btn btn-success float-right">
						</form>
					</div>
				</div>
			</div>
		</div>
	</div>
</body>
</html>