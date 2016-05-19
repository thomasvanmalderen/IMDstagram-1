
    // IMDSTAGRAM JAVASCRIPT CODE: USERNAME CHECK, LOAD MORE POSTS,
    //######################################################

    $(document).ready( function() {

        // UPLOAD POST
        $(".pictures").on( "change", function() {
            var upload = $(".pictures").val();
            $(".uploadFile").val(upload);
        });
    
        // AJAX CHECK USERNAME AVAILIBILITY
        $("#username").on("keyup", function(e) {
            "use strict";
            // GET USERNAME VALUE
            var username = $("#username").val();
            $(".usernameFeedback").show();

            $.post("ajax/check_username.php", {username: username}).done(function( response ){

                $('.usernameFeedback').text(response.message);

                if( response.status === 'success' ) {
                    $('#username').css('color', '#4BAE4F');
                    $('.usernameFeedback').css('color', '#4BAE4F');
                    $("input[type=submit]").removeAttr("disabled");

                } else if(Cresponse.status === 'error' ) {
                    $('#username').css('color', '#D22E2E');
                    $('.usernameFeedback').css('color', '#D22E2E');

                } else {
                    $('#username').css('color', '#000');
                    $('.usernameFeedback').hide();
                    $("input[type=submit]").attr("disabled", "disabled");
                }

                $("input[type=submit]").removeAttr("disabled");
             });
         });
        
        
        // CLICK LOAD MORE POSTS
        $(".loadmore").on("click", function(e) {

            var offset = $(this).data("offset");
            console.log(offset);

            $.post("ajax/loadmore.php", {offset: offset }).done( function( response ) {
               
                var offset = $(".loadmore").data("offset");
                var row = response.row;
                var numposts = response.numposts;
                var newoffset = offset + 5;
                var com = response.com;
                console.log(com);
                var rowc = 5;

                if ( row == 0 ){
                    rowc = 5;

                } else {
                    rowc = row;
                    $(".loadmore").hide();

                }

                for(x = 0; x < rowc; x++){

                    // PREPARE EXTRA LOADED POSTS
                    var load = '<article class="post"><div class="postinfo"><a href="profile.php?user='+response[x].username+'"><img src="'+response[x].avatar+'" alt="'+response[x].avatar+'" class="avatar-small"></a><p><a href="profile.php?user='+response[x].username+'" class="postusername">'+response[x].username+'</a></p><p class="time">'+response[x].posttime+'</p><p class="location">'+response[x].location+'</p></div><a href="picture.php?post='+response[x].post+'"><figure class="'+response[x].filter+'"><img src="'+response[x].picture+'" alt="'+response[x].picture+'" class="postpicture" ></figure></a><div class="postdescription"><p><a href="profile.php?user='+response[x].username+'"class="postprofile">'+response[x].username+'</a> '+response[x].description+'</p>';

                    // ADD LIKE / UNLIKE FORM FOR
                    if(response[x].like == "yes"){
                        load += '<form action="" method="post"><input type="hidden" name="unlike" value="unlike"><input type="hidden" name="postval" value="'+response[x].post+'"><input id="unlike"  type="submit" name="btnunLike" value=""/></form><p id="likes">'+response[x].numlikes+'</p></div><form action="" method="post" enctype="multipart/form-data">';
                    } else {
                        load += '<form action="" method="post"><input type="hidden" name="like" value="like"><input type="hidden" name="postval" value="'+response[x].post+'"><input id="like"  type="submit" name="btnLike" value=""/></form><p id="likes">'+response[x].numlikes+'</p></div><form action="" method="post" enctype="multipart/form-data">';
                    }
                    
                    load += '<div class="comments"><input type="text" name="comment" placeholder="Write your comment here" class="com'+response[x].post+'" /><input type="hidden" name="userid" value="'+response[x].userid+'"/><input type="hidden" name="postid" value="'+response[x].post+'"/><input class="btnComment" type="submit" name="btnComment" value="Place your comment" data-postid="'+response[x].post+'" data-userid ="'+response[x].userid+'" /></div></form><ul class="displaycomments'+response[x].post+response[x].comment+response[x].commentid+'">';
                    load += '</article>'

                    // ADD EXTRA LOADED ARTICLES TO LIST
                    $(".loadmore").data('offset', newoffset);
                    $(".loadpost").append(load);
				    $(".loadpost li:first-child").slideDown();
                }
            });
        });
    });