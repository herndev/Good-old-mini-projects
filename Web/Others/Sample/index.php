<?php
	// if(isset($_POST['submit'])){
	// 	foreach($_POST['a'] as $a){
	// 		echo $a." ";
	// 	}
	// }
	require('auth/UserInfo.php');

	$uinfo = new UserInfo;
	
	echo $uinfo->getIP();
?>
<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<title>Document</title>
	<link rel="stylesheet" href="mini_lib/css/animate.css">
	<link rel="stylesheet" href="mini_lib/css/bootstrap.css">
	<link rel="stylesheet" href="mini_lib/css/hover.min.css">
	<link rel="stylesheet" href="mini_lib/css/ionicons.css">
	<link rel="stylesheet" href="css/style.css">
</head>
<body>
	<!-- <h1 class="green">Hello World</h1> -->
	<!-- <form action="<?php $_SERVER['PHP_SELF']; ?>" method="POST">
		<input type="checkbox" name="a[]" id="a" value="1">
		<input type="checkbox" name="a[]" id="b" value="2">
		<input type="checkbox" name="a[]" id="c" value="3">
		<input type="submit" name="submit" value="submit">
	</form>

	<button id="mybtn">Click</button>
	<button id="mybtnn">Click</button>
	<p>
		Lorem ipsum dolor sit.
	</p> -->

	Lorem ipsum dolor sit amet consectetur, adipisicing elit. Facilis voluptates placeat enim distinctio nobis! Sint laboriosam alias cumque nemo incidunt rem voluptatem quisquam possimus quam, vero, in, esse ad consequuntur.

<script src="mini_lib/js/jquery.min.js"></script>
<script src="js/main.js"></script>
</body>
</html>