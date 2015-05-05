$(function(){
	// To allow the user to close the login box using the "ESC" key.
	$(document).keyup(function(e){
		if(e.keyCode == 27){
			$('#login_box').slideUp();
		}
	});

	// Toggling the login box by clicking on the "Log In" link.
	$('#nav_login_button').click(function(e){
		e.preventDefault();
		$('#login_box').slideToggle(200);
	});

	// client-side form validation
	$('#login_form').validate({
		errorClass: "form_input_invalid",

		rules: {
			login_email: {
				required: true,
				email: true
			},
			login_password: {
				required: true
			}
		},
		messages: {
			login_email: {
				required: "Please enter an e-mail"
			},
			login_password: {
				required: "Please enter a password"
			}
		}
	});
});