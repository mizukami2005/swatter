$(function() {
  var location_util = {
    get_nearby_places: function(callback, lat, lng, radius) {
       $.getJSON(
          "/swatter/get_nearby_places.json", {
          latitude: lat,
          longitude: lng,
          radius: radius,
       }, function(data) {
          callback(data);
       }); 
    },
    get_place_information: function(callback, id, latitude, longitude) {
      var params = { id: id };
      if (typeof latitude !== 'undefined' && typeof longitude !== 'undefined') {
        params.latitude = latitude;
        params.longitude = longitude;
      }
      $.getJSON(
        "/swatter/get_place_information.json", params, function(data) {
           callback(data);
        }
      );    
    },
    get_mayors_by_area: function(callback, area) {
      $.getJSON(
        "/swatter/get_mayors_by_area.json", {
          area: area
        }, function(data) {
          callback(data);
        }
      )                        
    }
  }; 
  window.location_util = location_util;
});
