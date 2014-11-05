$(function() {
  $('.post-button').click(function(e){
    e.preventDefault();
    $('#loading').show();
    navigator.geolocation.getCurrentPosition(successCallback, errorCallback,{
    enableHighAccuracy:true 
    });
    function successCallback(position){
      var chairLati=position.coords.latitude;
      var chairLong=position.coords.longitude;
      var accuracy=position.coords.accuracy;
      var message=$ ("#message").val();

      var params =
        {
          'latitude'  : chairLati, 
          'longitude' : chairLong, 
          'accuracy'  : accuracy,
          'message'   : message
        }

       if($("#social").prop('checked')) {
         params.post_to_twitter_flg=true;
       }

      $.post('/swatter/checkin',params,function(data){
          location.href = data.redirect_path;
      });

    }

    function errorCallback(error){
      console.log(error);
    }
  });
});
