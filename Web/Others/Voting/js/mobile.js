$('body').hide();

$(document).ready(function(){
	
	function mobileView(){
		
		var deviceWidth = $('html')[0].offsetWidth; //Get device width

		if(deviceWidth <= 992){ //Check if deviceWidth is for mobile device
			$('.mobile-hide').css('display','none');
			$('.mobile-fullWidth').removeClass('col-6');
			$('.mobile-fullWidth').removeClass('col-8');
			$('.mobile-fullWidth').removeClass('col-9');
			$('.mobile-fullWidth').removeClass('col-4');
			$('.mobile-fullWidth').removeClass('mt-5');
			$('.mobile-fullWidth').removeClass('offset-3');
			$('.mobile-fullWidth').removeClass('offset-4');
			$('.mobile-fullWidth').addClass('col');
			$('.mobile-fullWidth').addClass('mt-2');
			
			// Home view
			$('.home-banner-container').removeClass('col-6');
			$('.home-banner-container').removeClass('offset-3');
			$('.home-banner-container').addClass('col');
			$('.home-banner-container').css('margin','0px auto');
			$('.container').removeClass('mt-5');
			$('.container').addClass('mt-3');
			$('.mobile-name div').removeClass('col-4');
			$('.mobile-name div').removeClass('pl-2');
			$('.mobile-name div').removeClass('pr-2');
			$('.mobile-name').addClass('mt-2');
			$('.mobile-name div').addClass('btn-block');
			$('.mobile-name div').addClass('pl-3');
			$('.mobile-name div').addClass('pr-3');
			
			if($('.home-form').length != 0){
				document.getElementsByClassName('home-form')[0].innerHTML = "";
				$('.home-form').append("<input type=\"integer\" name=\"id_number\" id=\"id_number\" class=\"form-control\" placeholder=\"ID number\"></input><input type=\"text\" name=\"fname\" id=\"fname\" class=\"form-control mt-2 mt-2\" placeholder=\"First name\"><input type=\"text\" name=\"mname\" id=\"mname\" class=\"form-control mt-2\" placeholder=\"Middle name\"><input type=\"text\" name=\"lname\" id=\"lname\" class=\"form-control mt-2\" placeholder=\"Last name\"><select name=\"yr_lvl\" id=\"yr_lvl\" class=\"form-control mt-2\"><option value=\"0\">Year level</option><option value=\"1\">1st year</option><option value=\"2\">2nd year</option><option value=\"3\">3rd year</option><option value=\"4\">4th year</option></select><input type=\"submit\" value=\"Vote now\" class=\"btn btn-primary font-weight-bold btn-block mt-3 btn-lg\"></input>");
			}

			
			// Voting view
			$('.voting-body').css('padding','0px 0px')
			
			//Thanks
			$('.mobile-thanks').addClass('mr-3');
			$('.mobile-thanks').addClass('ml-3');

		}
	};

	mobileView();
	$('body').fadeIn();


	function candidateState(type, label){
		if(type == "radio"){
			for(var i=0; i < $('label').length; i++){
				$($('label')[i]).removeClass('font-weight-bold');
			}
			$(label).addClass('font-weight-bold');
		}
	}

	// Candidate
	$('.mobile-candidateName').click(function(){
		candidateState($("#"+String(this.htmlFor))[0].type, this);
	});

});