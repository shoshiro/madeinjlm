// Defaults
var mapCenter = [31.768319, 35.21371];
var mapZoom = 12;
var thumbnailProperties = {width:100, height:100}; // http://www.garralab.com/nailthumb-options.php

// Private vars
var geocoder;
var map;
var markerCluster;
var infowindow = null;
var markers = [];
var infoWindows = [];
var categories = [];

// Once the DOM is ready start manipulating it
$(function() {
    google.maps.event.addDomListener(window, 'load', initialize);
});

// Initialize google map
function initialize() {

    geocoder = new google.maps.Geocoder();

    map = new google.maps.Map(document.getElementById('map'), {
        zoom: mapZoom,
        center: new google.maps.LatLng(mapCenter[0], mapCenter[1]),
        mapTypeId: google.maps.MapTypeId.ROADMAP,  // ROADMAP, SATELLITE, HYBRID, TERRAIN

        mapTypeControl: false,
        panControl: false,
        zoomControl: true,
        zoomControlOptions: {
            style: google.maps.ZoomControlStyle.SMALL,
            position: google.maps.ControlPosition.TOP_LEFT
        },
        scaleControl: false,
        streetViewControl: false
    });

    var categories = [];
    for (var i = 0; i < data.companies.length; i++)
    {
        var company = data.companies[i];

        markers[i] = new google.maps.Marker({
            icon: 'http://madeinjlm.org/map/img/startup.png',
            title: company.company,
            position: new google.maps.LatLng(company.latitude, company.longitude),
            data: company
        });

        if(markers[i].position && company.category)
        {
            company.category = company.category.toLowerCase();
            categories[company.category] += 1;
        }

        infoWindows[i] = new google.maps.InfoWindow({
            content: '<div class="map_infowindow">'+
                (company.picture ? '<div class="thumb"><img src="'+company.picture+'" class="img-rounded" /></div>' : '') +
                '<div class="info_content">'+
                '<b><a target="_blank" href="'+company.url+'">'+company.company+'</a></b>'+
                '<p>'+company.description+'</p>'+
                (company.isHiring ? '<span class="label-success">This company is HIRING!</span>' : '')+
                '</div>'+
                '</div>'
        });

        google.maps.event.addListener(markers[i], 'click', function(i) {
            return function() {
                if (infowindow) {
                    infowindow.close();
                }

                infowindow = infoWindows[i];
                infowindow.open(map, markers[i]);
                $('.thumb img').nailthumb(thumbnailProperties);
            }
        }(i));
    }
    markerCluster = new MarkerClusterer(map, markers);


    // Update the UI
    for(var key in categories) {
        $('.category_list').append('<span class="label">'+key+'</span>');
    }
    $('.category_list span').click(function() {
        $('.category_list span').removeClass("label-info");
        $(this).addClass("label-info");
        showCategory($(this).text());
    });
    showCategory("all");
}

function showCategory(categoryName) {
    markerCluster.clearMarkers();
    
    for (var i = 0; i < markers.length; i++)
    {
        if(categoryName == "all" || categoryName == 0)
        {
            markerCluster.addMarker(markers[i]);
        }
        else if(markers[i].data.category == categoryName)
        {
            markerCluster.addMarker(markers[i]);
        }
    }
}