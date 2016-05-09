$(document).ready(function(){

$(".btnComment").on("click", function(e){
			// message ophalen uit tekstvak
			
            var userid = $(this).data("userid");
        var postid = $(this).data("postid");
    var comment = $(".com"  + $(this).data("postid")).val();
            console.log(comment);

			$.post("ajax/savecomment.php", {comment: comment, userid: userid, postid: postid }).done(function( response ) {
                //console.log(comments);
					if(response.status === 'success'){
                         
						var message = '<div class="listcomment"><li><a href="profile.php?user='+response.username +'"'+'class="postprofile">'+response.username+'</a>' +'   ' + response.comments+'</li></div>';
						$(".displaycomments" + postid).append(message);
						$(".displaycomments" + postid).slideDown();
                        $(".com" + postid).val("");
					}
				});


			e.preventDefault();
		});
    
});