<?php
	include 'auth/conn.php';
	session_start();

	if (isset($_SESSION) && isset($_SESSION['id_number']) && isset($_SESSION['id_number'])) {
		if ($_SESSION['type'] == "admin") {
			header("location: admin.php");
		}
		if ($_SESSION['type'] == "teacher") {
			header("location: teacher.php");
		}
	}

	$errMsg = null;
	if(isset($_POST['submit'])){
		$user = $_POST['username'];
		$pwd = $_POST['password'];

		if ($user == "" || $pwd == "") {
			$errMsg = "* Fill up username and password.<br>";
		}
		else{
			$sql = "select A.*, B.type from user A join type B on A.type_id = B.id where A.id_number ='$user' and password = '$pwd'";

			$result = $conn->query($sql);
			if($row = $result->fetch_assoc()){
				$_SESSION['id_number'] = $user;
				$_SESSION['type'] = $row['type'];
				$_SESSION['fname'] = $row['fname'];
				$_SESSION['lname'] = $row['lname'];
				$_SESSION['mname'] = $row['mname'];
				if ($row['type'] == "admin") {
					header("location: admin.php");
				}
				else if ($row['type'] == "teacher") {
					header("location: teacher.php");
				}
			}else{
				$errMsg = "* Incorrect username or password.<br>";
			}
		}
	}
	if ($errMsg != null) {
		echo "<div class='btn-danger pl-4 pt-2 pb-2 lg'>Error: <br><div class='pl-4 small'>".$errMsg."</div></div>";
	}
?>

<!DOCTYPE html>
<html>
<head>
	<title>HOME</title>
	<link rel="stylesheet" type="text/css" href="css/style.css">
	<style type="text/css">
		.container{
			margin-top: 15%;
		}
		.row div{
			background-color: #343a40;
			border-radius: 10px;
		}
		legend{
			color: white;
		}
	</style>
</head>
<body>
	<div class="container">
		<div class="row">
			<div class="col-lg-4 offset-lg-4">
				<legend class="font-weight-bold">Login</legend>
				<form action="<?php $_SERVER["PHP_SELF"] ?>" class="form-group" method="POST">
					<input type="text" name="username" class="form-control mt-1" placeholder="ID Number">
					<input type="password" name="password" class="form-control mt-1" placeholder="Password">

					<button type="submit" name="submit" class="btn btn-primary btn-block btn-lg mt-2">Sign-in</button>
				</form>
			</div>
		</div>
		
		
	</div>
<script type="text/javascript" src="js/jquery.min.js"></script>
<script type="text/javascript" src="js/style.js"></script>
</body>
</html>