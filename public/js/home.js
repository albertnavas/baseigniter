$(document).ready(function() {

	//Register
	$("#register-btn").click(function(e){
		e.preventDefault();
		$(this).hide();
		$("#register_form").toggle('slow');
		$("#login_form").toggle('slow');
		$("#login-btn").toggle('slow');
		$("#forgot-password-btn").toggle('slow');
		$("html, body").animate({ scrollTop: $(document).height() }, 1000);
	});

	$("#login-btn").click(function(e){
		e.preventDefault();
		$(this).hide();
		$("#register_form").toggle('slow');
		$("#login_form").toggle('slow');
		$("#register-btn").toggle('slow');
		$("#forgot-password-btn").toggle('slow');
		$("html, body").animate({ scrollTop: $(document).height() }, 1000);
	});

});