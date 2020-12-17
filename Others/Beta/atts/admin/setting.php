<?php 
	include '../auth/conn.php';
	session_start();

	if (isset($_GET['msg'])) {
		if ($_GET['msg'] == 'on') {
			echo "<div class='btn-danger pl-4 pt-2 pb-2 lg'>Error: <br><div class='pl-4 small'>* ATTSystem is Deactivated<br>* Data is uptodate.</div></div>";
		}else{
			echo "<div class='btn-success pl-4 pt-2 pb-2 lg'>Notice: <br><div class='pl-4 small'>* ATTSystem is Activated.<br>* Data is uptodate.</div></div>";
		}

	}

	$id_number = $_SESSION['id_number'];

	$sql = "select * from user A join type B on A.type_id = B.id where A.id_number = '$id_number'";
	$result = $conn->query($sql);
	if($row = $result->fetch_assoc()){
		$fname = $row['fname'];
		$mname = $row['mname'];
		$lname = $row['lname'];
	}

	$deactivate = '';

	$sql = "select * from system where action = 'deactivate'";
	$result = $conn->query($sql);
	if($row = $result->fetch_assoc()){
		$deactivate = $row['value'];
		if ($deactivate == 'on') {
			$deactivate = 'checked';
		}else{
			$deactivate = '';
		}
	}


	if (isset($_POST['update'])) {
		$id_numberer = $_POST['id_number'];
		$fname = $_POST['fname'];
		$mname = $_POST['mname'];
		$lname = $_POST['lname'];
		if (isset($_POST['deact'])) {
			$deact = $_POST['deact'];
		}else
		{
			$deact = 'off';
		}
		echo $deact;

		$sql = "update user set fname='$fname', mname='$mname',lname='$lname', id_number='$id_numberer' where id_number = '$id_number'";
		if($conn->query($sql)===TRUE){
			$_SESSION['id_number'] = $id_numberer;
			$sql = "select * from system where action = 'deactivate' limit 1";
			$result = $conn->query($sql);
			if($row = $result->fetch_assoc()){
				$sql = "update system set value='$deact' where action = 'deactivate' ";
				if($conn->query($sql)===TRUE){
					echo "";
				}
			}else{
				$sql = "insert into system (action, value) values ('deactivate', '$deact')";
				if($conn->query($sql)===TRUE){
					echo "";
				}
			}
		}
		header("location: setting.php?msg=$deact");
	}
?>
<!DOCTYPE html>
<html>
<head>
	<title>Student</title>
	<link rel="stylesheet" type="text/css" href="../css/style.css">
	<style type="text/css">
		/* The switch - the box around the slider */
		.switch {
		  position: relative;
		  display: inline-block;
		  width: 50px;
		  height: 25px;
		}

		/* Hide default HTML checkbox */
		.switch input {
		  opacity: 0;
		  width: 0;
		  height: 0;
		}

		/* The slider */
		.slider {
		  position: absolute;
		  cursor: pointer;
		  top: 0;
		  left: 0;
		  right: 0;
		  bottom: 0;
		  background-color: #ccc;
		  -webkit-transition: .4s;
		  transition: .4s;
		}

		.slider:before {
		  position: absolute;
		  content: "";
		  height: 18px;
		  width: 18px;
		  left: 4px;
		  bottom: 4px;
		  background-color: white;
		  -webkit-transition: .4s;
		  transition: .4s;
		}

		input:checked + .slider {
		  background-color: #2196F3;
		}

		input:focus + .slider {
		  box-shadow: 0 0 1px #2196F3;
		}

		input:checked + .slider:before {
		  -webkit-transform: translateX(26px);
		  -ms-transform: translateX(26px);
		  transform: translateX(26px);
		}

		/* Rounded sliders */
		.slider.round {
		  border-radius: 34px;
		}

		.slider.round:before {
		  border-radius: 50%;
		}
	</style>
</head>
<body>
	<div class="container">
		<div class="row">
			<div class="col-lg-6 mt-5">
				<legend class="xl font-weight-bold">Settings</legend>
				<form class="form-group mt-5" action="<?php $_SERVER['PHP_SELF'] ?>" method="POST">
					<label class="switch">
					  <input type="checkbox" id="deact" name="deact" <?php echo $deactivate; ?>>
					  <span class="slider round"></span>
					</label>
					<label class="ml-2" for="deact">Deactivate system</label>
					<input type="text" name="id_number" class="form-control" placeholder="ID Number" value="<?php echo $_SESSION['id_number']; ?>">
					<div class="row mt-2">
						<div class="col-lg-4">
							<input type="text" name="fname" class="form-control" placeholder="First Name" value="<?php echo $fname; ?>">
						</div>
						<div class="col-lg-4">
							<input type="text" name="mname" class="form-control" placeholder="Middle Name" value="<?php echo $mname; ?>">
						</div>
						<div class="col-lg-4">
							<input type="text" name="lname" class="form-control" placeholder="Last Name" value="<?php echo $lname; ?>">
						</div>
					</div>
					<div class="row">
						<div class="col-lg-12 mt-3">
							<button type="submit" name="update" class="form-control btn btn-success btn-block">Update</button>
						</div>
					</div>
				</form>
			</div>
		</div>
	</div>
<script type="text/javascript" src="../js/jquery.min.js"></script>
<script type="text/javascript" src="../js/style.js"></script>
</body>
</html>