/*function validate() {
	var blkbg = document.getElementById("black-background");
	var dlgbx = document.getElementById("dlgbox");
	blkbg.style.display = "block";
	dlgbx.style.display = "block";

	var winWidth = window.innerWidth;
	var winHeight = window.innerHeight;
	dlgbx.style.left = (winWidth/2) - 400/2 + "px";
	dlgbx.style.top = "150px";
}*/

function ok(){
	var blkbg = document.getElementById("black-background");
	var dlgbx = document.getElementById("dlgbox");
	blkbg.style.display = "none";
	dlgbx.style.display = "none";
}

function updateSection(s1, s2){
	var s1 = document.getElementById(s1);
	var s2 = document.getElementById(s2);
	var optionArray = ["|Section"];
	s2.disabled = true;

	s2.innerHTML ="";
	if (s1.value == "1st Year") {
		optionArray = ["|Section", "|R1", "|R2", "|R3", "|R4", "|R5", "|R6"];
		s2.disabled = false;
	}
	else if (s1.value == "2nd Year") {
		optionArray = ["|Section", "|R1", "|R2", "|R3", "|R4", "|R5", "|R6", "|R7", "|R8"];
		s2.disabled = false;
	}
	else if (s1.value == "3rd Year") {
		optionArray = ["|Section", "|R1", "|R2", "|R3", "|R4"];
		s2.disabled = false;
	}
	else if (s1.value == "4th Year") {
		optionArray = ["|Section", "|R1", "|R2", "|R3", "|R4"];
		s2.disabled = false;
	}

	for (var option in optionArray) {
		var pair = optionArray[option].split("|");
		var newOption = document.createElement("option");
		
		newOption.innerHTML = pair[1];
		s2.options.add(newOption);
	}
}

$(document).ready(function(){
	updateSection('year', 'section');
});
// $(document).ready(function(){
// 	load_json_data('year');
// 	function load_json_data(id, parent){
// 		var html_code = '';
// 		$.getJSON('json/year.json', function(data){
// 			html_code += '<option value="">Select '+id+'</option>';
// 			$.each(data, function(key, value){
// 				if (id == 'year') {
// 					if (value.parent_id == '0') {
// 						html_code += '<option value="'+value.id+'">'+value.name+'</option>';
// 					}
// 				}
// 				else{
// 					if (value.parent_id == parent_id) {
// 						html_code += '<option value="'+value.id+'">'+value.name+'</option>';
// 					}
// 				}
// 			});
// 			$('#'+id).html(html_code);
// 		});
// 	}
// 	// $(document).on('change', '#year', function(){
// 	// 	var year_id = $(this).val();
// 	// 	if (year_id != '') {
// 	// 		load_json_data('section', year_id);
// 	// 	}
// 	// 	else{
// 	// 		$('#section').html('<option value="">Select section');
// 	// 	}
// 	// });
// 	$(document).on('change', '#year', function(){
// 		 var year_id = $(this).val();
// 		 if(year_id != '')
// 		 {
// 		  	load_json_data('section', year_id);
// 		 }
// 		 else
// 		 {
// 		  	$('#section').html('<option value="">Select section</option>');
// 		 }
//  	});
// });