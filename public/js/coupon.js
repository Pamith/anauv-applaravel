var sendCoupon = function(data) {
	console.log(data);
	$.ajax({
        headers: {
                      'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                },
        type:'POST',
        url:'http://localhost/demoapp/public/shop/sendcoupon',
        data:'offer_id='+data.attr('data-id'),
        success:function(msg){
          console.log(msg);
        }
    });
}
