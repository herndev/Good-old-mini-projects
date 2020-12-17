<?php
	include '../auth/conn.php';
	session_start();
?>
<!DOCTYPE html>
<html>
<head>
	<title>Setting</title>
	<link rel="stylesheet" type="text/css" href="../css/style.css">
	<style type="text/css">
		table{
			width: 100%;
			border-collapse: collapse;
		}
		tr:first-child{
			background: #343a40;
			color: white;
		}
		tr, th, td{
			border: 1px solid;
			padding: 5px 20px;
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
		form input{
			float: left;
		}
		th{
			height: 40px;
		}
		.pal{
			color: #01a982;
		}
		input[type=radio]:not(old) {
			width: 30px;
			height: 30px;
			display: inline-block;
			-webkit-appearance: none;
			-moz-appearance: none;
			-o-appearance: none;
			appearance: none;
			border-radius: 1em;
			border: 2px solid #01a982;
			outline: none !important;}

			 input[type=radio]:not(old):checked{
			background-image: radial-gradient(circle at center, #fff, #fff 37.5%, #01a982 40%, #01a982 100%);
			outline: none;
		}
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
		video{
			background: pink;
		}
	</style>
</head>
<body>
	<div class="container">
		<!-- <legend class="xl font-weight-bold mt-5">SETTING</legend> -->
		<div class="row mt-5">
			<div class="col-lg-4 offset-lg-4">
				<legend class="xl font-weight-bold">Attendance</legend>
				<video height="300px" width="300px"></video>
				<input type="" class="form-control mt-4" name="" placeholder="ID Number" disabled="disable">
				<input type="" class="form-control mt-2" name="" placeholder="Name" disabled="disable>
			</div>
		</div>
	</div>
<script type="text/javascript" src="../js/jquery.min.js"></script>
<script type="text/javascript" src="../js/style.js"></script>
</body>
</html>