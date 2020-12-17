function ok() {
	var pass = document.getElementById('pwd');
	if (pass.value == "123") {
		var blkbg = document.getElementById("black-background");
		var dlgbx = document.getElementById("dlgbox");
		blkbg.style.display = "none";
		dlgbx.style.display = "none";
	}
	else{
		alert('Incorrect password.');
	}
}