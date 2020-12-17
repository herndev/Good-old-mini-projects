<?php
	include '../auth/conn.php';
	session_start();

	$errMsg = '';
	$ssMsg = '';

	if(isset($_POST['add_class'])){
		$id_number = $_POST['id_number'];
		$class = $_POST['class'];

		if (!empty($id_number) && $class != "") {
			$class = explode("_", $class);
			$course_id = $class[0];
			$section_id = $class[1];
			$sql = "select * from user A join type B on A.type_id = B.id where B.type = 'student' and A.id_number = '$id_number'";
			$result = $conn->query($sql);
			if($row = $result->fetch_assoc()){
				$sql = "select * from student_info where student_id = '$id_number' and course_id = '$course_id'";
				$result = $conn->query($sql);
				if($row = $result->fetch_assoc()){
					$errMsg = "* This ID number already registered to the same course.";
				}else{
					$sql = "insert into student_info (section_id, student_id, course_id) values ('$section_id', '$id_number', '$course_id')";
					if($conn->query($sql)===TRUE){
						$ssMsg = "* Student has been added to a class successfully.";
						header("location: dashboard.php");	
					}
				}

			}else{
				$errMsg = "* This ID number is not a student.";
			}
		}else{
			$errMsg = "* Fill in information needed.";
		}
	}

	if(isset($_POST['new_student'])){
		$id_number = $_POST['id_number'];
		$fname = $_POST['fname'];
		$mname = $_POST['mname'];
		$lname = $_POST['lname'];
		$class = $_POST['class'];

		if (!empty($id_number) && $class != "") {
			$class = explode("_", $class);
			if ($id_number == "" || $fname == "" || $lname == "") {
				$errMsg = "* Student's credentials can't be empty.";
			}else{
				$sql = "select A.*, B.type from user A join type B on A.type_id = B.id where A.id_number ='$id_number'";
				$result = $conn->query($sql);
				if($row = $result->fetch_assoc()){
					$errMsg = "* ID number already active. <br>";
					$errMsg = $errMsg."* This ID number belongs to a ".$row['type'].". <br>";
					$errMsg = $errMsg."* This is ".$row['fname']." ".$row['mname']." ".$row['lname'].".";
				}else{
					$sql = "insert into user (id_number, fname, mname, lname, password, type_id) values ('$id_number','$fname', '$mname', '$lname', '".$lname."@".$id_number."', '3')";
					if($conn->query($sql)===TRUE){
						$sql = "INSERT INTO `student_info`(`section_id`, `student_id`, `course_id`) VALUES ($class[1],$id_number,$class[0])";
						if($conn->query($sql)===TRUE){
							$ssMsg = "* Student successfully added.";
						}
					}else{
						$errMsg = "* Server error 404.";
					}
				}
			}
		}else{
			$errMsg = "* Fill in information needed.";
		}
	}

	
	if ($errMsg != null) {
		echo "<div class='btn-danger pl-4 pt-2 pb-2 lg'>Error: <br><div class='pl-4 small'>$errMsg</div></div>";
	}
	else if ($ssMsg != null) {
		echo "<div class='btn-success pl-4 pt-2 pb-2 lg'>Notice: <br><div class='pl-4 small'>$ssMsg</div></div>";
		header("location: dashboard.php");
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
		#stream{
			background: pink;
			width: 100%;
			height: 100%;
		}
		#capture{
			display: none;
			width: 100%;
			height: 80%;
			margin-top: 10%;
		}
		#img{
			display: none;
			width: 100%;
			height: 430px;
		}
		.cool{
			border: 3px solid #17a2b8;
			border-radius: 10px;
			margin: 0px 2px;
			padding: 10px;
			background: #343a40;
			color: white;
		}
	</style>
</head>
<body>
	<div class="container">
		<div class="row mt-5">
			<div class="col-lg-6">
				<video id="stream"></video>
				<canvas id="capture" width="320" height="240"></canvas>
				<img src="" id="img">
				<div id="snapshot"></div>
			</div>
			<div class="col-lg-6">
				<div class="div_pictorial">
					<div class="row mt-2">
						<div class="col-lg-6">
							<button class="btn btn-block btn-warning" id="btn-start">Stream</button>
						</div>
						<div class="col-lg-6">
							<button class="btn btn-block btn-success" id="btn-capture">Capture</button>
						</div>
					</div>
				</div>
				<form action="<?php $_SERVER['PHP_SELF'] ?>" method="POST" class="form-group mt-3">
					<input type='file'class="form-control mb-2" name="self_picture" id="imager" placeholder="Get image" onchange="changerer()">
					<select class="form-control floal-right mb-2" name="class">
						<option value="">Select class</option>
						<?php
							$sql = "select B.id as 'course_id', C.id as 'section_id', B.course_code, C.section from class A join course B on B.id = A.course_id join section C on C.id = A.section_id WHERE A.teacher_id = '".$_SESSION['id_number']."'";
							$result = $conn->query($sql);
							while($row = $result->fetch_assoc()){
						?>
						<option value="<?php echo $row['course_id'].'_'.$row['section_id']; ?>"><?php echo $row['course_code']." ".$row['section']; ?></option>
						<?php 
							}
						 ?>
					</select>
					<input type="text" class="form-control mb-2" name="id_number" placeholder="ID Number">
					<input type="text" class="form-control mb-2" name="fname" placeholder="First Name">
					<input type="text" class="form-control mb-2" name="mname" placeholder="Middle Name">
					<input type="text" class="form-control mb-2" name="lname" placeholder="Last Name">
					<button type="submit" name="new_student" class="btn btn-success lg btn-block">Register student</button>
					<button class="btn btn-danger lg btn-block" onclick="back()">Cancel</button>
				</form>
			</div>
		</div>
		<div class="row cool mt-5">
			<form class="col-lg-12" action="<?php $_SERVER['PHP_SELF'] ?>" method="post">
				<div class="row">
					<div class="col-lg-6">
						<legend class="xl font-weight-bold">Student already registered?</legend>
					</div>
					<div class="col-lg-6">
						<input type="text" name="id_number" placeholder="ID Number" class="form-control">
					</div>
				</div>
				<div class="row">
					<div class="col-lg-6 mt-2">
						<select name="class" class="form-control">
							<option value="">Select class</option>
							<?php
								$sql = "select B.id as 'course_id', C.id as 'section_id', B.course_code, C.section from class A join course B on B.id = A.course_id join section C on C.id = A.section_id WHERE A.teacher_id = '".$_SESSION['id_number']."'";
								$result = $conn->query($sql);
								while($row = $result->fetch_assoc()){
							?>
							<option value="<?php echo $row['course_id'].'_'.$row['section_id']; ?>"><?php echo $row['course_code']." ".$row['section']; ?></option>
							<?php 
								}
							 ?>
						</select>
					</div>
					<div class="col-lg-6 mt-2">
						<button type="submit" name="add_class" class="btn btn-block btn-success">Add</button>
					</div>
				</div>
			</form>
		</div>
	</div>
<script type="text/javascript" src="../js/jquery.min.js"></script>
<script type="text/javascript" src="../js/style.js"></script>
<script type="text/javascript">

	// The buttons to start & stop stream and to capture the image
	var btnStart = document.getElementById( "btn-start" );
	var btnCapture = document.getElementById( "btn-capture" );

	// The stream & capture
	var stream = document.getElementById( "stream" );
	var capture = document.getElementById( "capture" );
	var img = document.getElementById( "img" );

	// The video stream
	var cameraStream = null;



	function changerer(){
		var imager = document.getElementById('imager').files[0];
		if (imager) {
			stream.style.display = "none";
        	capture.style.display = "none";
        	img.style.display = "block";
			var reader = new FileReader();

			reader.addEventListener('load', function(){
				document.getElementById('img').src = this.result;
			});
			reader.readAsDataURL(imager);
		}
	}

	function back() {
		window.open('../admin.php', '_parent');
	}

	
	
	// Attach listeners
	btnStart.addEventListener( "click", startStreaming );
	btnCapture.addEventListener( "click", captureSnapshot );

	// Start Streaming
	function startStreaming() {
		img.style.display = "none";
        stream.style.display = "block";
        capture.style.display = "none";
	    var mediaSupport = 'mediaDevices' in navigator;

	    if( mediaSupport && null == cameraStream ) {

	        navigator.mediaDevices.getUserMedia( { video: true } )
	        .then( function( mediaStream ) {

	            cameraStream = mediaStream;

	            stream.srcObject = mediaStream;

	            stream.play();
	        })
	        .catch( function( err ) {

	            console.log( "Unable to access camera: " + err );
	        });
	    }
	    else {

	        alert( 'Your browser does not support media devices.' );

	        return;
	    }
	}

	// Stop Streaming
	function stopStreaming() {

	    if( null != cameraStream ) {

	        var track = cameraStream.getTracks()[ 0 ];

	        track.stop();
	        stream.load();

	        cameraStream = null;
	    }
	}

	function captureSnapshot() {

	    if( null != cameraStream ) {

	        var ctx = capture.getContext( '2d' );
	        var img = new Image();

	        ctx.drawImage( stream, 0, 0, capture.width, capture.height );
	    
	        img.src     = capture.toDataURL( "image/png" );
	        img.width   = 240;

	        //console.log(img.src);
	        img.style.display = "none";
	        stream.style.display = "none";
	        capture.style.display = "block";
	        stopStreaming();
	    }
	}
</script>
</body>
</html>