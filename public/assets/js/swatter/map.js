var CORREPON_TABLE = [];

var counter = new function() {
  var cnt = 0;
  this.get = function() {
    return cnt++;
  };

  this.reset = function() {
    return cnt = 0;
  };
}

var markers = [];

function attachMessage(marker,id){
    google.maps.event.addListener(marker, 'click', function(event){
        $('.carousel').slickGoTo(CORREPON_TABLE[id]);
    });
}

function makeMyMap(latitude,longitude){
    var myMap = new google.maps.Map(document.getElementById('map_canvas'),{
    zoom: 16,
    scrollwheel: false,
    mapTypeId: google.maps.MapTypeId.ROADMAP,
    zoomControl: false,
    streetViewControl: false
    });

    var myLatlng = new google.maps.LatLng(latitude, longitude);
    myMap.setCenter(myLatlng);
    putMyOwnPin(latitude,longitude,myMap);
    return myMap;
}

function putMyOwnPin(latitude, longitude, myMap) {
  var latlng = new google.maps.LatLng(latitude, longitude);
  var marker = new google.maps.Marker({
    position: latlng,
    map: myMap,
    icon: '../assets/img/swatter/my_pin.png'
  });

  var marker_id = counter.get();
  var sliderCount = $('.slick-track > *').not('.slick-cloned').length;
  
  CORREPON_TABLE[marker_id] = sliderCount++;
  attachMessage(marker, marker_id);
}  

function setPosition(latitude,longitude,myMapTest){
    var latlng = new google.maps.LatLng(latitude, longitude);
    var marker = new google.maps.Marker({
         position: latlng,
         map: myMapTest
     });

    var marker_id = counter.get();
    var sliderCount = $('.slick-track > *').not('.slick-cloned').length;
    CORREPON_TABLE[marker_id] = sliderCount++;

    attachMessage(marker, marker_id);
    markers.push(marker);
}

var temp = [];
var myLatitude;
var myLongitude;
var chairLati;
var chairLong;
$(function() {
    var zoomLevel;
    var resizeMap = function() {
      var windowHeight = $(window).height();
      $('#map_canvas').height(windowHeight - 188);
    };
    resizeMap();
    $(window).resize(function() {
      resizeMap();
    });

    //ユーザーの現在の位置情報を取得
    navigator.geolocation.getCurrentPosition(successCallback, errorCallback,{
        enableHighAccuracy:true 
    });

    var getNearbyPlaces = function(latitude, longitude, zoom, map) {
      var ZOOM_SCALES = [ 0, 591657551, 295828775, 147914388, 73957194, 36978597, 18489298, 9244649, 4622325, 2311162, 1155581, 577791, 288895, 144448, 72224, 36112 ];


      window.location_util.get_nearby_places(function(data) {
        var i, place;

        // reset data
        CORREPON_TABLE = [];
        counter.reset();
        for (var i = 0; i < markers.length; i++ ) {
          markers[i].setMap(null);
        }
        markers.length = 0;
        $('.slick-track').empty();

        for (i = 0; i < data.length; i++) {
            place = data[i];
            setPosition(place.latitude, place.longitude, map);
            $('.carousel').slickAdd($('<div/>').append(
              $('<div/>').append(
                $('<a/>').attr('href', place.url).append(
                  $('<img/>').attr('src', place.thumbnail),
                  $('<h3/>').text('徒歩' + place.time + '分 (' + Math.round(place.distance) + 'm)'),
                  $('<h3/>').text(place.checkins + ' check-in' + (place.checkins === 1 ? '' : 's')),
                  $('<h3/>').text(place.likes + ' like' + (place.likes === 1 ? '' : 's'))
                )
              )
            ).html());
          }
          $(".place-count").text(data.length);
        }, latitude, longitude, 0.03 * ZOOM_SCALES[zoom] > 300 ? 0.03 * ZOOM_SCALES[zoom] : 300);
      }

    /***** ユーザーの現在の位置情報を取得 *****/
    function successCallback(position) {
      $('#loading').hide();
      var latitude = position.coords.latitude;
      var longitude = position.coords.longitude;
      var map = makeMyMap(latitude, longitude);
      getNearbyPlaces(latitude, longitude, 16, map);

      google.maps.event.addListener(map, 'dragend', function() {
        var center = map.getCenter();
        var zoomLevel = map.getZoom();
        getNearbyPlaces(center.k, center.B, zoomLevel, map);
      });

      google.maps.event.addListener(map, 'zoom_changed', function() {
        var center = map.getCenter();
        var zoomLevel = map.getZoom();
        getNearbyPlaces(center.k, center.B, zoomLevel, map);
      });
    }

    /***** 位置情報が取得できない場合 *****/
    function errorCallback(error) {
        console.log(error);
    }
});
