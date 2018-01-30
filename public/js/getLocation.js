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
               $(".retailerlocation").val(msg.location);
               $("#lattitude").val(latitude);
               $("#longtitude").val(longitude);
            }else{
                 $(".retailerlocation").val('')
                 $("#latitude").val('');
               $("#longitude").val('');
                alert(msg.location);
            }
        }
    });
}

$(document).on('change','.retailerlocation',function(){
   var address = $(this);
   showAddress(address);
});
function showAddress(address){
    
    $.ajax({
        headers: {
                      'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                },
        type:'POST',
        url:'http://localhost/demoapp/public/getlatlong',
        data:'address='+address.val(),
        success:function(msg){
            msg = JSON.parse(msg);
            if(msg.status =='OK'){
                console.log(msg);
               address.val(msg.results[0].formatted_address);
               $("#lattitude"+address.attr('id')).val(msg.results[0].geometry.location.lat);
               $("#longtitude"+address.attr('id')).val(msg.results[0].geometry.location.lng);
            }else{
                 // $("#retailerlocation").val('');
                 $("#latitude").val('');
               $("#longitude").val('');
                alert(msg.status);
            }
        }
    });
}
})

