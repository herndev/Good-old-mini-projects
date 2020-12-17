<?php
	include '../auth/conn.php';
	session_start();

	if(isset($_POST['update']) && isset($_POST['section']) && isset($_POST['course']) && isset($_POST['mdate'])){
		$section = $_POST['section'];
		$course = $_POST['course'];
		$sql = "SELECT * from section where section = $section";
		$query = $conn->query($sql);
		if($row = $query->fetch_assoc()){
			$section = $row['id'];
		}
		$sql = "SELECT * from course where course = $section";
		$query = $conn->query($sql);
		if($row = $query->fetch_assoc()){
			$course = $row['id'];
		}

		$sql = "SELECT A.id as 'std_id', C.id as 'class_id', A.student_id as 'id_number', B.lname, B.mname, B.fname from `student_info` A join user B on B.id_number = A.student_id join class C on C.course_id = A.course_id and C.section_id = A.section_id where C.course_id='$course' and C.section_id='$section' and C.teacher_id = '".$_SESSION['id_number']."' order by B.lname";
		$query = $conn->query($sql);
		while($row = $query->fetch_assoc()){
			if(!empty($_POST[$row['id_number']])){
				$rm = $_POST[$row['id_number']];
			}else{
				$rm = "A";
			}

			$tz = ini_get('date.timezone');
			$dtz = new DateTimeZone($tz);
			$dt = new DateTime('now', $dtz);
			$dt = $dt->format('H:m:i');
			$date = $_POST['mdate']." ".$dt;

			$sql = "SELECT * from attendance where student_info_id = '".$row['std_id']."' and class_id = '".$row['class_id']."' and date_and_time like '".$_POST['mdate']." %'";
			$query2 = $conn->query($sql);
			if($row2 = $query2->fetch_assoc()){
				if($rm != $row2['remarks']){
					$sql = "update attendance set remarks='$rm', date_and_time='$date' where id = '".$row2['id']."'";
					if($conn->query($sql)){}
				}
			}else{
				$sql = "insert into attendance(class_id, student_info_id,	remarks, date_and_time) values('".$row['class_id']."', '".$row['std_id']."', '$rm', '$date')";
				if($conn->query($sql)){}
			}
		}
	}
?>
<!DOCTYPE html>
<html>
<head>
	<title>Attendance</title>
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
	</style>
</head>
<body>
	<div class="container">
		<legend class="xl font-weight-bold mt-5">ATTENDANCE</legend>
		<form action="<?php $_SERVER['PHP_SELF'] ?>" class="form-group" method="post">
			<div class="row">
				<div class="col-lg-4">
					<select class="custom-select" name="course" id="course">
						<option>Select course</option>
						<?php
							$sql = "SELECT DISTINCT course_code, B.id FROM `class` A join course B on B.id = A.course_id 
							where A.teacher_id = '".$_SESSION['id_number']."'";
							$result = $conn->query($sql);
							while($row = $result->fetch_assoc()){
						?>
						<option value="<?php echo $row['id']; ?>"><?php echo $row['course_code']; ?></option>
						<?php
							}
						?>
					</select>
				</div>
				<div class="col-lg-4">
					<select class="custom-select" name="section" id="section">
						<option>Select section</option>
					</select>
				</div>
				<div class="col-lg-4">
					<input type="date" name="mdate" class="form-control" id="mdate" onchange="udate()">
				</div>
			</div>
			<div class="row mt-3">
				<div class="col-lg-12" id="dete">
					<table>
							<tr>
								<th>Student Name</th>
								<th width="40px" class="pal font-weight-bold xl text-center">P</th>
								<th width="40px" class="pal font-weight-bold xl text-center">L</th>
								<th width="40px" class="pal font-weight-bold xl text-center">A</th>
							</tr>
							<tr>
								<td colspan=4>
									Please specify course and section.
								</td>
							</tr>
						</table>
				</div>
			</div>
			<button class="btn btn-success btn-block btn-lg mt-3" name="update" type="submit">UPDATE</button>
		</form>
	</div>
<script type="text/javascript" src="../js/jquery.min.js"></script>
<script type="text/javascript" src="../js/style.js"></script>
<script type="text/javascript">
	document.getElementById('mdate').disabled = "true";

	function udate(){
		if(document.getElementById('mdate').value.length == 10){
			var sectionID = $(this).val();
			var courseID = $('#course').val();

			console.log(document.getElementById('mdate').value);
		}
	}

	$(document).ready(function(){
		document.getElementById('mdate').valueAsDate = new Date();
		$('#course').on('change',function(){
				var courseID = $(this).val();
				if(courseID){
						$.ajax({
								type:'POST',
								url:'../auth/ajaxData2.php',
								data:'course_id='+courseID,
								success:function(html){
										$('#section').html(html);
										$('#dete').html("<table><tr><th>Student Name</th><th width='40px' class='pal font-weight-bold xl text-center'>P</th><th width='40px' class='pal font-weight-bold xl text-center'>L</th><th width='40px' class='pal font-weight-bold xl text-center'>A</th></tr><tr><td colspan=4>Please specify course and section.</td></tr></table>");
										// $('#city').html('<option value="">Select state first</option>'); 
								}
						}); 
				}
				else{
						$('#section').html('<option value="">Select course first</option>');
						$('#dete').html("<table><tr><th>Student Name</th><th width='40px' class='pal font-weight-bold xl text-center'>P</th><th width='40px' class='pal font-weight-bold xl text-center'>L</th><th width='40px' class='pal font-weight-bold xl text-center'>A</th></tr><tr><td colspan=4>Please specify course and section.</td></tr></table>");
				}
		});

		$('#section').on('change',function(){
				var sectionID = $(this).val();
				var courseID = $('#course').val();
				var dateID = $('#mdate').val();
				
				if(sectionID){
					$.ajax({
							type:'POST',
							url:'../auth/ajaxData2.php',
							data:'section_id='+sectionID+"&course_id="+courseID+"&date_id="+dateID,
							success:function(html){
								if (html!="") {
									document.getElementById('mdate').disabled = "";	
									$('#dete').html(html);
								}else{
									document.getElementById('mdate').disabled = "true";	
									$('#dete').html("<table><tr><th>Student Name</th><th width='40px' class='pal font-weight-bold xl text-center'>P</th><th width='40px' class='pal font-weight-bold xl text-center'>L</th><th width='40px' class='pal font-weight-bold xl text-center'>A</th></tr><tr><td colspan=4>No students available</td></tr></table>");
								}
							}
					});
				}
				else{
						document.getElementById('mdate').disabled = "true";	
						$('#dete').html("<table><tr><th>Student Name</th><th width='40px' class='pal font-weight-bold xl text-center'>P</th><th width='40px' class='pal font-weight-bold xl text-center'>L</th><th width='40px' class='pal font-weight-bold xl text-center'>A</th></tr><tr><td colspan=4>No students available</td></tr></table>");
				}
		});


		$('#mdate').on('change',function(){
				if(document.getElementById('mdate').value.length == 10){
					var sectionID = $('#section').val();
					var courseID = $('#course').val();
					var dateID = $('#mdate').val();

					if(dateID){
						$.ajax({
							type:'POST',
							url:'../auth/ajaxData2.php',
							data:'section_id='+sectionID+"&course_id="+courseID+"&date_id="+dateID,
							success:function(html){
								if (html!="") {
									document.getElementById('mdate').disabled = "";	
									$('#dete').html(html);
								}else{
									document.getElementById('mdate').disabled = "true";	
									$('#dete').html("<table><tr><th>Student Name</th><th width='40px' class='pal font-weight-bold xl text-center'>P</th><th width='40px' class='pal font-weight-bold xl text-center'>L</th><th width='40px' class='pal font-weight-bold xl text-center'>A</th></tr><tr><td colspan=4>No students available</td></tr></table>");
								}
							}
					});
				}
				else{
						document.getElementById('mdate').disabled = "true";	
						$('#dete').html("<table><tr><th>Student Name</th><th width='40px' class='pal font-weight-bold xl text-center'>P</th><th width='40px' class='pal font-weight-bold xl text-center'>L</th><th width='40px' class='pal font-weight-bold xl text-center'>A</th></tr><tr><td colspan=4>No students available</td></tr></table>");
					}
				}

				
		});
	});
</script>
</body>
</html>