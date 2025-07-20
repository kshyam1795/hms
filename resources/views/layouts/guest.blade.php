<!Doctype html >
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
   <head>
      <meta charset="utf-8" />
      <meta http-equiv="x-ua-compatible" content="ie=edge">
      <meta name="viewport" content="width=device-width, initial-scale=1.0" />
      <meta name="viewport" content="width=device-width, initial-scale=1">
      <meta name="csrf-token" content="{{ csrf_token() }}">
      <title>{{ config('app.name', 'Laravel') }}</title>
      {{-- <title>Dr Behl's Skin Hospital</title> --}}
      <meta name="author" content="App Era Creations">
      <meta name="keywords" content>
      <meta name="description" content>
      <link rel="shortcut icon" type="image/x-icon" href="{{ asset('assets/images/favicon.png')}}">
      <meta name="viewport" content="width=device-width, initial-scale=1">
      <link rel="stylesheet" type="text/css" href="{{ asset('style.css')}}" media="all" />
        <style>
            
            .dropdown.menu.medium-horizontal>li.is-dropdown-submenu-parent>a, .dropdown.menu li a {
                padding: 10px 8px;
                text-transform: capitalize;
                font-size: 0.9375rem;
                position: relative;
                color: #444444;
                letter-spacing: 0.01em;
            }
            .navigation, .top-bar ul {
                background-color: #f8f8f800;
            }
        </style>
        <!-- Scripts -->
        @vite(['resources/css/app.css', 'resources/js/app.js'])
   
    </head>
   <body>
      <div class="main-container" style="background-image:url('assets/images/bg.jpg');background-repeat: no-repeat; background-size: cover;">
         
         <div class="grid-container grid-x grid-padding-x nav-wrap" style="max-width: 80rem;">
            <div class="large-6" style="padding: 2% 2%">
                <img src="{{asset('assets/images/drbehl.jpg')}}" alt="" style="width: 70%; height:auto">
            </div>
            <div class="large-1" >
            </div>
            <div class="large-5" style="padding: 2% 2%;background: aliceblue;
}">
                <div class="logo">
                    <a href="#">
                    <img src="{{ asset('assets/images/logo.png')}}" alt="Logo" />
                    </a>
                 </div>
                <h1 style="text-align: center; font-size:20px">Sign in</h1>
                <h4 style="text-align: center; font-size:16px">
                    Welcome back! Please enter your details.
                </h4>
                {{ $slot }}
            </div>
         </div>
            
       
         
        
      </div>
      <a href="#" id="top" title="Go to Top">
      <i class="fas fa-arrow-alt-circle-up"></i>
      </a>
      <div class="preloader">
         <div class="spinner">
            <div class="double-bounce1"></div>
            <div class="double-bounce2"></div>
         </div>
      </div>
      <script data-cfasync="false" src="{{asset('assets/scripts/5c5dd728/cloudflare-static/email-decode.min.js')}}"></script>
      <script src="{{asset('assets/js/jquery.js')}}" type="f5864439b0c4766d15b56580-text/javascript"></script>
      <script src="{{asset('assets/js/foundation.min.js')}}" type="f5864439b0c4766d15b56580-text/javascript"></script>
      <script src="{{asset('assets/js/owl.carousel.min.js')}}" type="f5864439b0c4766d15b56580-text/javascript"></script>
      <script src="{{asset('assets/js/jquery.event.move.js')}}" type="f5864439b0c4766d15b56580-text/javascript"></script>
      <script src="{{asset('assets/js/jquery.twentytwenty.js')}}" type="f5864439b0c4766d15b56580-text/javascript"></script>
      <script src="{{asset('assets/js/template.js')}}" type="f5864439b0c4766d15b56580-text/javascript"></script>
      <script src="{{asset('assets/scripts/7d0fa10a/cloudflare-static/rocket-loader.min.js')}}" data-cf-settings="f5864439b0c4766d15b56580-|49" defer></script>
   </body>
</html>
