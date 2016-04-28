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
     })
    
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
 }); 
