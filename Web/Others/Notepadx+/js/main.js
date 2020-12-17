
window.onload = function() {
  home();
};

function cleared() {
	document.getElementById("container").style.display = "none";
	document.getElementById("wrapper-signin").style.display = "none";
	document.getElementById("wrapper-signup").style.display = "none";
	document.getElementById("wrapper-contact").style.display = "none";
	document.getElementById("wrapper-about").style.display = "none";
	// body...
}

function signIn() {
	cleared();
	document.getElementById("wrapper-signin").style.display = "block";
}

function signUp() {
	cleared();
	document.getElementById("wrapper-signup").style.display = "block";
}

function home(){
	cleared();
	document.getElementById("container").style.display = "block";
}

function contact(){
	cleared();
	document.getElementById("wrapper-contact").style.display = "block";
}

function about(){
	cleared();
	document.getElementById("wrapper-about").style.display = "block";
}

function search() {
	var value = document.getElementById("edttxt_search").value;
	look(value);
}



function look(value){
	alert(value);
}

function SignUp(){
	var user = document.getElementById("edttxt_username").value;
	var pass = document.getElementById("edttxt_password").value;
	var repass = document.getElementById("edttxt_repassword").value;
	if(user == "" || pass == "" || repass == ""){
		document.getElementById("stat").innerHTML="<font color='red'> You must fill-up everything. </font>";
	}
	else if(pass != repass){
		document.getElementById("stat").innerHTML="<font color='red'> Password didn't match. </font>";
	}
	else{
		var fso = new ActiveXObject("Scripting.FileSystemObject");
		var a = fso.CreateTextFile(user, true);
		a.WriteLine("This is a test.");
		a.Close();
		document.getElementById("stat").innerHTML="<font color='yellowgreen'> Account successfully created. </font>";
		
	}
}