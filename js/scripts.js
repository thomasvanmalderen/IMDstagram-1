$(document).ready(function(){
     $("#username").on("keyup", function(e) {
         "use strict";
         // username ophalen uit tekstveld
         var username = $("#username").val();
        $(".usernameFeedback").show();
         
 
         // Ajax call: verzenden naar php bestand om query uit te voeren
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
 }); 