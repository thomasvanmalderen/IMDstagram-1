(function () {
    'use strict';
    
    var App = {
        APIKEY: "AIzaSyAYpyhXMy8AV6R-VsmfSQCkkjBHCbfBpa4",
        lat: "",
        lgn: "",
        
        init: function () {
            //start the app
            App.getLocation();
        },
        getLocation: function () {
            //get the current user position
            navigator.geolocation.getCurrentPosition(App.foundPosition);
        },
        foundPosition: function (pos) {
            //found the current user position
            App.lat = pos.coords.latitude;
            App.lng = pos.coords.longitude;
            App.showLocation();
        },
        showLocation: function () {
            //get the location
            var url = "https://maps.googleapis.com/maps/api/geocode/json?latlng=" + App.lat + "," + App.lng + "&key=" + App.APIKEY;
            
            //JSONP
            window.jQuery.ajax({
                url: url,
                dataType: "json",
                success: function (data) {
                    console.log(data);
                    
                    $(".location-summary").val(data.results[0].address_components[2].long_name + ", " + data.results[0].address_components[5].long_name);
                }
            });
        }
    };
    
    App.init();
    
}());