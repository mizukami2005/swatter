$(function() {
    //ユーザーの現在の位置情報を取得
    navigator.geolocation.getCurrentPosition(successCallback, errorCallback, {
        enableHighAccuracy: true
    });
    /***** ユーザーの現在の位置情報を取得 *****/
    function successCallback(position) {
        $('#loading').hide();
        myLatitude = position.coords.latitude;
        myLongitude = position.coords.longitude;
        window.location_util.get_nearby_places(function(data) {
          var chair, i;
          for (i = 0; i < data.length; i++) {
            chair = data[i];
            $(".chair-list").append(
              $('<li/>').css('background-image', "url('" + chair.picture + "')").append(
                $('<a/>').attr('href', chair.url).append(
                  $('<ul/>').addClass('chair-info').append(
                    $('<li/>').addClass('time-and-distance').text(chair.time + '分 ( ' + Math.round(chair.distance) + 'm )'),
                    $('<li/>').addClass('checkins').text(chair.checkins + ' check-in'),
                    $('<li/>').addClass('likes').text(chair.likes + ' likes')
                  )
                )
              )
            );
          }
          $(".place-count").text(data.length);
        }, myLatitude, myLongitude, 1000);
    }
    /***** 位置情報が取得できない場合 *****/
    function errorCallback(error) {
    }
});

