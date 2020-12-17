<?php
	include "config/conn.php";

	$idnumber = "";
	$name = "";
	$year = "";
	$section = "";

	if (isset($_GET['edit'])) {
		$id = $_GET['edit'];
		$sql = "select * from tbstudent where id = $id";
		$result = $conn->query($sql);
		if($row = $result->fetch_assoc()){
			$idnumber = $row['idnumber'];
			$name = $row['name'];
			$year = $row['year'];
			$section = $row['section'];
		}
	}

	if (isset($_POST['Cancel'])) {
		header('location: admin.php');
	}

	if (isset($_POST['Update'])) {
		$id = $_POST['id'];
		$idnumber = $_POST['idnumber'];
		$name = $_POST['name'];
		$year = $_POST['year'];
		$section = $_POST['section'];

		$sql = "UPDATE `tbstudent` SET name='".$name."', idnumber='".$idnumber."', year='".$year."', section='".$section."' WHERE id='".$id."'";

		if($conn->query($sql)===TRUE){
			$data = "<script>alert('Data successfully updated.');</script>";
			header('location: admin.php');
		}else{
			$data = "<script>alert('Server error unable to delete.');</script>";
		}
	}


?>
<!DOCTYPE html>
<html>
<head>
	<title>EDIT</title>
	<link rel="stylesheet" href="bootstrap-4.4.1-dist/css/bootstrap.css">
</head>
<body>
	<div class="container mt-5">
		<form action="<?php echo $_SERVER['PHP_SELF']; ?>" method="POST">
			<div class="offset-md-3 row mb-2">
				<div class="col-md-7">
					<label>ID Number</label>
					<input type="number" name="idnumber" class="form-control" value="<?php echo $idnumber; ?>">
				</div>
				<div class="col-md-7 mt-2" >
					<label>Name</label>
					<input type="text" name="name" class="form-control" value="<?php echo $name; ?>">
				</div><br>
				<div class="col-md-7 mt-2">
					<label>Year</label>
					<input type="number" name="year" class="form-control" value="<?php echo $year; ?>">
				</div>
				<div class="col-md-7 mt-2">
					<label>Section</label>
					<input type="number" name="section" class="form-control" value="<?php echo $section; ?>">
					<input type="number" name="id" class="form-control" value="<?php echo $id; ?>" hidden="hidden">
				</div>
				<div class="col-md-7 mt-3">
					<button type="submit" name="Update" class="btn btn-success form-control">Update</button>
					<button name="Cancel" class="btn btn-danger form-control  mt-2">Cancel</button>
				</div>
			</div>
		</form>
	</div>
</body>
</html>