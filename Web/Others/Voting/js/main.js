var admin_menus = document.getElementById("admin_menus");
// admin_menus.classList.add("bg-dark");

var admin_actions = document.getElementById("admin_actions");
var admin_partylist = document.getElementById("admin_partylist");
var admin_position = document.getElementById("admin_position");
var admin_candidate = document.getElementById("admin_candidate");

// Setting admin sub menu view
function admin_submenu(action){
	admin_actions.style.display = "none";
	admin_partylist.style.display = "none";
	admin_position.style.display = "none";
	admin_candidate.style.display = "none";

	if(action != 0){
		admin_actions.style.display = "block";
	}

	if(action == 1){
		admin_partylist.style.display = "block";
	}
	else if(action == 2){
		admin_position.style.display = "block";
	}
	else if(action == 3){
		admin_candidate.style.display = "block";		
	}
}

// Setting admin menu view
function admin_menu(action){
	if(action){
		admin_menus.style.display = "block";
	}else{
		admin_menus.style.display = "none";
	}
}

// Setting action view
function admin_action(id) {
	if (id == "admin-action-close"){
		admin_submenu(0);
		admin_menu(true);
	}
	else if (id == "candidate"){
		admin_submenu(3);
		admin_menu(false);
	}
	else if (id == "partylist"){
		admin_submenu(1);
		admin_menu(false);
	}
	else if (id == "position"){
		admin_submenu(2);
		admin_menu(false);
	}
}

admin_submenu(0);