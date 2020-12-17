<?php
	include '../auth/conn.php';
	session_start();

	if (isset($_GET['data'])) {
		$id_number = $_GET['data'];

		$sql = "select * from user A join type B on A.type_id = B.id where id_number = '$id_number'";
		$result = $conn->query($sql);
		if($row = $result->fetch_assoc()){
			$fname = $row['fname'];
			$lname = $row['lname'];
			$mname = $row['mname'];
			$type = $row['type'];
		}
	}

	if (isset($_POST['update'])) {
		$id_numberer = $_POST['id_number'];
		$fname = $_POST['fname'];
		$lname = $_POST['lname'];
		$mname = $_POST['mname'];

		$sql = "update user set id_number = '$id_numberer', fname = '$fname', mname = '$mname', lname = '$lname' where id_number = '$id_number'";
		if($conn->query($sql)===TRUE){
			header("location: dashboard.php");
		}
	}


	if(isset($_POST['drop'])){
		$id_numberer = $_POST['id_number'];
		$sql = "delete from student_info where student_id = '$id_number'";
		if($conn->query($sql)===TRUE){
			header("location: dashboard.php");
		}
	}
?>
<!DOCTYPE html>
<html>
<head>
	<title></title>
	<link rel="stylesheet" type="text/css" href="../css/style.css">
	<style type="text/css">
		table{
			border-collapse: collapse;
		}
		tr:first-child{
			background: #343a40;
			color: white;
			border: 2px solid black;
		}
		tr, th, td{
			border: 1px solid;
			padding: 2px 5px;
		}
		tr:nth-child(even){
			background: lightgray;
		}
		tr:hover{
			background: #fd7e14;
			color: white;
			/*font-weight: bold;*/
		}
		tr:first-child:hover{
			background: #343a40;
			color: white;
		}
		.tbl-m, .tbl-div{
			width: 100%;
		}
		.tbl-div{
			height: 300px;

		}
		.tbl-div{
			border: 2px solid;
			border-radius: 8px;
			overflow-y: auto;
			overflow-x: hidden;
		}
		.tbl-div>div{
			
		}	
		#id_s{
			visibility: hidden;
		}
	</style>
</head>
<body>
	<div class="container">
		<div class="row">
			<div class="col-lg-6 offset-lg-3">
				<legend class="mt-5 font-weight-bold">Student</legend>
				<form action="<?php $_SERVER['PHP_SELF'] ?>" method="POST">
				<input type="text" name="id_number" class="form-control mt-2" placeholder="ID Number" value="<?php echo $id_number; ?>">

				<!-- disabled="disabled" -->
				<div class="row">
					<div class="col-lg-4"><input type="text" name="fname" class="form-control mt-2" placeholder="First Name" value="<?php echo $fname; ?>"></div>
					<div class="col-lg-4"><input type="text" name="mname" class="form-control mt-2" placeholder="Middle Name" value="<?php echo $mname; ?>"></div>
					<div class="col-lg-4"><input type="text" name="lname" class="form-control mt-2" placeholder="Last Name" value="<?php echo $lname; ?>"></div>
				</div>
				<input type="text" name="id_s" value="" id="id_s">
				<div class="row mt-3">
					<div class="col-lg-12">
						<button type="submit" class="btn btn-block btn-success" name="update">Update</button>
					</div>
					<div class="col-lg-6 mt-2">
						<button type="submit" name="drop" class="btn btn-block btn-warning">Drop</button>
					</div>
					</form>
					<div class="col-lg-6 mt-2">
						<button class="btn btn-block btn-danger" onclick="back()">Cancel</button>
					</div>
				</div>
			</div>
		</div>
	</div>
<script type="text/javascript" src="../js/jquery.min.js"></script>
<script type="text/javascript" src="../js/style.js"></script>
<script type="text/javascript">
	function back() {
		window.open('../admin.php', '_parent');
	}
	
</script>
</body>
</html>