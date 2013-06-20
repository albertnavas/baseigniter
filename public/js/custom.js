$(document).ready(function() {

	$(function() {
		$('#file_upload').uploadify({
			'swf'      : '/public/plugins/uploadify/uploadify.swf',
			'uploader' : '/front/upload_photo_profile',
			'multi'    : false,
			'buttonText' : 'Upload profile photo',
			'height'   : 20,
			'width'   : 140 ,
			'onUploadSuccess' : function(file, data, response) {
				$('#profile_pic').attr("src", "/public/img/users/"+data);
			}
		});
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