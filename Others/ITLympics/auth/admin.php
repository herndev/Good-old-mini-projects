<?php
	include "./config/conn.php";
	$txt = "";
	$data = "";
	$count = 0;
	$crtdate = "";

	defaults();
	
	function defaults()
	{
		global $data;
		global $count;
		global $crtdate;
		global $conn;
		$cc = 1;

		$sql = "Select date, count(*) as 'count' from tbstudent group by date order by date desc";
		$result = $conn->query($sql);
		while($row = $result->fetch_assoc()){
			$date[$row['date']] = $row['count'];
		}
		/*
		$count = count(array_keys($date));
		$keys = array_keys($date);
		for ($i=0; $i < $count; $i++) { 
			echo $date[$keys[$i]]."<br>";
		}
		*/
		$sql = "Select * from tbstudent order by date desc";
		$result = $conn->query($sql);
		while($row = $result->fetch_assoc()){
			if($crtdate != $row['date']){
				if ($cc != 1) {
					$data = $data."</table>";
				}
				$cc = $cc + 1;
				$data = $data."<table class='table-data' text-color='white'>
						<tr>
							<th colspan=5>DATE: ".$row['date']."<br>
							# of students: ".$date[$row['date']]."</th>
						</tr>
						<tr>
							<th>Action</th>
							<th>Time</th>
							<th>ID Number</th>
							<th>Year&Section</th>
							<th>Name</th>
						</tr>";
				$data = $data."<tr>
							<td>
								<a href='edit.php?edit=".$row['id']."'>Edit</a>
							</td>
							<td>".$row['time']." ".$row['daytime']."</td>
							<td>".$row['idnumber']." </td>
							<td>".$row['year']."R".$row['section']."</td>
							<td>".$row['name']."</td>
						</tr>";
				$crtdate = $row['date'];
			}else{
				$data = $data."<tr>
							<td>
								<a href='edit.php?edit=".$row['id']."'>Edit</a>
							</td>
							<td>".$row['time']." ".$row['daytime']."</td>
							<td>".$row['idnumber']." </td>
							<td>".$row['year']."R".$row['section']."</td>
							<td>".$row['name']."</td>
						</tr>";
			}
		}
	}





	if (isset($_POST['srch'])) {
		$data = "";
		$txt = $_POST['srch-text'];
		$count = 0;
		$y = 0;
		$s = 0;
		if($txt != "" && $txt != "1st" && $txt != "2nd" && $txt != "3rd" && $txt != "4th"){
			if (strlen($txt)==3){
				$y = substr($txt, 0, 1);
				$s = substr($txt, -1, strlen($txt));
			}

			$sql = "Select count(*) as 'count' from tbstudent where idnumber like '".$txt."%' or name like '".$txt."%' or date like '".$txt."%' or idnumber like '%".$txt."' or name like '%".$txt."' or date like '%".$txt."' or year = '".$y."' and section = '".$s."' order by date desc";
			$result = $conn->query($sql);
			if($row = $result->fetch_assoc()){
				$count = $row['count'];
			}


			$data = $data."<table class='table-data' text-color='white'>
							<tr>
								<th colspan=6>Results for: ".$txt."<br>
								# of students: ".$count."</th>
							</tr>
							<tr>
								<th>Action</th>
								<th>Date</th>
								<th>Time</th>
								<th>ID Number</th>
								<th>Year&Section</th>
								<th>Name</th>
							</tr>";



			$sql = "Select * from tbstudent where idnumber like '".$txt."%' or name like '".$txt."%' or date like '".$txt."%' or idnumber like '%".$txt."' or name like '%".$txt."' or date like '%".$txt."' or year = '".$y."' and section = '".$s."' order by date desc";
			$result = $conn->query($sql);
			while($row = $result->fetch_assoc()){
				$data = $data."<tr>
								<td>
									<a href='edit.php?edit=".$row['id']."'>Edit</a> 
								</td>
								<td>".$row['date']."</td>
								<td>".$row['time']." ".$row['daytime']."</td>
								<td>".$row['idnumber']." </td>
								<td>".$row['year']."R".$row['section']."</td>
								<td>".$row['name']."</td>
							</tr>";
			}
		}
		elseif ($txt == "1st") {
			$sql = "Select count(*) as 'count' from tbstudent where year=1";
			$result = $conn->query($sql);
			if($row = $result->fetch_assoc()){
				$count = $row['count'];
			}

			$data = $data."<table class='table-data' text-color='white'>
							<tr>
								<th colspan=6>Results for: ".$txt."<br>
								# of students: ".$count."</th>
							</tr>
							<tr>
								<th>Action</th>
								<th>Date</th>
								<th>Time</th>
								<th>ID Number</th>
								<th>Year&Section</th>
								<th>Name</th>
							</tr>";



			$sql = "Select * from tbstudent where year = 1";
			$result = $conn->query($sql);
			while($row = $result->fetch_assoc()){
				$data = $data."<tr>
								<td>
									<a href='edit.php?edit=".$row['id']."'>Edit</a> 
								</td>
								<td>".$row['date']."</td>
								<td>".$row['time']." ".$row['daytime']."</td>
								<td>".$row['idnumber']." </td>
								<td>".$row['year']."R".$row['section']."</td>
								<td>".$row['name']."</td>
							</tr>";
			}
		}
		elseif ($txt == "2nd") {
			$sql = "Select count(*) as 'count' from tbstudent where year=2";
			$result = $conn->query($sql);
			if($row = $result->fetch_assoc()){
				$count = $row['count'];
			}

			$data = $data."<table class='table-data' text-color='white'>
							<tr>
								<th colspan=6>Results for: ".$txt."<br>
								# of students: ".$count."</th>
							</tr>
							<tr>
								<th>Action</th>
								<th>Date</th>
								<th>Time</th>
								<th>ID Number</th>
								<th>Year&Section</th>
								<th>Name</th>
							</tr>";



			$sql = "Select * from tbstudent where year = 2";
			$result = $conn->query($sql);
			while($row = $result->fetch_assoc()){
				$data = $data."<tr>
								<td>
									<a href='edit.php?edit=".$row['id']."'>Edit</a> 
								</td>
								<td>".$row['date']."</td>
								<td>".$row['time']." ".$row['daytime']."</td>
								<td>".$row['idnumber']." </td>
								<td>".$row['year']."R".$row['section']."</td>
								<td>".$row['name']."</td>
							</tr>";
			}
		}
		elseif ($txt == "3rd") {
			$sql = "Select count(*) as 'count' from tbstudent where year=3";
			$result = $conn->query($sql);
			if($row = $result->fetch_assoc()){
				$count = $row['count'];
			}

			$data = $data."<table class='table-data' text-color='white'>
							<tr>
								<th colspan=6>Results for: ".$txt."<br>
								# of students: ".$count."</th>
							</tr>
							<tr>
								<th>Action</th>
								<th>Date</th>
								<th>Time</th>
								<th>ID Number</th>
								<th>Year&Section</th>
								<th>Name</th>
							</tr>";



			$sql = "Select * from tbstudent where year = 3";
			$result = $conn->query($sql);
			while($row = $result->fetch_assoc()){
				$data = $data."<tr>
								<td>
									<a href='edit.php?edit=".$row['id']."'>Edit</a> 
								</td>
								<td>".$row['date']."</td>
								<td>".$row['time']." ".$row['daytime']."</td>
								<td>".$row['idnumber']." </td>
								<td>".$row['year']."R".$row['section']."</td>
								<td>".$row['name']."</td>
							</tr>";
			}
		}
		elseif ($txt == "4th") {
			$sql = "Select count(*) as 'count' from tbstudent where year=4";
			$result = $conn->query($sql);
			if($row = $result->fetch_assoc()){
				$count = $row['count'];
			}

			$data = $data."<table class='table-data' text-color='white'>
							<tr>
								<th colspan=6>Results for: ".$txt."<br>
								# of students: ".$count."</th>
							</tr>
							<tr>
								<th>Action</th>
								<th>Date</th>
								<th>Time</th>
								<th>ID Number</th>
								<th>Year&Section</th>
								<th>Name</th>
							</tr>";



			$sql = "Select * from tbstudent where year = 4";
			$result = $conn->query($sql);
			while($row = $result->fetch_assoc()){
				$data = $data."<tr>
								<td>
									<a href='edit.php?edit=".$row['id']."'>Edit</a> 
								</td>
								<td>".$row['date']."</td>
								<td>".$row['time']." ".$row['daytime']."</td>
								<td>".$row['idnumber']."</td>
								<td>".$row['year']."R".$row['section']."</td>
								<td>".$row['name']."</td>
							</tr>";
			}
		}
		else{
			header('location: admin.php');
		}
	}



	if (isset($_GET['log'])) {
		header('location: admin.php');
	}

	// if (isset($_GET['print'])) {
	// 	echo "
	// 		<script>
	// 			$('.table-data').tableExport();
	// 		</script>
	// 	";
	// }

	

	if (isset($_GET['delete'])) {
		$id = $_GET['delete'];
		$sql = "DELETE FROM `tbstudent` WHERE id=$id";
		if($conn->query($sql)===TRUE){
			$data = "<script>alert('Data successfully deleted.');</script>";
			header('location: ./admin.php');
		}else{
			$data = "<script>alert('Server error unable to delete.');</script>";
			header('location: ./admin.php');
		}
	}









	/*-------------------------------------------------------------------------------------------------
		if($date == $row['date']){
			$data = $data."<tr>
						<td>".$row['time']." ".$row['daytime']."</td>
						<td>".$row['idnumber']."</td>
						<td>".$row['year']."R".$row['section']."</td>
						<td>".$row['name']."</td>
					</tr>";
		}else{
			if($data != ""){
				$data = $data."<tr>
						<th colspan=4>DATE: ".$row['date']."<br>
						# of students: ".$count."</th>
					</tr>
					<tr>
						<th>Time</th>
						<th>ID Number</th>
						<th>Year&Section</th>
						<th>Name</th>
					</tr>";
			}
			$count = 0;
		}
		*/
?>