var latitude;
var longitude;
var lat = getCookie('lat');
var lng = getCookie('lng');
var visit = getCookie('visit');
if (!visit && (!lat || !lng)) {
    setCookie('visit',true,1);
    $('#locationModal').modal('show');
    }
function showLocation(position){
    latitude = position.coords.latitude;
    longitude = position.coords.longitude;
		setCookie('lat',latitude,12);
		setCookie('lng',longitude,12);
    window.location.reload(true);	
}
function setCookie(name, value, days) {
  var date = new Date();
  date.setTime(date.getTime()+(days*24*60*60*1000));
  var expires = "; expires="+date.toGMTString();
  document.cookie = name + "=" + value +
                    expires + "; path=/";
}
function getCookie(name) {
  var cArr = document.cookie.split(';');
  for(var i=0;i < cArr.length;i++) {
    var cookie = cArr[i].split("=",2);
    cookie[0] = cookie[0].replace(/^\s+/,"");
    if (cookie[0] == name){ return cookie[1]; }
  }
}
$('#useThis').click(function(){
   if(navigator.geolocation){
        navigator.geolocation.getCurrentPosition(showLocation);

    }else{ 
        alert('You Have To Allow');
    }
});

$('#searchLoc').keyup(function(){

 
  if ($(this).val().length>=3) {
     $.ajax({
        headers: {
                      'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                },
        type:'POST',
        url:'http://localhost/demoapp/public/getlatlong',
        data:'address='+$(this).val(),
        success:function(msg){
          console.log(msg);
            msg = JSON.parse(msg);
            if(msg.status =='OK'){
                console.log(msg);
                $('#locResults').html('<button class="btn btn-success" onclick="searchLocCookie($(this))" data-lat="'+msg.results[0].geometry.location.lat+'" data-lng="'+msg.results[0].geometry.location.lng+'">'+msg.results[0].formatted_address+'</button>');
            }
        }
    });
  }
});
var searchLocCookie = function(location){
   setCookie('lat',location.attr('data-lat'),12);
    setCookie('lng',location.attr('data-lng'),12);
    window.location.reload(true); 
};
