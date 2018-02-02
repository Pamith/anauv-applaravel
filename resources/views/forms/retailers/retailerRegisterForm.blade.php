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
                <li class="active">Account Details</li>
                <li>Business Details</li>
                <li>Branch Details</li>
                
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
            <div class="multi-form">
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
                    <input type="button" name="next" class="next action-button" value="Next"/>                               
            </div>
            <div class="multi-form">
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
                    <input type="button" name="previous" class="previous action-button-previous" value="Previous"/>
                    <input type="button" name="next" class="next action-button" value="Next"/>
            </div>
            <div class="multi-form">
                        <h2 class="fs-title">Branch Details</h2>
                        <h3 class="fs-subtitle">ADD Your Branch Location</h3>
                    <div id="branches">
                      <fieldset>
                        <legend>Branch 1:</legend>
                        <div class="form-group">
                            <label for="shop_contact" class="col-md-4 control-label">Contact Name</label>

                            <div class="col-md-6">
                                <input id="shop_contact" type="text" class="form-control" name="shop_contact[]" value="">
                            </div>
                       </div>
                       <div class="form-group">
                            <label for="shop_email" class="col-md-4 control-label">Contact Email</label>

                            <div class="col-md-6">
                                <input id="shop_email" type="text" class="form-control" name="shop_email[]" value="">
                            </div>
                       </div>
                       <div class="form-group">
                            <label for="shop_mobile" class="col-md-4 control-label">Contact Mobile</label>

                            <div class="col-md-6">
                                <input id="shop_mobile" type="text" class="form-control" name="shop_mobile[]" value="">
                            </div>
                       </div>
                    
                       <div class="form-group{{ $errors->has('retailerlocation') ? ' has-error' : '' }}">
                            <label for="retailerlocation" class="col-md-4 control-label">Location</label>

                            <div class="col-md-6" id="locationList">
                                <textarea id="loc_1" type="textarea" class="form-control retailerlocation" name="retailerlocation[]" required data-count ="1" value="">{{old('retailerlocation.0')}}</textarea>
                                <input id="lattitude_1" type="hidden" class="form-control" name="lattitude[]" required value="{{old('lattitude.0')}}">
                                <input id="longtitude_1" type="hidden" class="form-control" name="longtitude[]" required value="{{old('longtitude.0')}}">
                                <div id="locResults_1"></div>
                            </div>
                            
                                <span class="col-md-2 btn" id="useLocation">Current Location</span>                                     
                         </div>
                      </fieldset>
                    </div>
                    <div class="form-group">
                     <span class="btn btn-alert" id="addMoreBranch">Add Another Branch</span> 
                    </div>
                     <input type="button" name="previous" class="previous action-button-previous" value="Previous"/>
                                <button type="submit" class="btn btn-primary">
                                    Register
                                </button>             
            </div>
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
        $("#progressbar li").eq($(".multi-form").index(next_fs)).addClass("active");
        
        //show the next fieldset
        next_fs.fadeIn('slow');
        current_fs.fadeOut('fast');

    
    
    //hide the current fieldset with style
    
});

$(".previous").click(function(){    
    current_fs = $(this).parent();
    previous_fs = $(this).parent().prev();
    
    //de-activate current step on progressbar
    $("#progressbar li").eq($(".multi-form").index(current_fs)).removeClass("active");
  
    //show the previous fieldset
    previous_fs.fadeIn('slow');
    current_fs.fadeOut('fast');
    

    //hide the current fieldset with style
});
var l=1;
$('#addMoreBranch').click(function(){
if ($('#loc_'+l).val()) {
    l++;
 $('#useLocation').hide();
    var data ='<fieldset><legend>Branch '+l+ ':</legend><div class="form-group"><label for="shop_contact" class="col-md-4 control-label">Contact Name</label><div class="col-md-6"><input id="shop_contact'+l+'" type="text" class="form-control" name="shop_contact[]" value=""></div></div><div class="form-group"><label for="shop_email" class="col-md-4 control-label">Contact Email</label><div class="col-md-6"><input id="shop_email'+l+'" type="text" class="form-control" name="shop_email[]" value=""></div></div><div class="form-group"><label for="shop_mobile" class="col-md-4 control-label">Contact Mobile</label><div class="col-md-6"><input id="shop_mobile'+l+'" type="text" class="form-control" name="shop_mobile[]" value=""></div></div><div class="form-group"><label for="retailerlocation" class="col-md-4 control-label">Location</label><div class="col-md-6"><textarea id="loc_'+l+'" type="textarea" class="form-control retailerlocation" name="retailerlocation[]" data-count ="'+l+'" value=""></textarea><input id="lattitude_'+l+'" type="hidden" class="form-control" name="lattitude[]" required value=""><input id="longtitude_'+l+'" type="hidden" class="form-control" name="longtitude[]" required value=""><div id="locResults_'+l+'"></div></div></div></fieldset>';
   $('#branches').append(data);
   }
   else{
    alert('Fill The Previous Location Field First');
   }
});
$(document).on('keyup','.retailerlocation',function(){
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
                var count = address.attr('data-count');
               
                $('#locResults_'+count).html('<button class="btn btn-success" onclick="confirmLoc($(this))" data-count="'+count+'" data-lat="'+msg.results[0].geometry.location.lat+'" data-lng="'+msg.results[0].geometry.location.lng+'" data-addr="'+msg.results[0].formatted_address+'">'+msg.results[0].formatted_address+'</button>');

            }else{
                 // $("#retailerlocation").val('');
                 $("#latitude_"+count).val('');
               $("#longitude_"+count).val('');
            }
        }
    });
};
});
</script>
