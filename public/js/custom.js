$(document).ready(function() {
	
	$("#fine-uploader").fineUploader({
        request: {
            endpoint: '/dashboard/upload_photo_profile'
        }
    })
	.on('complete', function(event, id, fileName, responseJSON) {
		if (responseJSON.success) {
			$('#profile_pic').attr("src", "/public/img/users/"+responseJSON.data);
		}
	});

});