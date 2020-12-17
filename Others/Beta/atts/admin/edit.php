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
		$id_s = explode(" ", $_POST['id_s']);

		$sql = "update user set id_number = '$id_numberer', fname = '$fname', mname = '$mname', lname = '$lname' where id_number = '$id_number'";
		if($conn->query($sql)===TRUE){
			if ($id_s != []) {
				for ($i=0; $i < sizeof($id_s); $i++) {
					if ($type == 'teacher') {
						$sql = "delete from class where id='".$id_s[$i]."'";
						$conn->query($sql);
					}else{
						$sql = "delete from student_info where id='".$id_s[$i]."'";
						$conn->query($sql);
					}
					
				}
			}
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
				<legend class="mt-5 font-weight-bold">
					<?php 
						if ($type == 'teacher') {
							echo "Teacher's Classes";
						}else{
							echo "Student's Classes";
						}
					?>
				</legend>
				<form action="<?php $_SERVER['PHP_SELF'] ?>" method="POST">
				<input type="text" name="id_number" class="form-control mt-2" placeholder="ID Number" value="<?php echo $id_number; ?>">

				<!-- disabled="disabled" -->
				<div class="row">
					<div class="col-lg-4"><input type="text" name="fname" class="form-control mt-2" placeholder="First Name" value="<?php echo $fname; ?>"></div>
					<div class="col-lg-4"><input type="text" name="mname" class="form-control mt-2" placeholder="Middle Name" value="<?php echo $mname; ?>"></div>
					<div class="col-lg-4"><input type="text" name="lname" class="form-control mt-2" placeholder="Last Name" value="<?php echo $lname; ?>"></div>
				</div>
				<div class="row tbl-div ml-0 mt-2">
					<div class="col-lg-12 pl-0 pr-0">
						<table class="tbl-m">
							<?php
							if ($type == 'teacher') {
							?>
							<tr>
								<th>Course</th>
								<th>Section</th>
								<th>Room</th>
								<th>Time</th>
								<th>Action</th>
							</tr>
							<?php
								}else{
							?>
							<tr>
								<th>Course</th>
								<th>Section</th>
								<th>Teacher</th>
								<th>Action</th>
							</tr>
							<?php
								}
								if ($type == 'teacher') {
								$sql = "SELECT A.id, B.course_code, C.section, E.bldg, D.room_number, A.time_start, A.time_end from class A join course B on B.id = A.course_id join section C on C.id = A.section_id join classroom D on D.id = A.classroom_id join bldg E on E.id = D.bldg_id where teacher_id = '".$id_number."'";
								$result = $conn->query($sql);
								while($row = $result->fetch_assoc()){
							?>
							<tr class="r">
								<td><?php echo $row['course_code']; ?></td>
								<td><?php echo $row['section']; ?></td>
								<td><?php echo $row['bldg']."-".$row['room_number']; ?></td>
								<td><?php echo $row['time_start']."-".$row['time_end']; ?></td>
								<td><button class="btn btn-danger btn-block" id="<?php echo $row['id']; ?>">Remove</button></td>
							</tr>
							<?php
								}}else{
									$sql = "SELECT s.id, c.course_code, sc.section, u.fname, u.mname, u.lname from student_info s join course c on c.id = s.course_id join section sc on sc.id = s.section_id join class cl on cl.course_id =c.id and cl.section_id = sc.id join user u on u.id_number = cl.teacher_id WHERE s.student_id = '".$id_number."'";
									$result = $conn->query($sql);
									while($row = $result->fetch_assoc()){
							?>

							<tr class="r">
								<td><?php echo $row['course_code']; ?></td>
								<td><?php echo $row['section']; ?></td>
								<td><?php echo $row['fname']." ".$row['mname']." ".$row['lname']; ?></td>
								<td><button class="btn btn-danger btn-block" id="<?php echo $row['id']; ?>">Remove</button></td>
							</tr>
							<?php  
								}}
							?>
						</table>
					</div>
				</div>
				<input type="text" name="id_s" value="" id="id_s">
				<div class="row mt-3">
					<div class="col-lg-6">
						<button type="submit" class="btn btn-block btn-success" name="update">Update</button>
					</div>
					</form>
					<div class="col-lg-6">
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
	var id_s = '';
	var btns = document.getElementsByTagName('button');
	for (var i =  0; i < btns.length-2; i++) {
		btns[i].addEventListener("click", remover);
	}

	function remover(){
		id_s = this.id;
		id_s = id_s + " " + document.getElementById('id_s').value;
		document.getElementById('id_s').value = id_s;
		// console.log(document.getElementById('id_s').value);
		document.getElementById(this.id).parentNode.parentNode.remove();
	}
	
</script>
</body>
</html>