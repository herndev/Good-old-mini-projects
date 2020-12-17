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
	</style>
</head>
<body>
	<div class="container">
		<div class="row mt-5">
			<div class="col-lg-12">
				<a href="new_student.php">
					<button class="btn btn-success">+ New student</button>
				</a>
			</div>
		</div>
		<div class="row mt-3">
			<div class="col-lg-6">
				<select class="custom-select" name="course" id="course">
					<option value="">Select course</option>
					<?php
						$sql = "SELECT DISTINCT course_code, B.id FROM `class` A join course B on B.id = A.course_id where A.teacher_id = '".$_SESSION['id_number']."'";

						$result = $conn->query($sql);
						while($row = $result->fetch_assoc()){
					?>
					<option value="<?php echo $row['id']; ?>"><?php echo $row['course_code']; ?></option>
					<?php
						}
					?>
				</select>
			</div>
			<div class="col-lg-6">
				<select class="custom-select" id="section" name='section'>
					<option value="">Select section</option>
				</select>
			</div>
		</div>
		<div class="row mt-3">
			<div class="col-lg-12">
				<div id="dete">
					<table><tr>
					<th>Student</th>
					<th>Status</th>
					<th>Action</th>
				  </tr>
				  <tr>
				  	<td colspan=3>
				  		Please specify course and section.
				  	</td>
				  </tr></table>
				</div>
			</div>
		</div>
	</div>
<script type="text/javascript" src="../js/jquery.min.js"></script>
<script type="text/javascript" src="../js/style.js"></script>
<script type="text/javascript">
	$(document).ready(function(){
	    $('#course').on('change',function(){
	        var courseID = $(this).val();
	        if(courseID){
	            $.ajax({
	                type:'POST',
	                url:'../auth/ajaxData.php',
	                data:'course_id='+courseID,
	                success:function(html){
	                    $('#section').html(html);
	                    // $('#city').html('<option value="">Select state first</option>'); 
	                }
	            }); 
	        }
	        else{
	            $('#section').html('<option value="">Select course first</option>');
	        }
	    });

	    $('#section').on('change',function(){
	        var sectionID = $(this).val();
	        var courseID = $('#course').val();
	        if(sectionID){
	            $.ajax({
	                type:'POST',
	                url:'../auth/ajaxData.php',
	                data:'section_id='+sectionID+"&course_id="+courseID,
	                success:function(html){
	                	$('#dete').html(html);
	                    // $('#section').html(html);
	                    // $('#city').html('<option value="">Select state first</option>'); 
	                }
	            }); 
	            // console.log(courseID);
	        }
	        else{
	            $('#section').html('<option value="">Select course first</option>');
	        }
	    });
	});
</script>
</body>
</html>