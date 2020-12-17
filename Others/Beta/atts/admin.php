<?php
	include 'auth/conn.php';
	session_start();

	if (!isset($_SESSION) || !isset($_SESSION['id_number']) || $_SESSION['type'] != "admin"){
		header("location: index.php");
	}
?>
<!DOCTYPE html>
<html>
<head>
	<title>ADMIN</title>
	<link rel="stylesheet" type="text/css" href="css/style.css">
	<style type="text/css">
		*{
			box-sizing: border-box;
		}
		.sidemenu{
			width: 10%;
			background: #343a40;
			height: 100vh;
			float: left;
			border-right: 2px solid;
		}
		.content{
			height: 100vh;
			width: 100%;
			background: #f8f9fa;
		}
		.sidemenu a{
			color: #fff;
			width: 100%;
			height: 100%;
		}

		.sidemenu ul{
			list-style-type: none;
			padding: 0px;
			text-align: center;
			border-collapse: collapse;
			border-top: 2px solid gray;
		}
		.sidemenu li{
			border:1px solid black;
			padding: 5px 0px;
			color: lightgray;
		}
		.sidemenu li:hover{
			border:1px solid white;
			color: white;
		}
		.banner{
			width: 100%;
			height: 80px;
			text-align: center;
			padding-top: 15px;
		}
		.logo{
			color: orange;
			font-size: 1.3em;
			font-weight: bold;
		}
		.logo span{
			color: white;
			background: red;
			border-radius: 3px;
			padding: 3px;
			margin-left: 5px;
			font-size: 2em;
			border-bottom: 2px solid white;
		}
		.dlgbox .logo{
			color: orange;
			font-size: 0.6em;
			font-weight: bold;
		}
		.dlgbox .logo span{
			color: white;
			background: red;
			border-radius: 3px;
			padding: 3px;
			margin-left: 5px;
			font-size: 1.2em;
			border-bottom: 2px solid white;
		}
		.dlgbox hr{
			border: 2px solid #343a40;
		}
		.dlgbox button{
			float: right;
		}
		iframe{
			height: 100%;
			width: 90%;
		}
		.black-background{
			display: none;
			width: 100%;
			height: 100%;
			position: fixed;
			top: 0px;
			left: 0px;
			background-color: #0e0e0e;
			opacity: 0.7;
			z-index: 9999;
		}

		.dlgbox{
			display: none;
			box-sizing: border-box;
			background-image: linear-gradient(to left, #343a40, #6c757d, #343a40);
			border: 2px solid gray;
			border-radius: 8px;
			line-height: 0px;
			color: white;
			position: fixed;
			width: 30%;
			z-index: 9999;
			padding: 10px;
			top: 150px;
			left: 35%;
		}

		.dlgbox-header{
			margin-top: 10px;
			width: 100%;
			color: Orange;
			font-size: 20px;
			font-weight: bold;
		}

		.dlgbox-content{
			margin: 20px 30px;
		}	

		.dlgbox-content p{
			line-height: 20px;
		}
		.id_bnner{
			margin-top: 30px;
			color: white;
			text-align: center;
		}
	</style>
</head>
<body>
	<div class='black-background' id='black-background'></div>
	<div class='dlgbox' id='dlgbox'>
		<div class='dlgbox-header'><p class="logo"><i>ATT</i><span>S</span></p></div><hr>
		<div class='dlgbox-content xl form-inline'>Do you really want to logout?</div><br><br>
		<button class='btn btn-success btn-sm ' onclick='comfirmed_logout()'>Confirm</button>
		<button class='btn btn-danger btn-sm mr-2' onclick='ok()'>Cancel</button>
	</div>
	<div class="sidemenu">
		<div class="banner">
			<p class="logo"><i>ATT</i><span>S</span></p>
		</div>
		<ul>
			<p class="id_bnner"></span>
			<span><?php echo "[ ".$_SESSION['type']." ]<br>" ?></span><?php echo $_SESSION['id_number']; ?>
			<span><?php echo "<br>".$_SESSION['lname'].", ".$_SESSION['fname']; ?>
			</p>
			<li id="dashboard" class="btn btn-block">Dashboard</li>
			<li id="new_data" class="btn btn-block">New Data</li>
			<li id="setting" class="btn btn-block">Setting</li>
			<li id="logout" class="btn btn-block">Logout</li>
		</ul>
	</div>
	<div class="content">
		<iframe src="admin/dashboard.php" name="mframe"></iframe>
	</div>
<script type="text/javascript" src="js/jquery.min.js"></script>
<script type="text/javascript" src="js/style.js"></script>
<script type="text/javascript" src="js/admin.js"></script>
</body>
</html>