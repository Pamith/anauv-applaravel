<link rel="stylesheet" href="{{ URL::asset('css/addRetailer.css') }}">
<div class="container">
    <div class="row">
        <div class="col-md-8 col-md-offset-2">
            <div class="panel panel-default">
                <div class="panel-heading">Provide Offers</div>

                <div class="panel-body">

                   <form id='addOffer' class="form-horizontal" method="POST" action="">
                   {{ csrf_field() }}
            
                    
                    <div class="form-group{{ $errors->has('shortdescription') ? ' has-error' : '' }}">
                            <label for="description" class="col-md-4 control-label"> Short Description</label>

                            <div class="col-md-6">
                                <input id="shortdescription" type="textarea" class="form-control shortdescription" name="shortdescription" required value="{{ old('shortdescription') }}">
                            </div>                            
                    </div> 
                    <div class="form-group{{ $errors->has('description') ? ' has-error' : '' }}">
                            <label for="description" class="col-md-4 control-label">Description</label>

                            <div class="col-md-6">
                                <textarea id="description" type="textarea" class="form-control description" name="description" required value="{{ old('description') }}"></textarea>
                            </div>                            
                    </div> 
                    <div class="form-group{{ $errors->has('offer') ? ' has-error' : '' }}">
                            <label for="offer" class="col-md-4 control-label">Offer Code Prefix</label>

                            <div class="col-md-6">
                                <input id="offer" type="text" class="form-control" name="offer" value="{{ old('offer') }}" required autofocus>

                                @if ($errors->has('offer'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('offer') }}</strong>
                                    </span>
                                @endif
                            </div>
                    </div>
                    <div class="form-group{{ $errors->has('category') ? ' has-error' : '' }}">
                            <label for="category" class="col-md-4 control-label">Category</label>

                            <div class="col-md-6">
                                <select id="category" type="text" class="form-control" name="category" value="{{ old('category') }}" required>
                                    @foreach($cat as $cats)
                                       <option value="{{ $cats->id }}">{{ $cats->name }} </option>
                                    @endforeach
                                </select>

                                @if ($errors->has('category'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('category') }}</strong>
                                    </span>
                                @endif
                            </div>
                    </div>  
                    <div class="form-group{{ $errors->has('shop') ? ' has-error' : '' }}">
                            <label for="shop" class="col-md-4 control-label">Shop</label>

                            <div class="col-md-6">
                                <select id="shop" type="text" class="form-control" name="shop" value="{{ old('shop') }}" required>
                                    @foreach($shops as $shop)
                                       <option value="{{ $shop->address }}-{{ $shop->latitude }}-{{ $shop->longitude }}">{{ $shop->address }} </option>
                                    @endforeach
                                </select>

                                @if ($errors->has('shop'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('shop') }}</strong>
                                    </span>
                                @endif
                            </div>
                    </div>                       
                    <div class="form-group{{ $errors->has('startdate') ? ' has-error' : '' }}">
                            <label for="startdate" class="col-md-4 control-label">Start Date</label>

                            <div class="col-md-6">
                                <input id="startdate" type="text" class="form-control" name="startdate" value="{{ old('startdate') }}" required autofocus>

                                @if ($errors->has('startdate'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('startdate') }}</strong>
                                    </span>
                                @endif
                            </div>
                    </div>
                    <div class="form-group{{ $errors->has('enddate') ? ' has-error' : '' }}">
                            <label for="enddate" class="col-md-4 control-label">End Date</label>

                            <div class="col-md-6">
                                <input id="enddate" type="text" class="form-control" name="enddate" value="{{ old('enddate') }}" required autofocus>

                                @if ($errors->has('enddate'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('enddate') }}</strong>
                                    </span>
                                @endif
                            </div>
                    </div>
                                <button type="submit" class="btn btn-primary">
                                    Register
                                </button>
           
        </form>
                    <!-- <div id="main">
                              <div id="firebaseui-container"></div>                            
                    </div> -->
                </div>
            </div>
        </div>
    </div>
</div>
<script type="text/javascript">

$(document).ready(function(){

//jQuery time
var current_fs, next_fs, previous_fs; //fieldsets
var left, opacity, scale; //fieldset properties which we will animate
var animating; //flag to prevent quick multi-click glitches


$(".next").click(function(){
    
    current_fs = $(this).parent();
    next_fs = $(this).parent().next();
   
    //activate next step on progressbar using the index of next_fs
    // $("#progressbar li").eq($("fieldset").index(next_fs)).addClass("active");
    
    //show the next fieldset
     next_fs.fadeIn('slow');
    current_fs.fadeOut('fast');
    
    //hide the current fieldset with style
    
});

$(".previous").click(function(){    
    current_fs = $(this).parent();
    previous_fs = $(this).parent().prev();
    
    //de-activate current step on progressbar
    // $("#progressbar li").eq($("fieldset").index(current_fs)).removeClass("active");
     console.log(current_fs);
    //show the previous fieldset
    previous_fs.fadeIn('slow');
    current_fs.fadeOut('fast');
    

    //hide the current fieldset with style
});
var l=0;
$('#addMoreLocation').click(function(){
if ($('#'+l).val()) {
    l++;
 $('#useLocation').hide();
    var data ='<textarea id="'+l+'" type="textarea" class="form-control retailerlocation" name="retailerlocation[]" required value=""></textarea><input id="lattitude'+l+'" type="hidden" class="form-control" name="lattitude[]" required value=""><input id="longtitude'+l+'" type="hidden" class="form-control" name="longtitude[]" required value="">';
   $('#locationList').append(data);
   }
   else{
    alert('Fill The Previous Location Field First');
   }
});
 $('#startdate').datepicker();
 $('#enddate').datepicker();
});
</script>
