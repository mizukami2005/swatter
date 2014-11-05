$(function() {
  function makeMyMap(latitude,longitude){
    var myMap = new google.maps.Map(document.getElementById('map_canvas'),{
      zoom: 15,
      scrollwheel: false,
      mapTypeId: google.maps.MapTypeId.ROADMAP,
      zoomControl: false,
      streetViewControl: false
    });
    var myLatlng = new google.maps.LatLng(latitude, longitude);

    myMap.setCenter(myLatlng);
  }

  function setPosition(latitude,longitude,myMapTest){
    var latlng = new google.maps.LatLng(latitude, longitude);
    var marker = new google.maps.Marker({
         position: latlng,
         map: myMapTest,
     });
  }

  function getQueryVariable(variable) {
    var query = window.location.search.substring(1),
        vars = query.split("&");

    for (var i = 0; i < vars.length; i++) {
      var pair = vars[i].split("=");
      if (pair[0] == variable) {
        return pair[1];
      }
    }
    return false;
  }

  var query_id;

  (function() {
    if (getQueryVariable('id')) {
      query_id = getQueryVariable('id');
    } else {
      // idがないエラー処理
    }
  })();

  // 以下jsonから取得したデータをビューに渡す処理
  var _datalat;
  var _datalng;
  var placeInfoCallback = function(data) {
    $('#loading').hide();
    if ($('#map_canvas').is(':visible') !== false) {
      makeMyMap(data.latitude, data.longitude);
      $('.detail-header img').attr('src', data.picture);
      $('.add-map-style').attr('href', 'http://maps.google.com/maps?q=' + data.latitude + ', ' + data.longitude);
      latitude = data.latitude;
      logitude = data.longitude;
      _datalat = data.latitude;
      _datalng = data.longitude;
    }
    if (typeof data.time !== 'undefined' && typeof data.distance !== 'undefined') {
      $('.detail-info').show();
      $('#time').text(data.time);
      $('#distance').text(Math.round(data.distance));
      $('.nav > h1').text(data.area.name);
      $('.chair-info > .time-and-distance').text(data.time + '分 ( ' + Math.round(data.distance) + 'm )');
      $('.chair-info > .checkins').text(data.checkins + ' check-in');
      $('.chair-info > .likes').text(data.likes + ' likes');
    }
  }

  window.location_util.get_place_information(function(data) {
    placeInfoCallback(data);
  }, query_id);

  setTimeout(function() {
  navigator.geolocation.getCurrentPosition(function(position) {
    $('#map_canvas').empty().hide();

    var latitude = position.coords.latitude;
    var longitude = position.coords.longitude;

    var route_data;
    window.location_util.get_place_information(function(data) {
      placeInfoCallback(data);
    }, query_id, latitude, longitude);
      var myOptions ={

    zoom:15,

    mapTypeId: google.maps.MapTypeId.ROADMAP,

    zoomControl: false,
    streetViewControl: false

  };//地図プロパティここまで
  var rendererOptions=
  {
    draggable:true,
    preserveViewport:false
  };
  var directionsDisplay=new google.maps.DirectionsRenderer(rendererOptions);
  var directionsService=new google.maps.DirectionsService();
  var request=
{
  origin: new google.maps.LatLng(latitude,longitude),//出発点
  destination: new google.maps.LatLng(_datalat, _datalng),//到着点
  travelMode: google.maps.DirectionsTravelMode.WALKING,//歩行モード
  unitSystem: google.maps.DirectionsUnitSystem.METRIC,
  optimizeWaypoints:true,
  avoidHighways:false,
  avoidTolls:false
};
directionsService.route(request, function(response,status)
{
  if(status==google.maps.DirectionsStatus.OK)
  {
    directionsDisplay.setDirections(response);
  }
});
$('#navigation_canvas').show();
var map=new google.maps.Map(document.getElementById("navigation_canvas"), myOptions);
directionsDisplay.setMap(map);
  }, function() {
  }, {
    enableHighAccuracy:true
  });
}, 2000);

  $('.like-button').on('click', function() {
    $.post('/swatter/add_like', { place_id: getQueryVariable('id') }, function() {
      if (!$('.like-button').hasClass('pushed')) {
        $('.like-button').text('Liked!').addClass('pushed');
        var likes = $('.likes').text().split(' ', 1);
        if (likes == '-') {
          likes = 0;
        }
        $('.likes').text(++likes + ' likes');
      }
    });
  });
});

