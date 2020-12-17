<?php
	include "./config/conn.php";

	$name = "";
	$idnumber = "";
	$message = "";
	$section = "";
	$year = "";
	$bon = "";

	if (isset($_POST['submit'])) {
		$year = $_POST['year'];
		$year = substr($year, 0, 1);

		$section = $_POST['section'];
		$section = substr($section, 1, strlen($section));

		$name = $_POST['name'];
		$idnumber = $_POST['idnumber'];
		$date = date('m/d/Y');
		$time = date('h:i');
		$daytime = date('A');

		$message = "";

		$sql = "Select * from tbstudent where idnumber='$idnumber' and date = '$date'";
		$result = $conn->query($sql);
		if($row = $result->fetch_assoc()){
			$message = "<p>* ID number already signed today as <br>`".$row['name']."`.</p><h5>@ ".$row['time']." ".$row['daytime']."</h5><br>";
		}

		if (strlen($idnumber) != 10 ){
			$message = $message."<p>* ID number contains invalid length.</p>";
		}
		if ($year == 'Y'){
			$message = $message."<p>* Select year level.</p>";
		}
		if ($section == 'ection'){
			$message = $message."<p>* Select section.</p>";
		}

		if ($message == "") {
			$sql = "INSERT INTO `tbstudent`(`idnumber`, `name`, `year`, `section`, `time`, `date`, `daytime`) VALUES ('$idnumber', '$name', '$year', '$section', '$time', '$date', '$daytime')";
			if($conn->query($sql)===TRUE){
				$message = "<p>$idnumber, signed successfully as <br>".$name.".</p>";
				if (($year == '1' && $section == '3') ||  ($year == '1' && $section == '5') || ($year == '2' && $section == '3') || ($year == '2' && $section == '7') || ($year == '3' && $section == '3') || ($year == '4' && $section == '3')) {
					$_SESSION['house'] = 'water-house.gif';
					$bon = "<font color='lightblue'>Water bender</font>";
				}elseif (($year == '1' && $section == '4') ||  ($year == '1' && $section == '6') || ($year == '2' && $section == '8') || ($year == '2' && $section == '4') || ($year == '3' && $section == '4') || ($year == '4' && $section == '4')) {
					$_SESSION['house'] = 'earth-house.gif';
					$bon = "<font color='orange'>Earth bender</font>";
				}
				elseif (($year == '1' && $section == '1') || ($year == '2' && $section == '1') || ($year == '2' && $section == '5') || ($year == '3' && $section == '1') || ($year == '4' && $section == '1')) {
					$_SESSION['house'] = 'fire-house.gif';
					$bon = "<font color='red'>Fire bender</font>";
				}
				elseif (($year == '1' && $section == '2') || ($year == '2' && $section == '2') || ($year == '2' && $section == '6') || ($year == '3' && $section == '2') || ($year == '4' && $section == '2')) {
					$_SESSION['house'] = 'air-house.gif';
					$bon = "<font color='white'>Air bender</font>";
				}else{
					$_SESSION['house'] = 'air-house.gif';
					$bon = "<font color='white'>ITLympics</font>";
				}
				$name = "";
				$idnumber = "";
				$section = "";
				$year = "";


				
			}else{
				$message = "* Error: Server error.";
			}
		}
			

		
		//echo $year."<br>".$section;
		echo "<div class='black-background' id='black-background'>
	</div>
	<div class='dlgbox' id='dlgbox'>
		<div class='dlgbox-header'>$bon</div>
		<div class='dlgbox-content'>$message</div>
		<button type='submit' class='dlgbox-btn' onclick='ok()'>OK</button>
	</div>	";
	}
?>