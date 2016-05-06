$(document).ready(function(){

$(".btnComment").on("click", function(e){
			// message ophalen uit tekstvak
			var comment = $("#comment").val();
            var userid = $(this).data("userid");
        var postid = $(this).data("postid");
            

			$.post("ajax/savecomment.php", {comment: comment, userid: userid, postid: postid }).done(function( response ) {
                //console.log(comments);
					if(response.status === 'success'){
                         
						var message = '<li><a href="profile.php?user='+response.username +'"'+'class="postprofile">'+response.username+'</a>' +'   ' + response.comments+'</li>';
						$(".displaycomments").append(message);
						$(".displaycomments li:first-child").slideDown();
                        $("#comment").val("");
					}
				});


			e.preventDefault();
		});
    
});