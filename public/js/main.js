/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */


$(function() {
    var default_map_center = {
        latitude: -34.397,
        longitude: 150.644
    };
    
    window.map = null;
    window.markers = [];
    
    var updateCometToken = function() {
        $.get('/user/update-token');
    };
    var connectToCometServer = function() {
        $.getJSON('http://homestead.app:12345?callback=?', function(data) {
            console.log(data);
            for(var i = 0; i < data.length; i++) {
                var unit = data[i];
                var unit_set = false;
                for(var j = 0; j < window.map_units.length; j++) {
                    var old_unit = window.map_units[j];
                    if(old_unit.id == unit.id) {
                        window.map_units[j] = unit;
                        unit_set = true;
                        break;
                    }
                }
                if(!unit_set) {
                    window.map_units.push(unit);
                }
            }
            window.map.setCenter(getMapCenter());
            window.map.fitBounds(getMapBounds());
            setTimeout(updateMarkers, 0);
            //$('#map').append('<div>' + data + '</div>');
            setTimeout(connectToCometServer, 0);
        }).fail(function(){
            setTimeout(connectToCometServer, 1000);
        });
    };
    
    var resizeMap = function() {
        $('#map').css('height', $('#map').width() / 2);
        if(window.map) window.map.fitBounds(getMapBounds());
    };
    
    var getMapBounds = function() {
        var bounds = new google.maps.LatLngBounds();
        var polygon = [];
        for(var i = 0; i < window.map_units.length; i++) {
            var unit = window.map_units[i].latlon;
            polygon[i] = new google.maps.LatLng(unit.latitude, unit.longitude);
        }
        for(var i = 0; i < polygon.length; i++) {
            bounds.extend(polygon[i]);
        }
        return bounds;
    };
    
    var getMapCenter = function() {
        if(window.map_units.length) {
            return getMapBounds().getCenter();
        } else {
            return new google.maps.LatLng(default_map_center.latitude, default_map_center.longitude);
        }
    };
    
    var closeInfoWindow = function() {
        if(window.infowindow) {
            window.infowindow.close();
        }
    }
    
    var displayMarkerTitle = function(marker) {
        closeInfoWindow();
        window.infowindow = new google.maps.InfoWindow({
            content: marker.getTitle()
        });
        window.infowindow.open(window.map,marker);
    };
    
    var updateMarkers = function() {
        for(var i = 0; i < window.markers.length; i++) {
            window.markers[i].setMap(null);
        }
        window.markers = [];
        for(var i = 0; i < window.map_units.length; i++) {
            var unit = window.map_units[i];
            var marker = new google.maps.Marker({
                position: new google.maps.LatLng(unit.latlon.latitude, unit.latlon.longitude),
                title: unit.name ? unit.name : '#' + unit.id,
                map: window.map
            });
            google.maps.event.addListener(marker, 'click', (function(m){
                return function(event){
                    displayMarkerTitle(m);
                    event.cancelBubble = false;
                    if(event.stopPropagation) event.stopPropagation();
                    if(event.preventDefault) event.preventDefault();
                    else event.returnValue = false;
                };
            })(marker));
            window.markers.push(marker);
        }
    };
    
    var initializeMap = function() {
        resizeMap();
        $(window).resize(resizeMap);
        var m_options = {
            center: getMapCenter(),
            zoom: 1,
            mapTypeId: google.maps.MapTypeId.ROADMAP
        };
        window.map = new google.maps.Map($('#map')[0], m_options);
        map.fitBounds(getMapBounds());
        updateMarkers();
    };
    
    if(window.use_comet && window.google_maps) {
        initializeMap();
        setInterval(updateCometToken, 30000);
        setTimeout(connectToCometServer, 0);
    }
});