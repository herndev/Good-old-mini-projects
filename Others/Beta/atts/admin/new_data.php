<?php
	include '../auth/conn.php';
	session_start();

	// $errCount = 0;
	$errMsg = null;
	$ssMsg = null;

	if(isset($_POST['add_class'])){
		$id_number = $_POST['id_number'];
		$class = $_POST['class'];

		if (!empty($id_number) && $class != "Select class") {
			$stR = $class;
			$stR = explode(", ", $stR);
			$stR2 = $stR[1];
			$stR2 = explode(" [", $stR2);
			$stR3 = $stR2[1];
			$stR3 = explode(" (", $stR3);
			$stR4 = $stR3[1];
			$stR4 = explode(")]", $stR4);

			$lname = $stR[0];
			$fname = $stR2[0];
			$course = $stR3[0];
			$section = $stR4[0];

			$section_id = '';
			$course_id = '';

			$sql = "select * from user A join type B on A.type_id = B.id where B.type = 'student' and A.id_number = '$id_number'";
			$result = $conn->query($sql);
			if($row = $result->fetch_assoc()){
				$ssMsg = "* ".$row['fname']." ".$row['mname']." ".$row['lname']." added to ".$section.".";

				$sql = "select * from section where section = '$section'";
				$result = $conn->query($sql);
				if($row = $result->fetch_assoc()){
					$section_id = $row['id'];
				}

				$sql = "select * from course where course = '$course'";
				$result = $conn->query($sql);
				if($row = $result->fetch_assoc()){
					$course_id = $row['id'];
				}


				$sql = "select * from student_info where student_id = '$id_number' and course_id = '$course_id'";
				$result = $conn->query($sql);
				if($row = $result->fetch_assoc()){
					$errMsg = "* This ID number already registered to the same course.";
				}else{
					$sql = "insert into student_info (section_id, student_id, course_id) values ('$section_id', '$id_number', '$course_id')";
					if($conn->query($sql)===TRUE){
						$ssMsg = "* Student has been added to a class successfully.";	
					}
				}

			}else{
				$errMsg = "* This ID number is not a student.";
			}
		}
	}

	if(isset($_POST['new_class'])){
		$teacher = $_POST['teacher'];

		$t_id = '';

		$course = $_POST['course'];
		$course_id = '';

		$bldg = $_POST['bldg'];
		$bldg_id = '';

		$room = $_POST['room'];
		$classroom_id = '';

		$tstart = $_POST['tstart'];
		$tend = $_POST['tend'];

		$section = $_POST['section'];
		$section_id = '';

		if ($teacher != "Select teacher" && $course != "Select course" && !empty($bldg) && !empty($room)  && !empty($tstart) && !empty($tend) && !empty($section)) {
			$teacher = explode(", ", $teacher);

			$t_lname = $teacher[0];
			$t_fname = $teacher[1];


			//GET TEACHER ID
			$sql = "select * from user where fname = '$t_fname' and lname = '$t_lname'";
			$result = $conn->query($sql);
			if($row = $result->fetch_assoc()){
				$t_id = $row['id_number'];
			}else{
				$errMsg = "* Server error 404.<br>";
			}

			//GET COURSE ID
			$sql = "select * from course where course = '$course'";
			$result = $conn->query($sql);
			if($row = $result->fetch_assoc()){
				$course_id = $row['id'];
			}

			//INSERT SECTION IF EXISTS AND GET ID
			$sql = "select * from section where section = '$section'";
			$result = $conn->query($sql);
			if($row = $result->fetch_assoc()){
				$section_id = $row['id'];
			}else{
				$sql = "insert into section (section) values ('$section')";
				if($conn->query($sql)===TRUE){
					$section_id = $conn -> insert_id;
				}
			}

			//INSERT BLDG IF EXISTS AND GET ID
			$sql = "select * from bldg where bldg = '$bldg'";
			$result = $conn->query($sql);
			if($row = $result->fetch_assoc()){
				$bldg_id = $row['id'];
			}else{
				$sql = "insert into bldg (bldg) values ('$bldg')";
				if($conn->query($sql)===TRUE){
					$bldg_id = $conn -> insert_id;
				}
			}

			//INSERT CLASSROOM IF EXISTS AND GET ID
			$sql = "select * from classroom where bldg_id = '$bldg_id' and room_number = '$room'";
			$result = $conn->query($sql);
			if($row = $result->fetch_assoc()){
				$classroom_id = $row['id'];
			}else{
				$sql = "insert into classroom (bldg_id, room_number) values ('$bldg_id', '$room')";
				if($conn->query($sql)===TRUE){
					$classroom_id = $conn -> insert_id;
				}
			}


			//CREATE NEW CLASS
			$sql = "insert into class (course_id, classroom_id, section_id, teacher_id, time_start, time_end) values 
			('$course_id', '$classroom_id', '$section_id', '$t_id', '$tstart', '$tend')";
			if($conn->query($sql)===TRUE){
				$ssMsg = "* New class successfully created.";
			}else{
				$errMsg = "* Server error 404.<br>";
			}

		}
	}

	if(isset($_POST['new_student'])){
		$id_number = $_POST['id_number'];
		$fname = $_POST['fname'];
		$mname = $_POST['mname'];
		$lname = $_POST['lname'];

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
					$ssMsg = "* Student successfully added.";
				}else{
					$errMsg = "* Server error 404.";
				}
			}
		}
	}

	if(isset($_POST['new_teacher'])){
		$id_number = $_POST['id_number'];
		$fname = $_POST['fname'];
		$mname = $_POST['mname'];
		$lname = $_POST['lname'];

		if ($id_number == "" || $fname == "" || $lname == "") {
			$errMsg = "* Teacher's credentials can't be empty.";
		}else{
			$sql = "select A.*, B.type from user A join type B on A.type_id = B.id where A.id_number ='$id_number'";
			$result = $conn->query($sql);
			if($row = $result->fetch_assoc()){
				$errMsg = "* ID number already active. <br>";
				$errMsg = $errMsg."* This ID number belongs to a ".$row['type'].". <br>";
				$errMsg = $errMsg."* This is ".$row['fname']." ".$row['mname']." ".$row['lname'].".";
			}else{
				$sql = "insert into user (id_number, fname, mname, lname, password, type_id) values ('$id_number','$fname', '$mname', '$lname', '".$lname."@".$id_number."', '2')";
				if($conn->query($sql)===TRUE){
					$ssMsg = "* Teacher successfully added.";
				}else{
					$errMsg = "* Server error 404.";
				}
			}
		}
	}

	if(isset($_POST['new_course'])){
		$course = $_POST['course'];
		$course_code = $_POST['course_code'];

		if ($course == "" || $course_code == "") {
			$errMsg = "* Course and course code can't be empty.";
		}
		else{
			$sql = "select * from course where course_code = '$course_code' limit 1";
			$result = $conn->query($sql);
			if($row = $result->fetch_assoc()){
				$errMsg = "* Course already exist.";
			}else{
				$sql = "insert into course (course, course_code) values ('$course','$course_code')";
				if($conn->query($sql)===TRUE){
					$ssMsg = "* Course successfully added.";
				}else{
					$errMsg = "* Server error 404.";
				}
			}
		}
	}	


	if ($errMsg != null) {
		echo "<div class='btn-danger pl-4 pt-2 pb-2 lg'>Error: <br><div class='pl-4 small'>$errMsg</div></div>";
	}
	else if ($ssMsg != null) {
		echo "<div class='btn-success pl-4 pt-2 pb-2 lg'>Notice: <br><div class='pl-4 small'>$ssMsg</div></div>";
	}
?>

<!DOCTYPE html>
<html>
<head>
	<title>New Data</title>
	<link rel="stylesheet" type="text/css" href="../css/style.css">
	<style type="text/css">
		body{
			padding-bottom: 50px;
		}
		table{
			border-collapse: collapse;
			width: 80vw;
		}
		tr, th, td{
			border: 1px solid;
			padding: 5px 20px;
		}
		form input{
			float: left;
		}

		.linegap{
			border: 5px dashed #343a40;
		}

		#stream{
			background: pink;
			width: 290px;
			height: 200px;
		}
		#capture{
			display: none;
			width: 270px;
			height: 200px;
			margin-left: 10px;
		}
		#img{
			display: none;
			width: 290px;
			height: 200px;
		}
		.brd{
			border:2px solid;
			border-radius: 8px;
		}
		.brr{
			border:2px solid;
			border-radius: 8px;
			border-left: 0px;
		}
		.brm{
			border:2px solid;
			border-radius: 8px;
			border-left: 0px;
			border-right: 0px;
		}
		.brr:hover, .brd:hover{
			background: #343a40;
			color: white;
		}
		html{
			border-collapse: collapse;
		}
		form{
			opacity: 0.5;
		}
		form:hover{
			opacity: 1;
		}
	</style>
</head>
<body>
	<div class="container">
		<div class="row mt-5">
			<div class="col-lg-6 cls brd">
				<legend class="xl font-weight-bold">Add to Class</legend>
				<form action="<?php $_SERVER['PHP_SELF'] ?>" class="form-group mt-3" method="POST" >
					<select class="custom-select" name="class">
						<option>Select class</option>
						<?php
							$sql = "SELECT B.fname, B.lname, C.section, D.course FROM `class` A join user B on A.teacher_id = B.id_number join section C on A.section_id = C.id join course D on A.course_id = D.id";
							$result = $conn->query($sql);
							while($row = $result->fetch_assoc()){
						?>
						<option>
							<?php 
								echo $row['lname'].", ".$row['fname']." [".$row['course']." (".$row['section'].")]";
							 ?>
						</option>
						<?php
							}
						?>
					</select>
					<input type="text" class="form-control mt-2 mb-3" name="id_number" placeholder="ID Number">
					<button class="btn btn-success btn-block mt-4" name="add_class">ADD</button>
					<button class="btn btn-danger btn-block">Cancel</button>
				</form>
			</div>
			<div class="col-lg-6 brr">
				<legend class="xl font-weight-bold">New Class</legend>
				<form action="<?php $_SERVER['PHP_SELF'] ?>" class="form-group mt-3" method="POST" >
					<select class="custom-select" name="teacher">
						<option class="dropdown">Select teacher</option>
						<?php
							$sql = "select A.*, B.type from user A join type B on A.type_id = B.id where B.type = 'teacher'";
							$result = $conn->query($sql);
							while($row = $result->fetch_assoc()){
						?>
						<option>
							<?php 
								echo $row['lname'].", ".$row['fname'];
							 ?>
						</option>
						<?php
							}
						?>
					</select>
					<select class="custom-select mt-2" name="course">
						<option class="dropdown">Select course</option>
						<?php
							$sql = "select * from course";
							$result = $conn->query($sql);
							while($row = $result->fetch_assoc()){
						?>
						<option>
							<?php 
								echo $row['course'];
							 ?>
						</option>
						<?php
							}
						?>
					</select>
					<div class="row mt-2">
						<div class="col-lg-6">
							<input type="text" name="bldg" class="form-control" placeholder="Building">
						</div>
						<div class="col-lg-6">
							<input type="text" name="room" class="form-control" placeholder="Room number">
						</div>
					</div>
					<div class="row mt-2">
						<div class="col-lg-6">
							<label>Time start:</label>
							<input type="time" name="tstart" class="form-control mr-0" placeholder="Class start">
						</div>
						<div class="col-lg-6">
							<label>Time end:</label>
							<input type="time" name="tend" class="form-control ml-0" placeholder="Class end">
						</div>
					</div>
					<input type="text" class="form-control mt-2 mb-3" name="section" placeholder="Section">
					<button class="btn btn-success btn-block" name="new_class">Add class</button>
					<button class="btn btn-danger btn-block">Cancel</button>
				</form>
			</div>
		</div>
		<hr class="linegap mt-5 mb-5">
		<div class="row">
			<div class="col-lg-4 mt-3 brd">
				<legend class="xl font-weight-bold">New course</legend>
				<form action="<?php $_SERVER['PHP_SELF'] ?>" method="POST" class="form-group mt-3">
					<input type="text" class="form-control mb-2" name="course" placeholder="Course">
					<input type="text" class="form-control mb-2" name="course_code" placeholder="Course code">
					<button type="submit" name="new_course" class="btn btn-success lg btn-block">Create course</button>
					<button type="cancel" class="btn btn-danger lg btn-block">Cancel</button>
				</form>
			</div>
			<div class="col-lg-4 mt-3 brr">
				<legend class="xl font-weight-bold">New Teacher</legend>
				<form action="<?php $_SERVER['PHP_SELF'] ?>" method="POST" class="form-group mt-3">
					<input type="text" class="form-control mb-2" name="id_number" placeholder="ID Number">
					<input type="text" class="form-control mb-2" name="fname" placeholder="First Name">
					<input type="text" class="form-control mb-2" name="mname" placeholder="Middle Name">
					<input type="text" class="form-control mb-2" name="lname" placeholder="Last Name">

					<button type="submit" name="new_teacher" class="btn btn-success lg btn-block">Register teacher</button>
					<button type="cancel" class="btn btn-danger lg btn-block">Cancel</button>
				</form>
			</div>
			<div class="col-lg-4 mt-3 brr">
				<legend class="xl font-weight-bold">New Student</legend>
				<div class="div_pictorial">
					<video id="stream"></video>
					<canvas id="capture" width="320" height="240"></canvas>
					<img src="" id="img">
    			<div id="snapshot"></div>
					<div class="mt-2">
						<button class="btn btn-warning" id="btn-start">Stream</button>
						<button class="btn btn-success" id="btn-capture">Capture</button>
					</div>
				</div>
				<form action="<?php $_SERVER['PHP_SELF'] ?>" method="POST" class="form-group">
					<input type='file'class="form-control mb-2 mt-3" name="self_picture" placeholder="Get image" id="imager" onchange="changerer()">
					<input type="text" class="form-control mb-2" name="id_number" placeholder="ID Number">
					<input type="text" class="form-control mb-2" name="fname" placeholder="First Name">
					<input type="text" class="form-control mb-2" name="mname" placeholder="Middle Name">
					<input type="text" class="form-control mb-2" name="lname" placeholder="Last Name">
					<button type="submit" name="new_student" class="btn btn-success lg btn-block">Register student</button>
					<button type="cancel" class="btn btn-danger lg btn-block">Cancel</button>
				</form>
			</div>
		</div>
	</div>
	<div id="imger">
		
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