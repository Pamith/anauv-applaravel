$(document).ready(function(){
            	 $('#valid-date').datepicker({
                     minDate: 0
                 });
                  $('#km').keyup(function(){
                     var lat = getCookie('lat');
                      if (lat != '') {
                        filterFunction();
                      }
                      else{
                            $('#locationModal').modal('show');
                      }

                     
                  });
            	 $('.cat-filter').click(function(){
            	 	filterFunction();                  
            	 });  
            	 var filterFunction = function() {
                  	var ids = [];
            	 	var cat = $('.cat-filter:checkbox:checked');
            	 	var dist = $('#km').val();
            	 	cat.each(function(){
                       ids.push($(this).attr('id'));
            	 	});
					        	
	                $.ajax({
					        headers: {
					                  'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
					                },
					        type:'POST',
					        url:'http://localhost/demoapp/public/shop/filters',
					        data:'filter_ids='+ids+'&distance='+dist,
					        success:function(msg){
					 
					          $('#listOffers').html(msg.html);
					        }
					    });
                  };  

            	});