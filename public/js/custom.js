$(document).ready(function() {

  $('#profile-tabs a').click(function (e) {
    e.preventDefault();
    $(this).tab('show');
  })

  $(function() {
    $('#file_upload').uploadify({
        'swf'      : '/public/uploadify/uploadify.swf',
        'uploader' : '/profile/upload_photo_profile',
        'multi'    : false,
        'buttonText' : 'Subir foto de perfil',
        'height'   : 20,
        'width'   : 140 ,
        'onUploadSuccess' : function(file, data, response) {
            $('#profile_pic').attr("src", "/photos/"+data);
        }
    });
  });

  $(function() {
    $('#front_profile').uploadify({
        'swf'      : '/public/uploadify/uploadify.swf',
        'uploader' : '/profile/upload_photo_front',
        'multi'    : false,
        'buttonText' : $("#front_pic").length == 1?'Cambiar foto de portada':'Subir foto de portada',
        'height'   : 20,
        'width'   : 140 ,
        'onUploadSuccess' : function(file, data, response) {
            //$('#front_pic').attr("src", "/photos/"+data);
            window.location.reload();
        }
    });
  });

  $(function() {
    var album_id = $("#album_id").val();
    $('#photos_album_add').uploadify({
        'swf'      : '/public/uploadify/uploadify.swf',
        'uploader' : '/profile/upload_album_photo/?album_id='+album_id,
        'multi'    : true,
        'buttonText' : 'SUBIR FOTOS',
        'height'   : 40,
        'width'   : 100 ,
        'onQueueComplete' : function(queueData) {
            location.reload();
        },
    });
  });

	function loadPosts(wall_id)
	{
    if(wall_id == 0)
      $('#wall_publications').fadeOut("slow").load('/posts/load').fadeIn('slow');
    else
      $('#wall_publications').fadeOut("slow").load('/posts/load/'+wall_id).fadeIn('slow');
  }
  function cleanInput()
  {
    $('#wall_publication').val('');
    $('#security-code').val('');
  }
  function cleanCommentInput()
  {
    $('.textarea_comment').val('');
  }

  $("#album_add").click(function(e){
    e.preventDefault();
    var name = $("#album_name").val();
    var code = $("#security_code").val();
    url_album = "/profile/albumAdd/?name="+name+"&code="+code;
    $.ajax({
      type: "POST",
      url: url_album,
      success: function(res) {
        location.reload();
      }
    });
  });

  //Actualizar el travel country al país actual
  $("#update_travelcountry").click(function(e){
    e.preventDefault();
    if(!$("input[name=visible]").is(':checked'))
    {
      alert('Selecciona si quieres que tu perfil sea Público o Privado');
      return false;
    }
    $.ajax({
      type: "POST",
      url: "/profile/updateCountryIam",
      data: {'visible': $("input[name=visible]:checked").val()},
      success: function(res) {
        location.reload();
      }
    });
  });

  $("#profile_pic").mouseover(function(e){
    $(".profile_img_btn").show();
  }).mouseout(function(){
    $(".profile_img_btn").hide();
  });

  $(".profile_img_btn").mouseover(function(e){
    $(".profile_img_btn").show();
  });

  //Notifications
  $(".requests").click(function(){
    $(".requests_list").toggle('slow');
  });

  $(".notify").click(function(){
    $(".notifications_list").toggle('slow');
  });

  //Register
  $("#register").click(function(e){
  	e.preventDefault();
  	$(this).hide();
  	$("#register_form").toggle('slow');
    $("input[name='username']").focus();
    $("html, body").animate({ scrollTop: $(document).height() }, 1000);
  });

  //Add publication
  $("#icon_publication_submit").click(function(){
    if ($("#wall_publication").val() == '') {
      alert('Debes escribir algo.');
    }
    else {
      $("#wall_publication_submit").submit();
    }
  });

  $(".security-post").hide();
  $("#icon-lock").click(function(){
    $(".security-post").show();
  });

  $("#wall_publication_submit").hide();

  $("#post_status").submit(function(e){
  	e.preventDefault();
  	var request = $.ajax({
  		type: 'POST',
  		cache: false,
  		url: '/posts/add',
  		data: $("#post_status").serialize()
  	});
  	request.done(function(msg) {
  		if(msg == "1")
  		{
  			loadPosts($("#wall_id").val());
  			cleanInput();
  		}
  	});
  });

  /*
  Search Box
  */
  $( "#search" ).autocomplete({
    source: "/search",
    minLength: 2,
    select: function( event, ui ) {
      document.location = '/user/'+ui.item.name;
    }
  });

  /*
  SHOW COMMENTS
  */
  $(".comment_post").live("click", function(e){
    e.preventDefault();
    var id_post = $(this).parent().parent().attr('id');
    $("#post_comment_"+id_post).show();
    $(this).hide();
  });

  /*
  POST COMMENT
  */
  $(".post_comment").live("submit", function(e){
    e.preventDefault();
    //post_comment
    var post_id = $(this).attr('id').split('_')[2],
        comment = $("#comment_status_"+post_id).val();
    var request = $.ajax({
      type: 'POST',
      cache: false,
      url: '/comments/add',
      data: {'post_id':post_id, 'comment':comment},
    });
    request.done(function(msg) {
      if(msg == "1")
      {
        $('#comments_list_'+post_id).fadeOut("slow").load('/comments/load/'+post_id).fadeIn('slow');
        cleanCommentInput();
      }
    });
  });

  $("select[name='Profile[travel_type]']").live("change", function(e){
    $("#tourism_type").load('/tourismtype/load', { 'tipo': $(this).val() });
  });

  $("select[name='sidebar_traveltype']").live("change", function(e){
    $("#tourism_type").load('/tourismtype/loadsidebar', { 'tipo': $(this).val() });
  });

  /*
  Add a friend from its profile page
  */
  $("#add_friend_profile").live("click", function(e){
    e.preventDefault();
    var wall_id = $("#wall_id").val();
    var request = $.ajax({
      type: 'POST',
      cache: false,
      url: '/friends/add/'+wall_id,
    });
    request.done(function(msg) {
      if(msg == "1")
      {
        $('#friendship_relation').fadeOut("slow").load('/friends/getfriendship_relation/'+wall_id).fadeIn('slow');
      }
    });
  });

  /*
  Add a friend from its search results page
  */
  $("#add_friend_search").live("click", function(e){
    e.preventDefault();
    var friend_id = $(this).parent().parent().parent().attr('id').split('_')[1];
    var request = $.ajax({
      type: 'POST',
      cache: false,
      url: '/friends/add/'+friend_id,
    });
    request.done(function(msg) {
      if(msg == "1")
      {
        $('#friendship_relation_'+friend_id).fadeOut("slow").load('/friends/getfriendship_relation/'+friend_id).fadeIn('slow');
      }
    });
  });

  /*Remove a friends*/
  $(".remove_friend").live("click", function(e){
    e.preventDefault();
    var friend_id = $(this).attr('id').split("_")[1];
    if(!confirm('¿Seguro que quieres eliminar este amigo?'))
      return false;
    var request = $.ajax({
      type: 'POST',
      cache: false,
      url: '/friends/remove/'+friend_id,
    });
    request.done(function(msg) {
      if(msg == "1")
      {
        location.reload();
      }
    });
  });

  /*Show ajax description*/
  $("#Welcome_config_tourism_type").live("change", function(e){
    var tourism_type_id = $(this).val();
    var request = $.ajax({
      type: 'POST',
      cache: false,
      url: '/profile/gettourismtype/'+tourism_type_id,
    });
    request.done(function(msg) {
      var data = $.parseJSON(msg);
      $("#tourism_type_name").html(data.name);
      $("#tourism_type_description").html(data.description);
    });
  });

  /*
  Load more posts
  */
  $(".view_more_posts").live("click", function(e){
    e.preventDefault();
    var page = $(this).attr('id'),
        wall_id = $("#wall_id").val();

    $.ajax({
      type: "POST",
      url: "/front/showPostsByPage/"+wall_id+"/"+page,
      success: function(res) {
        $(".view_more_posts").parent().remove();
        $("#wall_publications").append(res);
      }
    });
  });

  /*
  Load more photos
  */
  $(".show_more_pics").live("click", function(e){
    e.preventDefault();
    var page = $(this).attr('id'),
        user_id = $(this).parent().parent().attr('data-uid');

    $.ajax({
      type: "POST",
      url: "/profile/getPhotosByPage/"+user_id+"/"+page,
      success: function(res) {
        $(".show_more_pics").remove();
        $("#photos_list").append(res);
      }
    });
  });

});

function acceptFriend(friend_id)
{
  $.ajax({
      type: "POST",
      url: '/friends/accept/'+friend_id,
      success: function(res) {
        location.reload();
      }
    });
}

function denyFriend(friend_id)
{
  if(!confirm('¿Está seguro que quiere rechazar este contacto?'))
    return false;
  $.ajax({
      type: "POST",
      url: '/friends/deny/'+friend_id,
      success: function(res) {
        location.reload();
      }
    });
}
function changeTourismTypeID(tourism_id)
{
  var tourism_type_id = $("#sidebar_tourism_type").val();
  $.ajax({
      type: "POST",
      url: '/profile/changetourismtypeid/'+tourism_type_id,
      success: function(res) {
        location.reload();
      }
    });
}
function changeTravelCountry()
{
  var country_id = $("#travel_country_id").val();
  $.ajax({
      type: "POST",
      url: '/profile/updatecountry/'+country_id,
      success: function(res) {
        location.reload();
      }
    });
}

$(".remove-photo").live("click", function(e){
	if(!confirm('¿Estas seguro que quieres eliminar esta foto?')) {
		return false;
	} else {
	    e.preventDefault();
	    photo_id = $(this).data("photoid");
	    var request = $.ajax({
	      type: 'POST',
	      cache: false,
	      url: '/profile/photoDelete/',
	      data: {photoid : photo_id},
	    });
	    request.done(function(msg) {
	      alert('Foto eliminada correctamente');
	      $("#photo-"+photo_id).hide();
	    });
	}
});

$(".remove-album").live("click", function(e){
	if(!confirm('¿Estas seguro que quieres eliminar este album?')) {
		return false;
	} else {
	    e.preventDefault();
	    album_id = $(this).data("albumid");
	    var request = $.ajax({
	      type: 'POST',
	      cache: false,
	      url: '/profile/albumDelete/',
	      data: {albumid : album_id},
	    });
	    request.done(function(msg) {
	      alert('Album eliminado correctamente');
	      $("#album-"+album_id).hide();
	    });
	}
});

$("#btn-youtube-post").live("click", function(e){
    e.preventDefault();
    var video_url = $("#post_content_yt").val();

    if (video_url == '') {
        alert('Introduce una url válida');
    }
    else {
      var request = $.ajax({
        type: 'POST',
        cache: false,
        url: '/posts/videoAdd/',
        data: $("#post_content_yt").serialize()
      });
      request.done(function(msg) {
        $("#post_content_yt").val('');
      });
    }

});

function YouTubeGetID(url){
  var ID = '';
  url = url.replace(/(>|<)/gi,'').split(/(vi\/|v=|\/v\/|youtu\.be\/|\/embed\/)/);
  if(url[2] !== undefined) {
    ID = url[2].split(/[^0-9a-z_]/i);
    ID = ID[0];
  }
  else {
    ID = url;
  }
    return ID;
}

/*$('#products').portfolio({
    gridOffset:30,
    cellWidth:176,
    cellHeight:176,
    cellPadding:10,
    entryProPage:12,

    captionOpacity:85,

    filterList:"#portfolio-filter",
    title:"#selected-filter-title",
    pageOfFormat:"Page #n of #m",

    backgroundHolder:"#main-background",
    backgroundSlideshow:0
  });*/
