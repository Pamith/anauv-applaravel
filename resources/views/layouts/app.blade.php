<!DOCTYPE html>
<html lang="{{ app()->getLocale() }}">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name') }}</title>

    <!-- Styles -->
    <!-- <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0-beta.3/css/bootstrap.min.css"> -->
    <link href="{{ url('css/app.css') }}" rel="stylesheet">
    <link rel="stylesheet" href="//code.jquery.com/ui/1.12.1/themes/base/jquery-ui.css">
  
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
    <link type="text/css" rel="stylesheet" href="https://www.gstatic.com/firebasejs/ui/2.5.1/firebase-ui-auth.css" />
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.3/jquery.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js"></script>
    
     
</head>
<body>
    <div id="app">
        <nav class="navbar navbar-default navbar-static-top">
            <div class="container">
                <div class="navbar-header">

                    <!-- Collapsed Hamburger -->
                    <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#app-navbar-collapse" aria-expanded="false">
                        <span class="sr-only">Toggle Navigation</span>
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span>
                    </button>

                    <!-- Branding Image -->
                    <a class="navbar-brand" href="{{ url('/') }}">
                        {{ config('app.name') }}
                    </a>
                </div>

                <div class="collapse navbar-collapse" id="app-navbar-collapse">
                    <!-- Left Side Of Navbar -->
                    <ul class="nav navbar-nav">
                        &nbsp;
                    </ul>

                    <!-- Right Side Of Navbar -->
                    <ul class="nav navbar-nav navbar-right">
                        <!-- Authentication Links -->
                            <li><a href="{{ route('shop') }}">Shop</a></li>
                             @if(!Request::is('login') AND !Request::is('register'))
                               <li><a onclick="$('#locationModal').modal('show');">Change Location</a></li>
                            @endif
                        @guest
                            <li><a href="{{ route('login') }}">Login</a></li>
                            <li><a href="{{ route('register') }}">Register</a></li>
                             
                        @else
                             
                            <li class="dropdown">
                                <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false" aria-haspopup="true">
                                    {{ Auth::user()->name }} <span class="caret"></span>
                                </a>

                                <ul class="dropdown-menu">
                                    @if(Auth::user()->role == 'retailer')
                                    <li>
                                        <a href="{{ route('RetailerDashboard') }}">Dashboard</a>
                                    </li>
                                    <li>
                                        <a href="{{ route('AddOffer') }}">Add Offer</a>
                                    </li>
                                    @else
                                    <li>
                                        <a href="{{ route('UserDashboard') }}">My Profile</a>
                                    </li>
                                    @endif
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
                            </li>
                            
                        @endguest
                    </ul>
                </div>
            </div>
        </nav>
        @yield('navbar')
        @yield('content')
    </div>
    <div class="footer-copyright">
        <div class="container-fluid">
                    © 2018 Copyright: <a href="#"> ANAUV </a>
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
    <!-- Scripts -->
    <script src="{{ asset('js/app.js') }}"></script>
     
     
    <script src="{{ asset('js/getLocation.js') }}"></script>
    <script src="{{ asset('js/CategoryManagement.js') }}"></script>
    <script src="{{ asset('js/getAppLocation.js') }}"></script>   
    <script src="{{ asset('js/coupon.js') }}"></script>
    
    <script type="text/javascript">
        // window.recaptchaVerifier = new firebase.auth.RecaptchaVerifier('firebaseui-container', {
        //   'size': 'invisible',
        //   'callback': function(response) {
        //     // reCAPTCHA solved, allow signInWithPhoneNumber.
        //     onSignInSubmit();
        //   }
        // });
        // function onSignInSubmit(){}
        // var phoneNumber = '+919750755249';
        // var appVerifier = window.recaptchaVerifier;
        // firebase.auth().signInWithPhoneNumber(phoneNumber, appVerifier)
        //     .then(function (confirmationResult) {
        //       // SMS sent. Prompt user to type the code from the message, then sign the
        //       // user in with confirmationResult.confirm(code).
        //       window.confirmationResult = confirmationResult;
        //     }).catch(function (error) {
        //       // Error; SMS not sent
        //       // ...
        //     });
    </script>
    <script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"></script>
</body>
</html>
