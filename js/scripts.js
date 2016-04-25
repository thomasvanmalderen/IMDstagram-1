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

$(document).ready(function() {

    var track_click = 0; //track user click on "load more" button, righ now it is 0 click
    
    var total_pages = <?php echo $total_pages; ?>;
    
    $('#results').load("fetch_pages.php", {'page':track_click}, function() {track_click++;}); //initial data to load


    $(".load_more").click(function (e) { //user clicks on button
    
        $(this).hide(); //hide load more button on click
        $('.animation_image').show(); //show loading image

        if(track_click <= total_pages) //user click number is still less than total pages
        {
            //post page number and load returned data into result element
            $.post('fetch_pages.php',{'page': track_click}, function(data) {
            
                $(".load_more").show(); //bring back load more button
                
                $("#results").append(data); //append data received from server
                
                //scroll page smoothly to button id
                $("html, body").animate({scrollTop: $("#load_more_button").offset().top}, 500);
                
                //hide loading image
                $('.animation_image').hide(); //hide loading image once data is received
    
                track_click++; //user click increment on load button
            
            }).fail(function(xhr, ajaxOptions, thrownError) { //any errors?
                alert(thrownError); //alert with HTTP error
                $(".load_more").show(); //bring back load more button
                $('.animation_image').hide(); //hide loading image once data is received
            });
            
            
            if(track_click >= total_pages-1) //compare user click with page number
            {
                //reached end of the page yet? disable load button
                $(".load_more").attr("disabled", "disabled");
            }
         }
          
        });
});