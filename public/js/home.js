$(document).ready(function() {

	//Register
	$("#register").click(function(e){
		e.preventDefault();
		$(this).hide();
		$("#register_form").toggle('slow');
		$("input[name='username']").focus();
		$("html, body").animate({ scrollTop: $(document).height() }, 1000);
	});

});