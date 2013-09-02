$(document).ready(function() {
	
	$("#fine-uploader").fineUploader({
        request: {
            endpoint: '/front/upload_photo_profile'
        }
    })
		.on('complete', function(event, id, fileName, responseJSON) {
			if (responseJSON.success) {
				$('#profile_pic').attr("src", "/public/img/users/"+responseJSON.data);
			}
		});
	//Register
	$("#register").click(function(e){
		e.preventDefault();
		$(this).hide();
		$("#register_form").toggle('slow');
		$("input[name='username']").focus();
		$("html, body").animate({ scrollTop: $(document).height() }, 1000);
	});

});