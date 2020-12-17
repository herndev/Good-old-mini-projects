// Nav menus
let navbutton = document.getElementsByTagName("li");

var blkbg = document.getElementById("black-background");
var dlgbx = document.getElementById("dlgbox");

for (var i = 0; i < navbutton.length; i++) {
	navbutton[i].addEventListener('click',navclick,false);
}

function navclick() {
	if(this.id != "logout"){
		window.open("admin/" + this.id + ".php","mframe");
	}else{
		logout();
	}
}

function logout() {
	blkbg.style.display = "block";
	dlgbx.style.display = "block";
}

function comfirmed_logout(){
	window.open("auth/destroy.php", "_self");
}

function ok(){
	blkbg.style.display = "none";
	dlgbx.style.display = "none";
}