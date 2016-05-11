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
                $("input[type=submit]").removeAttr("disabled");

            }
             else if(response.status === 'error'){
                 $('#username').css('color', '#D22E2E');
                $('.usernameFeedback').css('color', '#D22E2E');
             }
             else{
                 $('#username').css('color', '#000');
                 $('.usernameFeedback').hide();
                 $("input[type=submit]").attr("disabled", "disabled");
             }
             $("input[type=submit]").removeAttr("disabled");

             });
         });
        
        
        
        $(".loadmore").on("click", function(e){
            var offset = $(this).data("offset");

            console.log(offset);

            $.post("ajax/loadmore.php", {offset: offset }).done(function( response ) {
               
                var offset = $(".loadmore").data("offset");
                
                var row = response.row;
                var numposts = response.numposts;
                //console.log("row: " + row);
                console.log(numposts);
               var newoffset = offset + 3
                
                //var newoffset = offset + (row);
                
                console.log(row);
                var rowc = 3;
                if (row == 0){
                    rowc = 3}
                else{
                    rowc = row;
                }
                for(x = 0; x < rowc; x++){
                var load = '<article class="post"><div class="postinfo"><a href="profile.php?user='+response[x].username+'"><img src="'+response[x].avatar+'" alt="'+response[x].avatar+'" class="avatar-small"></a><p><a href="profile.php?user='+response[x].username+'" class="postusername">'+response[x].username+'</a></p><p class="time">'+response[x].posttime+'</p><p class="location">'+response[x].location+'</p></div><a href="picture.php?post='+response[x].post+'"><img src="'+response[x].picture+'" alt="'+response[x].picture+'" class="postpicture" ></a><div class="postdescription"><p><a href="profile.php?user='+response[x].username+'"class="postprofile">'+response[x].username+'</a>'+response[x].description+'</p></div></article>';
                    
                
                
                
               $(".loadmore").data('offset', newoffset);
                
                
                $(".loadpost").append(load);
				$(".loadpost li:first-child").slideDown();

                }
                /*if(response.numposts = offset-1){
                    alert("done!");

                    $("#loadmore").style.visibility="hidden";
                } else {
                    alert("ay");
                }*/

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
