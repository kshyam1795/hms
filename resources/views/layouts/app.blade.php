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
      <link rel="dns-prefetch" href="//fonts.gstatic.com">
      <link href="https://fonts.googleapis.com/css?family=Nunito" rel="stylesheet">
      <!-- Bootstrap CSS -->
      <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
      <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.9.0/css/bootstrap-datepicker.min.css">

      <link rel="stylesheet" type="text/css" href="{{ asset('material_icons.css')}}" media="all" />
      <link rel="stylesheet" type="text/css" href="{{ asset('dstyle.css')}}" media="all" />
      <!-- Toastr CSS -->
      <link href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.css" rel="stylesheet" />


      <link rel="stylesheet" type="text/css" href="{{ asset('style.css')}}" media="all" />
        <!-- Custom CSS -->
    <script>
        document.addEventListener('contextmenu', event => event.stopPropagation(), true);

    </script>
    <style>
        .growats-btn-color{
            color: #000 !important;
        }
      .table {
          border-collapse: collapse;
          width: 100%;
      }
      .table th, .table td {
          border: 1px solid #ddd;
          padding: 8px;
      }
      .table th {
          background-color: #f2f2f2;
          text-align: center;
      }
      .table tr:hover {
          background-color: #f1f1f1;
      }
  
            .dropdown.menu.medium-horizontal>li.is-dropdown-submenu-parent>a, .dropdown.menu li a {
                padding: 10px 8px;
                text-transform: capitalize;
                font-size: 0.9375rem;
                position: relative;
                color: #ffffff;
                letter-spacing: 0.01em;
            }
            .navigation, .top-bar ul {
                background-color: #f8f8f800;
            }
            .dropdown.menu.medium-horizontal>li.is-dropdown-submenu-parent>a:hover, .dropdown.menu li a:hover {
                color: #a4e0ff;
            }
            .nav-tabs .nav-item.show .nav-link{
                color:white !important;
            }
            
            /* Additional dropdown styles to ensure proper display */
            .dropdown-menu {
                display: none;
                z-index: 1000;
                min-width: 10rem;
                padding: 0.5rem 0;
                margin: 0.125rem 0 0;
                font-size: 1rem;
                color: #212529;
                text-align: left;
                list-style: none;
                background-color: #fff;
                background-clip: padding-box;
                border: 1px solid rgba(0,0,0,.15);
                border-radius: 0.25rem;
            }
            
            .dropdown-menu.show {
                display: block;
            }
            
            .dropdown-menu li {
                display: block;
                width: 100%;
            }
            
            .dropdown-menu li a {
                display: block;
                width: 100%;
                padding: 0.25rem 1.5rem;
                clear: both;
                font-weight: 400;
                color: #212529;
                text-align: inherit;
                white-space: nowrap;
                background-color: transparent;
                border: 0;
            }
            
            .dropdown-menu li a:hover, .dropdown-menu li a:focus {
                color: #16181b;
                text-decoration: none;
                background-color: #f8f9fa;
            }
        </style>
   
    </head>
   <body>
      <div class="main-container">
         <div class="navigation" style="background-color: #123f56;position:fixed;">
            <div class="grid-container grid-x grid-padding-x nav-wrap" style="max-width: 100rem;align-items: anchor-center;">
                <div class="small-12 large-2 medium-2 cell">
                    <div class="logo">
                       <a href="#">
                        <img src="{{ asset('assets/images/logo.png')}}" alt="Logo" style="background-color:#fff;"/>
                        
                    </a>
                    </div>
                 </div>
               <div class="small-6 large-10 medium-10 cell">
                  <div class="top-bar float-left" >
                     <div class="top-bar-title">
                        <span data-responsive-toggle="responsive-menu" data-hide-for="large">
                        <a data-toggle><span class="menu-icon dark float-left"></span></a>
                        </span>
                     </div>
                     {{-- role wise menu should be decieded --}}
                     @include('layouts.navigation')
                     
                  </div>
               </div>
               
               
            </div>
         </div>
         <main>
            @yield('content')
        </main>
         
        
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
      <!-- jQuery and Bootstrap Bundle (includes Popper) -->
      <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
      
      <script data-cfasync="false" src="{{asset('assets/scripts/5c5dd728/cloudflare-static/email-decode.min.js')}}"></script>
      <script src="{{asset('assets/js/foundation.min.js')}}" type="f5864439b0c4766d15b56580-text/javascript"></script>
      <script src="{{asset('assets/js/owl.carousel.min.js')}}" type="f5864439b0c4766d15b56580-text/javascript"></script>
      <script src="{{asset('assets/js/jquery.event.move.js')}}" type="f5864439b0c4766d15b56580-text/javascript"></script>
      <script src="{{asset('assets/js/jquery.twentytwenty.js')}}" type="f5864439b0c4766d15b56580-text/javascript"></script>
      <script src="{{asset('assets/js/template.js')}}" type="f5864439b0c4766d15b56580-text/javascript"></script>
      <script src="{{asset('assets/scripts/7d0fa10a/cloudflare-static/rocket-loader.min.js')}}" data-cf-settings="f5864439b0c4766d15b56580-|49" defer></script>
      <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.2/dist/umd/popper.min.js"></script>
      <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
      <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.9.0/js/bootstrap-datepicker.min.js"></script>
      <!-- Toastr JS -->
      <script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.js"></script>

      <script>
        // Set global Toastr options (optional)
        toastr.options = {
            "closeButton": true, // Add close button on the toast
            "debug": false,
            "positionClass": "toast-top-right", // Toast position
            "onclick": null,
            "showDuration": "300", // Toast show duration
            "hideDuration": "1000", // Toast hide duration
            "timeOut": "3000", // Duration for the toast before it disappears
            "extendedTimeOut": "1000", // Duration to extend the toast visibility when hovered
            "showEasing": "swing", // Animation easing for showing the toast
            "hideEasing": "linear", // Animation easing for hiding the toast
            "showMethod": "fadeIn", // Toast show animation
            "hideMethod": "fadeOut" // Toast hide animation
        };

      </script>
      
      <!-- Initialize Bootstrap Dropdowns -->
      <script>
        $(document).ready(function() {
            // Custom dropdown toggle implementation
            $(document).on('click', '.info-dropdown-btn', function(e) {
                e.preventDefault();
                e.stopPropagation();
                
                // Find the dropdown menu associated with this button
                var $dropdownMenu = $(this).siblings('.dropdown-menu');
                
                // Toggle the dropdown menu visibility
                if ($dropdownMenu.is(':visible')) {
                    $dropdownMenu.hide();
                } else {
                    // Hide all other dropdown menus first
                    $('.dropdown-menu').hide();
                    // Show this dropdown menu
                    $dropdownMenu.show();
                }
            });
            
            // Close dropdown when clicking outside
            $(document).on('click', function(e) {
                if (!$(e.target).closest('.dropdown').length) {
                    $('.dropdown-menu').hide();
                }
            });
        });
      </script>

    
      
      @yield('scripts')
   </body>
</html>
