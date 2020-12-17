<?php
	include '../auth/conn.php';
	session_start();

	if(isset($_POST["course_id"]) && !empty($_POST["course_id"]) && empty($_POST["section_id"])){
	    //Get all state data
	    $sql = "SELECT section, B.id FROM class A join section B on B.id = A.section_id where course_id = '".$_POST["course_id"]."' and teacher_id = '".$_SESSION['id_number']."'";
	    $query = $conn->query($sql);
	    
	    //Count total number of rows
	    $rowCount = $query->num_rows;
	    
	    //Display states list
	    if($rowCount > 0){
	        echo '<option value="">Select section</option>';
	        while($row = $query->fetch_assoc()){ 
	            echo '<option value="'.$row['id'].'">'.$row['section'].'</option>';
	        }
	    }else{
	    	echo '<option value="">Sections not available</option>';
	    }
	}


	if(isset($_POST["section_id"]) && !empty($_POST["section_id"])){

	    //Get all state data
	    $sql = "SELECT A.id as 'student_info_id', fname, lname, mname, id_number, (select count(remarks) from attendance where remarks = 'P' and attendance.class_id=C.id and attendance.student_info_id=A.id) as 'present', (select count(remarks) from attendance where remarks = 'A' and attendance.class_id=C.id and attendance.student_info_id=A.id) as 'absent', (select count(remarks) from attendance where remarks = 'L' and attendance.class_id=C.id and attendance.student_info_id=A.id) as 'late' FROM `student_info` A join user B on B.id_number = A.student_id join class C on C.course_id = A.course_id and C.section_id = A.section_id where A.course_id = '".$_POST["course_id"]."' and A.section_id = '".$_POST["section_id"]."' order by B.lname";

	    $query = $conn->query($sql);
	    
	    //Count total number of rows
	    $rowCount = $query->num_rows;
	    
	    //Display states list
	    if($rowCount > 0){
	        echo "<table>
	        	  <tr>
					<th>Student</th>
					<th>Status</th>
					<th>Action</th>
				  </tr>";
	        while($row = $query->fetch_assoc()){ 
	            echo "<tr>
	            		<td>
	            			".$row['fname']." ".$row['mname']." ".$row['lname']."<br>
	            			".$row['id_number']."
	            		</td>
	            		<td>
	            			Present: ".$row['present']."<br>
	            			Absent: ".$row['absent']."<br>
	            			Late: ".$row['late']."
	            		</td>
	            		<td><a href='edit.php?data=".$row['id_number']."'>
							<button class='btn btn-success btn-block btn-sm'>Edit</button>
							</a>
						</td>
	            	 </tr>
	            ";
					}
					echo "</table>";
	    }else{
	    	echo "<table><tr>
					<th>Student</th>
					<th>Status</th>
					<th>Action</th>
				  </tr>
				  <tr>
				  	<td colspan=3>
				  		No data available
				  	</td>
				  </tr></table>
				  ";
	    }
	}
?>