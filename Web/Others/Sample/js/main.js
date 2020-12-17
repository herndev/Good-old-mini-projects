$(document).ready(function() {
	// 'use strict';
	// var a = document.getElementsByTagName("html")
	// console.log(a[0].offsetWidth);

	// if(a[0].offsetWidth <= 992){
	// 	var b = document.getElementsByTagName("h1")
	// 	b[0].classList.remove("green");
	// 	b[0].classList.add("pink");
	// }

	$("#mybtn").click(function (){
		$("p").hide();
	});
	$("#mybtnn").click(function (){
		$("p").show();
	});
});