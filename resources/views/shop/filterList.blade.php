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