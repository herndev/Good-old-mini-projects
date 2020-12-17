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


	if(isset($_POST["section_id"]) && !empty($_POST["section_id"]) && empty($_POST["date_id"])){

	    //Get all state data
	    $sql = "SELECT A.id as 'student_info_id', fname, lname, mname, id_number, (select count(remarks) from attendance where remarks = 'P' and attendance.class_id=C.id and attendance.student_info_id=A.id) as 'present', (select count(remarks) from attendance where remarks = 'A' and attendance.class_id=C.id and attendance.student_info_id=A.id) as 'absent', (select count(remarks) from attendance where remarks = 'L' and attendance.class_id=C.id and attendance.student_info_id=A.id) as 'late' FROM `student_info` A join user B on B.id_number = A.student_id join class C on C.course_id = A.course_id and C.section_id = A.section_id where A.course_id = '".$_POST["course_id"]."' and A.section_id = '".$_POST["section_id"]."'";

	    $query = $conn->query($sql);
	    
	    //Count total number of rows
	    $rowCount = $query->num_rows;
	    
	    //Display states list
	    if($rowCount > 0){
	        echo "<table>
					<tr>
					<th>Student Name</th>
					<th width='40px' class='pal font-weight-bold xl text-center'>P</th>
					<th width='40px' class='pal font-weight-bold xl text-center'>L</th>
					<th width='40px' class='pal font-weight-bold xl text-center'>A</th>
				</tr>";
	        while($row = $query->fetch_assoc()){ 
							echo "<tr>
									<td colspan=4>
										".$row['fname']." ".$row['mname']." ".$row['lname']."
									</td>
	            	 </tr>
	            	</table>";
	        }
	    }else{
	    	echo "";
	    }
	}





	if(isset($_POST["date_id"]) && !empty($_POST["date_id"])){
		$count11 = 0;
		$headerer = '';
		$sql = "SELECT (select count(*) from attendance C join class B on B.id = C.class_id where B.course_id='".$_POST["course_id"]."' and B.section_id='".$_POST["section_id"]."' and B.teacher_id = '".$_SESSION['id_number']."' and C.date_and_time like '".$_POST["date_id"]." %') as 'total', (select count(*) from attendance C join class B on B.id = C.class_id where B.course_id='".$_POST["course_id"]."' and B.section_id='".$_POST["section_id"]."' and B.teacher_id = '".$_SESSION['id_number']."' and remarks=A.remarks and C.date_and_time like '".$_POST["date_id"]." %') as 'count', A.remarks from attendance A join class B on B.id = A.class_id where B.course_id='".$_POST["course_id"]."' and B.section_id='".$_POST["section_id"]."' and B.teacher_id = '".$_SESSION['id_number']."' and A.date_and_time like '".$_POST["date_id"]." %' group by remarks order by A.remarks desc";
		$query2 = $conn->query($sql);
		while($row2 = $query2->fetch_assoc()){
			if ($count11 == 0) {
				$headerer = "Total#: ".$row2['total'];
			}
			$count11 = 2;
			if($row2['remarks'] == 'P'){
				$headerer = $headerer."<span style='margin-left:30px;'>#Present: ".$row2['count']."</span>";
			}
			elseif($row2['remarks'] == 'L'){
				$headerer = $headerer."<span style='margin-left:30px;'>#Late: ".$row2['count']."</span>";
			}
			else{
				$headerer = $headerer."<span style='margin-left:30px;'>#Absent: ".$row2['count']."</span>";
			}
		}
		if ($headerer == '') {
			$headerer = 'Student Name';
		}

		//Get all state data
		$sql = "SELECT A.id as 'std_id', C.id as 'class_id', A.student_id as 'id_number', B.lname, B.mname, B.fname from `student_info` A join user B on B.id_number = A.student_id join class C on C.course_id = A.course_id and C.section_id = A.section_id where C.course_id='".$_POST["course_id"]."' and C.section_id='".$_POST["section_id"]."' and C.teacher_id = '".$_SESSION['id_number']."' order by B.lname";
		$query = $conn->query($sql);
		$rowCount = $query->num_rows;
		
		//Display states list
		if($rowCount > 0){
				echo "<table>
				<tr>
				<th>$headerer</th>
				<th width='40px' class='pal font-weight-bold xl text-center'>P</th>
				<th width='40px' class='pal font-weight-bold xl text-center'>L</th>
				<th width='40px' class='pal font-weight-bold xl text-center'>A</th>
				</tr>";
				while($row = $query->fetch_assoc()){
					$rm = ["","",""];
					// $date = explode(" ",$row['date_and_time'])[0];
					$sql = "SELECT remarks from attendance where class_id = '".$row['class_id']."' and student_info_id = '".$row['std_id']."' and date_and_time like '".$_POST['date_id']." %'";
					$query3 = $conn->query($sql);
					if($row3 = $query3->fetch_assoc()){
						if($row3['remarks'] == "P"){
							$rm[0] = "checked";
						}elseif ($row3['remarks'] == "L") {
							$rm[1] = "checked";
						}else {
							$rm[2] = "checked";
						}
					}

					echo "<tr>
									<td>".$row['lname'].", ".$row['fname']."
									</td><td>
									<input type='radio' name='".$row['id_number']."' value='P' $rm[0]>
									</td><td>
									<input type='radio' name='".$row['id_number']."' value='L' $rm[1]>
									</td><td>
									<input type='radio' name='".$row['id_number']."' value='A' $rm[2]>
									</td>
								</tr>";
			}
			echo "</table>";
		}else{
			echo "";
		}
}
?>