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
		tr, th, td{
			border: 1px solid;
			padding: 5px 20px;
		}
		form input{
			float: left;
		}
		
		.scrll-t{
			height: 200px;
			overflow-y: auto;
			overflow-x: hidden;
			/*border: 1px solid;*/
		}
		.tb-bot{
			width: 80vw;
		}
		th{
			height: 20px;
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
				<div class="row">
					<div class="col-lg-6 pr-0">
						<input type="text" name="search_input" class="form-control" placeholder="Teacher, course, sect..">
					</div>
					<div class="col-lg-6">
						<button class="btn btn-primary">Search</button>
					</div>
					<div class="row scrll-t mt-2 mr-2">
						<div class="col-lg-6 pl-4 ml-1">
							<table class="mt-4 tb-top">
								<tr>
									<th>Teacher</th>
									<th>Courses</th>
									<th>Classes</th>
									<th>Action</th>
								</tr>
								<?php
									$sql = "select * from user A join type B on A.type_id = B.id where B.type = 'teacher'";
									$result = $conn->query($sql);
									while($row = $result->fetch_assoc()){
										$sql = "select * from class A join course B on A.course_id = B.id join section C on A.section_id = C.id join classroom D on A.classroom_id = D.id join bldg E on D.bldg_id = E.id";
										$result2 = $conn->query($sql);
										while($row2 = $result2->fetch_assoc()){
								?>
									<tr>
										<td><?php echo $row['lname'].", ".$row['fname'];?></td>
										<td>OOP, Understanding The Self</td>
										<td>IT101 [Bld 9-103 (2R6)]</td>
										<td><button>Edit</button></td>
									</tr>
								<?php
									}}
								?>
							</table>
						</div>
					</div>
				</div>
			</div>
			<div class="col-lg-6">
				<div class="row">
					<div class="col-lg-6 pr-0">
						<input type="text" name="search_input" class="form-control" placeholder="Teacher, course, sect..">
					</div>
					<div class="col-lg-6">
						<button class="btn btn-primary">Search</button>
					</div>
					<div class="row scrll-t mt-2">
						<div class="col-lg-6 pl-4 ml-1  ml-2">
							<table class="mt-4 tb-top">
								<tr>
									<th>Student</th>
									<th>Courses</th>
									<th>Sections</th>
									<th>Action</th>
								</tr>
								
							</table>
						</div>
					</div>
				</div>
			</div>
		</div>
		<div class="row">
			<div class="col-lg-6 mt-5">
				<form class="form-group">
					<div class="row">
						<div class="col-lg-6 pr-0">
							<input type="text" name="search_input" class="form-control" placeholder="Teacher, course, sect..">
						</div>
						<div class="col-lg-6">
							<button class="btn btn-primary">Search</button>
						</div>
					</div>
				</form>
				<table class="mt-4 tb-bot">
					<tr>
						<th>Date</th>
						<th>Courses & Section</th>
						<th>Teacher</th>
						<th>Student</th>
						<th>Action</th>
					</tr>
					<tr>
						<td>Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod
						tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam,
						quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo
						consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse
						cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non
						proident, sunt in culpa qui officia deserunt mollit anim id est laborum.</td>
						<td>Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod
						tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam,
						quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo
						consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse
						cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non
						proident, sunt in culpa qui officia deserunt mollit anim id est laborum.</td>
						<td>Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod
						tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam,
						quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo
						consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse
						cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non
						proident, sunt in culpa qui officia deserunt mollit anim id est laborum.</td>
						<td>Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod
						tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam,
						quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo
						consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse
						cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non
						proident, sunt in culpa qui officia deserunt mollit anim id est laborum.</td>
						<td>Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod
						tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam,
						quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo
						consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse
						cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non
						proident, sunt in culpa qui officia deserunt mollit anim id est laborum.</td>
					</tr>
				</table>
			</div>
		</div>
	</div>
</body>
</html>