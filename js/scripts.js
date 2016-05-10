$(document).ready(function(){
    
    $(".pictures").on("change", function(){
        var upload = $(".pictures").val();
        $(".uploadFile").val(upload);
    }); 
    
    // ajax voor username check
    
    $("#username").on("keyup", function(e) {
         "use strict";
         // username ophalen uit tekstveld
         var username = $("#username").val();
        $(".usernameFeedback").show();
         
 
         $.post("ajax/check_username.php", {username: username})
             .done(function( response ){
               $('.usernameFeedback').text(response.message);
            if(response.status === 'success'){
                $('#username').css('color', '#4BAE4F');
                $('.usernameFeedback').css('color', '#4BAE4F');
            }
             else if(response.status === 'error'){
                 $('#username').css('color', '#D22E2E');
                $('.usernameFeedback').css('color', '#D22E2E');
             }
             else{
                 $('#username').css('color', '#000');
                $('.usernameFeedback').css('color', '#000');
             }
             });
         });
        
        
        
        $(".loadmore").on("click", function(e){
            var offset = $(this).data("offset");
            console.log(offset);
            $.post("ajax/loadmore.php", {offset: offset }).done(function( response ) {
                var load = '<article class="post"><div class="postinfo"><a href="profile.php?user='+response.username+'"><img src="'+response.avatar+'" alt="'+response.avatar+'" class="avatar-small"></a><p><a href="profile.php?user='+response.username+'" class="postusername">'+response.username+'</a></p><p class="time">'+response.posttime+'</p></div><a href="picture.php?post='+response.username+'"><img src="'+response.picture+'" alt="'+response.picture+'" class="postpicture" ></a><div class="postdescription"><p><a href="profile.php?user='+response.username+'"class="postprofile">'+response.username+'</a>'+response.description+'</p></div></article>';
        
                var offset = $(".loadmore").data("offset");
                var newoffset = offset + 3;
               $(".loadmore").data('offset', newoffset);
                
                for (i = offset; i < newoffset; i++) {
                $(".loadpost").append(load);
				$(".loadpost li:first-child").slideDown();
                }
            });
            
        
        
        });
     });
    
    //ajax like post
   /* 
    $("#like").on("click", function(e){
        $.post("ajax/like.php").done(function(response){
            $('#unlike').show();
            $('#like').hide();
            
        });
       e.preventDefault();
    });
    
    
    $("#unlike").on("click", function(e){
        $.post("ajax/like.php").done(function(response){
            
            $('#like').show();
           $('#unlike').hide();
            
        });
        e.preventDefault();
    });
           
*/ 
