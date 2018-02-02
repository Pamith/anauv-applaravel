<!doctype html>
<html lang="{{ app()->getLocale() }}">
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="csrf-token" content="{{ csrf_token() }}">
        <title>Laravel</title>
        <script src="https://www.gstatic.com/firebasejs/4.8.1/firebase.js"></script>
        <script>
          // Initialize Firebase
          var config = {
            apiKey: "AIzaSyD20sabsU3vuU3uksTPa1rqilCWkSbTNFU",
            authDomain: "laravel-app-c039a.firebaseapp.com",
            databaseURL: "https://laravel-app-c039a.firebaseio.com",
            projectId: "laravel-app-c039a",
            storageBucket: "laravel-app-c039a.appspot.com",
            messagingSenderId: "371196088258"
            
          };
          firebase.initializeApp(config);
        </script>
    

    
    <script src="https://cdn.firebase.com/libs/firebaseui/2.3.0/firebaseui.js"></script>
    <script src='https://cdn.firebase.com/js/client/2.2.1/firebase.js'></script>
    <link type="text/css" rel="stylesheet" href="https://cdn.firebase.com/libs/firebaseui/2.3.0/firebaseui.css" />
        <!-- Fonts -->
        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0-beta.3/css/bootstrap.min.css">
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
        <link href="https://fonts.googleapis.com/css?family=Raleway:100,600" rel="stylesheet" type="text/css">
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.3/jquery.min.js"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js"></script>
        <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js"></script>
        <link href="{{ url('css/app.css') }}" rel="stylesheet">
        <!-- Styles -->
        <style>
            html, body {
                background-color: #fff;
                font-family: 'Raleway', sans-serif;
                height: 100vh;
                margin: 0;
            }

            .full-height {
                height: 100vh;
            }

            .flex-center {
                align-items: center;
                display: flex;
            }

            .position-ref {
                position: relative;
            }

            .top-right {
                position: absolute;
                right: 10px;
                top: 18px;
            }
            .top-left {
                position: absolute;
                left: 10px;
            }


            .title {
                font-size: 84px;
            }

            .links > a {
                color: #636b6f;
                padding: 0 25px;
                font-size: 12px;
                font-weight: 600;
                letter-spacing: .1rem;
                text-decoration: none;
                text-transform: uppercase;
            }

            .m-b-md {
                margin-bottom: 30px;
            }
        </style>
    </head>
    <body>
        <nav class="navbar navbar-default navbar-static-top">
            @if (Route::has('login'))
                <div class="top-left links">
                
                        <a href="{{ url('/') }}"><h2>{{ config('app.name') }}</h2></a>
                </div>
                <div class="top-right links">
                    
                    @auth
                         @if(Auth::user()->role == 'retailer')
                                        <a href="{{ route('RetailerDashboard') }}">Dashboard</a>
                                        <a href="{{ route('UserDashboard') }}">Manage Shops</a>
                                    @else
                                        <a href="{{ route('shop') }}">Shop</a>
                                        <a onclick="$('#locationModal').modal('show');">Change Location</a>
                                        <a href="{{ route('UserDashboard') }}">My Profile</a>
                                    @endif
                        <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false" aria-haspopup="true">
                                    {{ Auth::user()->name }} <span class="caret"></span>
                                </a>

                                <ul class="dropdown-menu">
                                   
                                   
                                    <li>
                                        <a href="{{ route('logout') }}"
                                            onclick="event.preventDefault();
                                                     document.getElementById('logout-form').submit();">
                                            Logout
                                        </a>

                                        <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                                            {{ csrf_field() }}
                                        </form>
                                    </li>
                                </ul>
                    @else
                    <a href="{{ route('shop') }}">Shop</a>
                    <a onclick="$('#locationModal').modal('show');">Change Location</a>
                    <a href="{{ route('login') }}">Login</a>
                    <a href="{{ route('register') }}">Register</a>
                    <a href="{{ route('addRetailer') }}">Add Your Business</a>                  
                        
                    @endauth
                </div>
            @endif
        </nav>
        <category-nav>
            <div class="category-nav col-md-12">
                <div class="category-nav category-nav--menu">
                    @foreach($category as $category)
                    <div class="col-md-4">
                        <a href="{{ url('shop/category/' . $category->id . '/') }}">
                            <div class="alert alert-success">
                              
                                {{$category->name}}
                                
                            </div>
                            
                        </a>
                    </div>
                    @endforeach
                    
                      
                      
                </div>
                
            </div>
        </category-nav>
        <div class="" align="center" style="">
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

            <div class="footer-copyright">
                <div class="container-fluid">
                    © 2018 Copyright: <a href="#"> ANAUV </a>

                </div>
            </div>
        <script src="{{ asset('js/app.js') }}"></script>
        <script src="{{ asset('js/getAppLocation.js') }}"></script>   
        <script src="{{ asset('js/coupon.js') }}"></script>
    </body>
</html>
