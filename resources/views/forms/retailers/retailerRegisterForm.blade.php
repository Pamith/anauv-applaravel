<!-- {{ print_r($cat) }} -->
<link rel="stylesheet" href="{{ URL::asset('css/addRetailer.css') }}">
<div class="container">
    <div class="row">
        <div class="col-md-8 col-md-offset-2">
            <div class="panel panel-default">
                <div class="panel-heading">Add Business</div>

                <div class="panel-body">

                   <form id='msform' class="form-horizontal" method="POST" action="{{ route('processRetailer') }}">
{{ csrf_field() }}
            <!-- progressbar -->
            <ul id="progressbar">
                <li class="active">Business Details</li>
                <li>Contact Details</li>
                
            </ul>
            @if ($errors->has('shopname'))
                <span class="help-block">
                    <strong>{{ $errors->first('shopname') }}</strong>
                </span>
            @endif
            @if ($errors->has('category'))
                <span class="help-block">
                    <strong>{{ $errors->first('category') }}</strong>
                </span>
            @endif
            @if ($errors->has('shopownername'))
                <span class="help-block">
                    <strong>{{ $errors->first('shopownername') }}</strong>
                </span>
            @endif
             @if ($errors->has('email'))
                <span class="help-block">
                    <strong>{{ $errors->first('email') }}</strong>
                </span>
            @endif
             @if ($errors->has('mobile'))
                <span class="help-block">
                    <strong>{{ $errors->first('mobile') }}</strong>
                </span>
            @endif
             @if ($errors->has('retailerpassword'))
                <span class="help-block">
                    <strong>{{ $errors->first('retailerpassword') }}</strong>
                </span>
            @endif
            <!-- fieldsets -->
            <fieldset>
                <h2 class="fs-title">Business Details</h2>
                <h3 class="fs-subtitle">Tell us something more about your Business</h3>
                    <div class="form-group{{ $errors->has('shopname') ? ' has-error' : '' }}">
                            <label for="shopname" class="col-md-4 control-label">Shop Name</label>

                            <div class="col-md-6">
                                <input id="shopname" type="text" class="form-control" name="shopname" value="{{ old('shopname') }}" required autofocus>

                                @if ($errors->has('shopname'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('shopname') }}</strong>
                                    </span>
                                @endif
                            </div>
                    </div>
                    <div class="form-group{{ $errors->has('category') ? ' has-error' : '' }}">
                            <label for="category" class="col-md-4 control-label">Category</label>

                            <div class="col-md-6">
                                <select id="category" type="text" class="form-control" name="category[]" value="" required multiple>
                                    @foreach($cat as $cats)
                                       <option value="{{ $cats->id }}" {{ !empty(old('category')) ? in_array($cats->id,old('category')) ? 'selected':'' :''}}>{{ $cats->name }} </option>
                                    @endforeach
                                </select>

                                @if ($errors->has('category'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('category') }}</strong>
                                    </span>
                                @endif
                            </div>
                    </div>
                    <div class="form-group{{ $errors->has('retailerlocation') ? ' has-error' : '' }}">
                            <label for="retailerlocation" class="col-md-4 control-label">Location</label>

                            <div class="col-md-4" id="locationList">
                                <textarea id="loc_0" type="textarea" class="form-control retailerlocation" name="retailerlocation[]" required value="">{{old('retailerlocation.0')}}</textarea>
                                <input id="lattitude" type="hidden" class="form-control" name="lattitude[]" required value="{{old('lattitude.0')}}">
                                <input id="longtitude" type="hidden" class="form-control" name="longtitude[]" required value="{{old('longtitude.0')}}">

                            </div>
                            
                                <span class="col-md-2 btn" id="useLocation">Current Location</span>
                                <span class="col-md-2 btn" id="addMoreLocation">Add More</span>                            
                    </div>                        
                    <input type="button" name="next" class="next action-button" value="Next"/>
            </fieldset>
            <fieldset>
                <h2 class="fs-title">Create your account</h2>
                <h3 class="fs-subtitle">Fill in your credentials</h3>
                    <div class="form-group{{ $errors->has('shopownername') ? ' has-error' : '' }}">
                            <label for="shopownername" class="col-md-4 control-label">Retailer's Name</label>

                            <div class="col-md-6">
                                <input id="shopownername" type="text" class="form-control" name="shopownername" value="{{ old('shopownername') }}" required autofocus>

                                @if ($errors->has('shopownername'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('shopownername') }}</strong>
                                    </span>
                                @endif
                            </div>
                    </div>
                    <div class="form-group{{ $errors->has('email') ? ' has-error' : '' }}">
                            <label for="email" class="col-md-4 control-label">E-Mail</label>

                            <div class="col-md-6">
                                <input id="email" type="email" class="form-control" name="email" value="{{ old('email') }}" required>

                                @if ($errors->has('email'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('email') }}</strong>
                                    </span>
                                @endif
                            </div>
                    </div>
            
                <div class="form-group{{ $errors->has('mobile') ? ' has-error' : '' }}">
                            <label for="mobile" class="col-md-4 control-label">Mobile</label>

                            <div class="col-md-6">
                                <input id="mobile" type="text" class="form-control" name="mobile" value="{{ old('mobile') }}" required>

                                @if ($errors->has('mobile'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('mobile') }}</strong>
                                    </span>
                                @endif
                            </div>
                </div>
                    <div class="form-group{{ $errors->has('retailerpassword') ? ' has-error' : '' }}">
                        <label for="retailerpassword" class="col-md-4 control-label">Password</label>

                            <div class="col-md-6">
                                <input id="retailerpassword" type="password" class="form-control" name="retailerpassword" required>

                                @if ($errors->has('retailerpassword'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('retailerpassword') }}</strong>
                                    </span>
                                @endif
                            </div>
                    </div>
                    <div class="form-group">
                            <label for="retailerpassword-confirm" class="col-md-4 control-label">Confirm Password</label>

                            <div class="col-md-6">
                                <input id="retailerpassword-confirm" type="password" class="form-control" name="retailerpassword_confirmation" required>
                            </div>
                    </div>
                                <input type="button" name="previous" class="previous action-button-previous" value="Previous"/>
                                <button type="submit" class="btn btn-primary">
                                    Register
                                </button>
            </fieldset>
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

    if ($('#shopname').val() !='' && $('#category').val() !=''&& $('#loc_0').val() !=''&& $('#lattitude').val() !=''&& $('#longtitude').val() !='') {
        current_fs = $(this).parent();
        next_fs = $(this).parent().next();
   
        //activate next step on progressbar using the index of next_fs
        $("#progressbar li").eq($("fieldset").index(next_fs)).addClass("active");
        
        //show the next fieldset
        next_fs.fadeIn('slow');
        current_fs.fadeOut('fast');
    }
    else{
        alert('You Have Fill This Fields First');
    }
    
    
    //hide the current fieldset with style
    
});

$(".previous").click(function(){    
    current_fs = $(this).parent();
    previous_fs = $(this).parent().prev();
    
    //de-activate current step on progressbar
    $("#progressbar li").eq($("fieldset").index(current_fs)).removeClass("active");
  
    //show the previous fieldset
    previous_fs.fadeIn('slow');
    current_fs.fadeOut('fast');
    

    //hide the current fieldset with style
});
var l=0;
$('#addMoreLocation').click(function(){
if ($('#loc_'+l).val()) {
    l++;
 $('#useLocation').hide();
    var data ='<textarea id="loc_'+l+'" type="textarea" class="form-control retailerlocation" name="retailerlocation[]" required value=""></textarea><input id="lattitude'+l+'" type="hidden" class="form-control" name="lattitude[]" required value=""><input id="longtitude'+l+'" type="hidden" class="form-control" name="longtitude[]" required value="">';
   $('#locationList').append(data);
   }
   else{
    alert('Fill The Previous Location Field First');
   }
});

});
</script>
