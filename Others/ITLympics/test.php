<?php
	echo("<script>alert('Hello'); </script>")
?>

<!DOCTYPE html>
<html>
<head>
	<title>TEST</title>
</head>
<body>
	<form action="<?php echo $_SERVER['PHP_SELF']; ?>" method="GET">
		<button type="submit" name="submit">Submit</button>
	</form>
</body>
</html>