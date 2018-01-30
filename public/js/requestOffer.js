$(document).ready(function(){
  $('#req-offer').click(function(){
     $.ajax({
	        headers: {
	                  'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
	                },
	        type:'POST',
	        url:'http://localhost/demoapp/public/shop/requestOffer',
	        data:'request_type=modal',
	        success:function(msg){
	          $('body').append(msg.html);
	          $('#requestOffer-catList').modal('show');
	        }
	    });
  })
  $(document).on('click','#sendRequest',function(e) {
  	e.preventDefault();
  		var ids = [];
	 	var cat = $('.cat-requestOffer:checkbox:checked');
	 	var dist = $('#km').val();
	 	cat.each(function(){
           ids.push($(this).attr('id'));
	 	});
		        
		       if (ids.length != 0) {
		       	console.log(ids);
		       }
		       else{
		       	alert('Select Any One Category You Want');
		       }	
        $.ajax({
		        headers: {
		                  'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
		                },
		        type:'POST',
		        url:'http://localhost/demoapp/public/shop/requestOffer',
		        data:'request_type=offer&offer_ids='+ids,
		        success:function(msg){
		 
		          $('#listOffers').html(msg.html);
		        }
		    });
  });
});