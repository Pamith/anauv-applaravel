@extends('layouts.app')
@section('content')
<div class="col-md-12" align="center" style="">
	<div class="col-md-4">
		<div id="catFilter">
			<label class="alaert alert-warning">Category</label></br>
			@foreach($category as $cat)
			<input type="checkbox" class="cat-filter" name="" id="{{$cat->id}}" value="">
			<span>{{$cat->name}}</span></br>
	    	@endforeach
		</div>
		<div>
			<label class="alaert alert-warning">Kilometres From You</label></br>			
			<input type="number" name="checkboxes" id="km" min="1">			
		</div>
		<div>
			<label class="alaert alert-warning">Valid Upto</label></br>			
			<input type="text" name="checkboxes" id="valid-date" min="1">			
		</div>
		<div>
			<label class="alaert alert-warning">Request a Offer</label></br>
			<button id="req-offer" class="btn btn-warning">Request Now</button>	
		</div>
	</div>
	<div class="col-md-8">
            <div id="listOffers">     
                @if($offers)
                  @foreach($offers as $offer)
                   <div class="col-md-4" style="">
                    <!--Card-->
                        <div class="card">
                            <!--Card image-->
                            <div class="view overlay hm-white-slight">
                                <!-- <img src="https://mdbootstrap.com/img/Photos/Others/food.jpg" class="img-fluid" alt=""> -->
                                <h3>{{ $offer->short_desc}}</h3>
                                <a>
                                    <div class="mask"></div>
                                </a>
                                <hr>
                            </div>
                            <!--/.Card image-->

                            <!--Button-->
                            <a class="btn-floating btn-action"><i class="fa fa-chevron-right"></i></a>

                            <!--Card content-->
                            <div class="card-body">
                                <!--Title-->
                                <h4 class="card-title">{{$offer->ShopName}}</h4>
                                <hr>
                                <!--Text-->
                                <p class="card-text">{{ $offer->offer_desc}}</p>
                                <span>Address:</span><p>{{ $offer->address }}</p>
                            </div>
                            <!--/.Card content-->

                            <!-- Card footer -->
                            <div class="card-data">
                                <ul>
                                    <!-- <li><i class="fa fa-clock-o"><span>Start Date:</span></i>{{$offer->offer_start}}</li> -->
                                    <li><i class="fa fa-clock-o"></i><span>Valid Till </span>{{ date("F d, Y",strtotime($offer->offer_end))}}</li>
                                    <li><button onclick="sendCoupon($(this))" data-id="{{ $offer->id }}">GET COUPON</button></li>
                                </ul>
                            </div>
                            <!-- Card footer -->

                        </div>
                        <!--/.Card-->
                     <!-- {{ $offer->ShopName}}
                     {{ $offer->offer}} -->
                   </div>
                  @endforeach
                @endif
            </div>
        </div>          		
	</div>
            <div class="modal fade" id="locationModal" tabindex="-1" role="dialog" aria-labelledby="locationModalLabel" aria-hidden="true">
              <div class="modal-dialog" role="document">
                <div class="modal-content">
                  <div class="modal-header">
                    <h5 class="modal-title" id="locationModalLabel">Add Your Location</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                      <span aria-hidden="true">&times;</span>
                    </button>
                  </div>
                  <div class="modal-body">
                    <input type="text" name="" id="searchLoc"><button id="useThis">Use My Current Location</button><button id="listAll" onclick="setCookie('lat','',1);setCookie('lng','',1);window.location.reload(true); ">List All</button>
                    <div id="locResults">
                        
                    </div>
                  </div>
                  <div class="modal-footer">
                    <button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>
                  </div>
                </div>
              </div>
            </div>
            <script src="{{ asset('js/shopFilter.js') }}"></script>
            <script src="{{ asset('js/requestOffer.js') }}"></script>
@endsection