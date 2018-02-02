function confirmLoc(count){
  $("#lattitude_"+count.attr('data-count')).val(count.attr('data-lat'));
  $("#longtitude_"+count.attr('data-count')).val(count.attr('data-lng'));
  $("textarea#loc_"+count.attr('data-count')).val(count.attr('data-addr'));
  $("#locResults_"+count.attr('data-count')).html('');
  event.preventDefault();
};
$(document).ready(function(){

$('#useLocation').click(function(e){
    e.preventDefault();
    if(navigator.geolocation){
        navigator.geolocation.getCurrentPosition(showLocation);
    }else{ 
        $('#location').html('Geolocation is not supported by this browser.');
    }
});

function showLocation(position){
    var latitude = position.coords.latitude;
    var longitude = position.coords.longitude;
    
    $.ajax({
        headers: {
                      'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                },
        type:'POST',
        url:'http://localhost/demoapp/public/getlocation',
        data:'latitude='+latitude+'&longitude='+longitude,
        success:function(msg){
            if(msg.status =='OK'){
               $("#loc_0").val(msg.location);
               $("#lattitude_0").val(latitude);
               $("#longtitude_0").val(longitude);
            }else{
                 $("#loc_0").val('')
                 $("#lattitude_0").val('');
               $("#longtitude_0").val('');
                alert(msg.location);
            }
        }
    });
}



})

