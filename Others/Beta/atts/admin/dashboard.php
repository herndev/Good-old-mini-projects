<?php
	include '../auth/conn.php';
	session_start();
?>
<!DOCTYPE html>
<html>
<head>
	<title>Dashboard</title>
	<link rel="stylesheet" type="text/css" href="../css/style.css">
	<style type="text/css">
		table{
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
/*		
		.scrll-t{
			height: 200px;
			overflow-y: auto;
			overflow-x: hidden;
			/*border: 1px solid;*/
		.tb-bot{
			width: 80vw;
			height: 200px;
			overflow-y: auto;
			overflow-x: hidden;
		}
		.tb-botbot{
			width: 80vw;
		}

		.tb-bot table{
			width: 100%;
		}
		.tb-bb{
			height: 400px;
		}
		.xx{
			background: #007bff;
		}
		.xx:hover{
			background: #007bff;
		}
		.xx1{
			background: #ffc107;
		}
		.xx1:hover{
			background: #ffc107;
		}
		/*#17a2b8*/
		.xx2{
			background: #17a2b8;
		}
		.xx2:hover{
			background: #17a2b8;
		}
		.xxx{
			border-top: 0px solid;
			border-bottom: 0px solid;
		}
		body{
			padding-bottom: 100px;
		}
	</style>
</head>
<body>
	<div class="container">
		<div class="row mt-5">
			<div class="col-lg-6">
				<!-- <div class="row">
					<div class="col-lg-6 pr-0">
						<input type="text" name="search_input" class="form-control" placeholder="Teacher, course, sect..">
					</div>
					<div class="col-lg-6">
						<button class="btn btn-primary">Search</button>
					</div>
				</div> -->
				<table class="mt-4 tb-botbot mb-0 xx1 xxx">
						<tr class="xx1 xxx">
							<th class="xx1 xxx text-center font-weight-bold xl">Teacher</th>
						</tr>
				</table>
				<div class="tb-bot">
					<table class="">
						<tr>
							<th>Teacher</th>
							<th>Courses</th>
							<th>Classes</th>
							<th>Action</th>
						</tr>
						<?php
							$sql = "select * from user A join type B on A.type_id = B.id where B.type = 'teacher' order by lname";
							$result = $conn->query($sql);
							while($row = $result->fetch_assoc()){
								$courses1 = '';
								$classes1 = '';
								$sql = "select * from class A join course B on A.course_id = B.id join section C on A.section_id = C.id join classroom D on A.classroom_id = D.id join bldg E on D.bldg_id = E.id where A.teacher_id = '".$row['id_number']."'";
								$result2 = $conn->query($sql);
								while($row2 = $result2->fetch_assoc()){
									if(strpos($courses1, "[".$row2['course_code']."] ".$row2['course']) === false){
										$courses1 = $courses1."[".$row2['course_code']."] ".$row2['course']."<br>";
									}
									$classes1 = $classes1."".$row2['course_code']." [Blg ".$row2['bldg']."-".$row2['room_number']." (".$row2['section'].")]<br>";
								}
								if (empty($courses1)) {
									$courses1 = 'None';
									$classes1 = 'None';
								}
						?>
							<tr>
								<td><?php echo $row['lname'].", ".$row['fname']."<br>".$row['id_number'];?></td>
								<td><?php echo $courses1; ?></td>
								<td><?php echo $classes1; ?></td>
								<td><a href="edit.php?data=<?php echo $row['id_number']; ?>"><button class="btn btn-success btn-block">Edit</button></a></td>
							</tr>
						<?php
							}
						?>
					</table>
				</div>
				
			</div>
		</div>
		<div class="row mt-5">
			<div class="col-lg-6 btn-block">
				<!-- <div class="row">
					<div class="col-lg-6 pr-0">
						<input type="text" name="search_input" class="form-control" placeholder="Teacher, course, sect..">
					</div>
					<div class="col-lg-6">
						<button class="btn btn-primary">Search</button>
					</div>
				</div> -->
				<table class="mt-4 tb-botbot mb-0 xx2 xxx">
						<tr class="xx2 xxx">
							<th class="xx2 xxx text-center font-weight-bold xl">Student</th>
						</tr>
				</table>
				<div class="tb-bot tb-bb">
					<table class="">
						<tr>
							<th>Student</th>
							<th>Courses</th>
							<th>Status</th>
							<th>Action</th>
						</tr>
						<?php
							$sql = "select * from user A join type B on A.type_id = B.id where B.type = 'student' order by lname";
							$result = $conn->query($sql);
							while($row = $result->fetch_assoc()){
								$courses2 = '';
								$status2 = '';

								$present = '';
								$absent = '';
								$late = '';

								$sql = "select B.course_code, B.course, G.fname as 'Teacher FName', G.mname as 'Teacher MName', G.lname as 'Teacher LName', E.bldg, D.room_number, A.time_start, A.time_end, F.id as 'student_info_id', A.id as 'class_id' from class A join course B on A.course_id = B.id join section C on A.section_id = C.id join classroom D on A.classroom_id = D.id join bldg E on D.bldg_id = E.id join student_info F on A.section_id = F.section_id and A.course_id = F.course_id join user G on G.id_number = A.teacher_id where F.student_id = '".$row['id_number']."'";
								$result2 = $conn->query($sql);
								while($row2 = $result2->fetch_assoc()){
									$courses2 = $courses2."Course: ".$row2['course_code']." (".$row2['course'].")<br>Teacher: ".
									$row2['Teacher FName']." ".$row2['Teacher MName']." ".$row2['Teacher LName']."<br>Room: Bldg ".
									$row2['bldg']."-".$row2['room_number']."<br>Time: ".$row2['time_start']."-".$row2['time_end']."<br><br><br>";

									$sql = "SELECT (select count(remarks) FROM attendance where remarks= 'P' and student_info_id='".$row2['student_info_id']."' and class_id='".$row2['class_id']."') as 'Present',(select count(remarks) FROM attendance where remarks= 'A' and student_info_id='".$row2['student_info_id']."' and class_id='".$row2['class_id']."') as 'Absent', (select count(remarks) FROM attendance where remarks= 'L' and student_info_id='".$row2['student_info_id']."' and class_id='".$row2['class_id']."') as 'Late' FROM `attendance` limit 1";
									$result3 = $conn->query($sql);
									while($row3 = $result3->fetch_assoc()){
										$present = $row3['Present'];
										$absent = $row3['Absent'];
										$late = $row3['Late'];
									}


									$status2 = $status2."Course: ".$row2['course_code']."<br># of Present: ".$present."<br># of Absences: ".$absent."<br># of Lates: ".$late."<br><br><br>";
								}
								if (empty($courses2)) {
									$courses2 = 'None';
									$status2 = 'None';
								}
						?>
							<tr>
								<td><?php echo $row['lname'].", ".$row['fname']."<br>".$row['id_number'];?></td>
								<td><?php echo $courses2; ?></td>
								<td><?php echo $status2; ?></td>
								<td><a href="edit.php?data=<?php echo $row['id_number']; ?>"><button class="btn btn-success btn-block">Edit</button></a></td>
							</tr>
						<?php
							}
						?>
					</table>
				</div>
			</div>
		</div>
		<div class="row">
			<div class="col-lg-6 mt-5">
				<table class="mt-4 tb-botbot mb-0 xx xxx">
						<tr class="xx xxx">
							<th class="xx xxx text-center font-weight-bold xl">LOG</th>
						</tr>
				</table>
				<table class="mt-0 tb-botbot xxx">
					<tr class="xxx">
						<th class="xxx">Date</th>
						<th class="xxx">Courses & Section</th>
						<th class="xxx">Teacher</th>
						<th class="xxx">Student</th>
						<th class="xxx">Status</th>
					</tr>
					<?php
						// , B.teacher_id, D.student_id
						// A.date_and_time, E.section, C.course_code, A.remarks 
						// ORDER by A.date_and_time desc limit 10
						$sql = "SELECT A.date_and_time, E.section, C.course_code, A.remarks, B.teacher_id, D.student_id FROM `attendance` A join class B on A.class_id = B.id join course C on B.course_id = C.id join student_info D on D.id = A.student_info_id join section E on B.section_id = E.id ORDER by A.date_and_time desc limit 10";
						$result = $conn->query($sql);
						
						while($row = $result->fetch_assoc()){
							$date5 = $row['date_and_time'];
							$course_code5 = $row['course_code'];
							$section5 = $row['section'];
							$remarks5 = $row['remarks'];

							if($remarks5 == 'A'){
								$remarks5 = 'ABSENT';
							}
							else if($remarks5 == 'P'){
								$remarks5 = 'PRESENT';
							}
							else{
								$remarks5 = 'LATE';
							}

							$teacher_id5 = $row['teacher_id'];
							$student_id5 = $row['student_id'];
							$std_name = '';
							$t_name = '';

							$sql = "Select (select fname from user where id_number = '".$student_id5."') as 'std_f', (select mname from user where id_number = '".$student_id5."') as 'std_m', (select lname from user where id_number = '".$student_id5."') as 'std_l', (select fname from user where id_number = '".$teacher_id5."') as 't_f', (select mname from user where id_number = '".$teacher_id5."') as 't_m', (select lname from user where id_number = '".$teacher_id5."') as 't_l' from attendance ORDER by date_and_time desc";
							$result5 = $conn->query($sql);
							if($row5 = $result5->fetch_assoc()){
								$t_name = $row5['t_f']." ".$row5['t_m']." ".$row5['t_l'];
								$std_name = $row5['std_f']." ".$row5['std_m']." ".$row5['std_l'];
							}
					?>

					<tr>
						<td><?php echo $date5; ?></td>
						<td><?php echo $course_code5." [".$section5."]"; ?></td>
						<td><?php echo $t_name; ?></td>
						<td><?php echo $std_name; ?></td>
						<td><?php echo $remarks5; ?></td>
					</tr>

					<?php 
						}
					?>
				</table>
			</div>
		</div>
	</div>
<script type="text/javascript" src="../js/jquery.min.js"></script>
<script type="text/javascript" src="../js/style.js"></script>
</body>
</html>