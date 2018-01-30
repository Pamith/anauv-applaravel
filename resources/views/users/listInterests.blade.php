
@extends('layouts.app')

@section('content')
<link rel="stylesheet" href="{{ URL::asset('css/listInterests.css') }}">

<div class="container">
        <div class="row">
        <div class="gallery col-lg-12 col-md-12 col-sm-12 col-xs-12">
            <h1 class="gallery-title">Our Categories</h1>
        </div>

        <div align="center" id="ourCategories">
            
            @foreach($datas['parents'] as $parent)
             <span class="btn btn-default filter-button interests {{ in_array($parent->id,$selected_data) ? 'selected' : '' }}" data-filter="{{$parent->id}}">{{$parent->name}}</span>
            @endforeach
        </div>
        <div align="center">
        	<button id="addToProfile">Add To MyProfile</button>
        </div>


        <!-- @foreach($datas['childrens'] as $child)
            <div class="gallery_product col-lg-4 col-md-4 col-sm-4 col-xs-6 filter {{$child->parent_id}}">
                <span>{{$child->name}}</span>
            </div>
        @endforeach -->
            
        </div>
    </div>
<script type="text/javascript">
	$(document).ready(function(){
		$('#addToProfile').click(function(){
			var selected=[];
			$('#ourCategories .selected').each(function(){
				var data ={
					id:$(this).attr('data-filter'),
					name:$(this).text(),
				}
				selected.push(data);
			});
			if (selected.length < 3) {
              alert('You Have To Select Minimum 3');
			}
			else{
				$.ajax({
			        headers: {
			                      'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
			                },
			        type:'POST',
			        url:'http://localhost/demoapp/public/user/interests',
			        data:'data='+JSON.stringify(selected),
			        success:function(msg){
			        	console.log(msg);
			            window.location.href ='http://localhost/demoapp/public/user/';
			        }
			    });
			}
			
           });
	    $('.interests').click(function(){
			if ($(this).hasClass( "selected" )) {
				$(this).removeClass('selected')
			}
			else{
				$(this).addClass('selected')
			}
		});
    $(".filter-button").click(function(){
        var value = $(this).attr('data-filter');
        
        if(value == "all")
        {
            //$('.filter').removeClass('hidden');
            $('.filter').show('1000');
        }
        else
        {
//            $('.filter[filter-item="'+value+'"]').removeClass('hidden');
//            $(".filter").not('.filter[filter-item="'+value+'"]').addClass('hidden');
            $(".filter").not('.'+value).hide('3000');
            $('.filter').filter('.'+value).show('3000');
            
        }
    });
    
    if ($(".filter-button").removeClass("active")) {
$(this).removeClass("active");
}
$(this).addClass("active");

});
</script>

@endsection