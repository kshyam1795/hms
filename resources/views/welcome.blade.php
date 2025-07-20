<!doctype html>
<html lang="en">
   <head>
      <meta charset="utf-8" />
      <meta http-equiv="x-ua-compatible" content="ie=edge">
      <meta name="viewport" content="width=device-width, initial-scale=1.0" />
      <base href="{{ url('/') }}/">
       
      <title>{{ $page->meta_title ?? "Dr Behl's Skin Institute" }}</title>
      <meta name="description" content='{{ $page->meta_description ?? "Dr Behl's Skin Institute" }}'>
      <meta name="keywords" content='{{ $page->meta_keywords ?? "Dr Behl's Skin Institute" }}'>
      <meta name="author" content="App Era Technologies">
       
      <link rel="shortcut icon" type="image/x-icon" href="{{asset('assets/images/favicon.png')}}">
      <meta name="viewport" content="width=device-width, initial-scale=1">
      <link rel="stylesheet" type="text/css" href="{{asset('style.css')}}" media="all" />
      <script>
         document.addEventListener('contextmenu', event => event.stopPropagation(), true);
 
     </script>
     <style>
      .footer-box .links:last-child {
            float: left !important;
      }
     </style>

   <style>
      .call-to-action.dark-bg:after {
         background: url(http://drbehlsisd.com/assets/images/help/doctor-image-1.jpg) repeat fixed center center / cover;
      }
   </style>
   <style>
      .marquee-container {
          width: 100%;
          overflow: hidden;
          white-space: nowrap;
          /* background: #f8f9fa; */
          padding: 10px 0;
          background: #036f9e; /* Light Background */
         border-top: 2px solid #123f56; /* Darker border for contrast */
         border-bottom: 2px solid #123f56;
      }
      
      .marquee-text {
          display: inline-block;
          white-space: nowrap;
          animation: marquee 25s linear infinite;
          font-size: 18px;
          font-weight: bold;
          color: #fff;

      }
      
      @keyframes marquee {
          from {
              transform: translateX(100%);
          }
          to {
              transform: translateX(-100%);
          }
      }
      </style>

<style>
   .modal {
       display: none;
       position: fixed;
       z-index: 1000;
       left: 0;
       top: 0;
       width: 100%;
       height: 100%;
       background-color: rgba(0, 0, 0, 0.5);
       justify-content: center;
       align-items: center;
   }
   .modal-content {
       background: white;
       padding: 20px;
       border-radius: 10px;
       text-align: center;
       position: relative;
   }
   .close-btn {
       position: absolute;
       top: 10px;
       right: 15px;
       font-size: 20px;
       cursor: pointer;
   }
</style>
   </head>
   <body>
      <div class="main-container">
         
         <div class="header" style="padding: 0px 0px !important;">
            
            <div class="grid-container grid-x grid-padding-x">
               <div class="small-12 large-5 medium-3 cell">
                  <div class="logo">
                     <a href="{{ url('/') }}/home">
                     <img src="assets/images/logo.png" alt="Logo" style="max-width: 60% !important;"/>
                     <p style="font-size: 0.8rem; line-height: 5px;padding-left: 15px">To Serve Mankind Is to Serve God. </p>
                     <p style="font-size: 0.8rem; line-height: 5px; padding-left: 15px; display: none;"> A UNIT OF SKIN INSTITUTE & PUBLIC SERVICE CHARITABLE TRUST</p>
                     </a>
                  </div>
               </div>
               <div class="small-12 large-7 medium-9 cell margin-auto">
                  <div class="info-container">
                     <div class="icon-box" style="cursor: pointer">
                        <div class="icon-side">
                           <img src="assets/images/help/icons/tablet.png" alt="icon" />
                        </div>
                        <div class="info-side" >
                           <p style="text-align: center" ><strong onclick="window.location.href='tel:+918448662349';">+91-8448662349</strong> | 
                              <strong onclick="window.location.href='tel:+919355594442';">+91-9355594442</strong><br>                              Book an Appointment
                           </p>
                        </div>
                     </div>
                     <div class="icon-box" style="cursor: pointer">
                        <div class="icon-side">
                           <img src="assets/images/help/icons/pointer.png" alt="icon" />
                        </div>
                        <div class="info-side" >
                           <p onclick='window.open("https://www.google.com/maps/place/Dr.+P.+N.+Behl+Skin+Institute/@28.557721,77.235984,4904m/data=!3m1!1e3!4m6!3m5!1s0x390ce24a15125657:0x4a7d8d6acb878735!8m2!3d28.5577213!4d77.2359835!16s%2Fg%2F11f_bz6ll8?hl=en&entry=ttu&g_ep=EgoyMDI0MTIxMS4wIKXMDSoASAFQAw%3D%3D", "_blank");'>
                              <strong>Skin Institute and School of Dermatology,</strong><br>
                              Block B, Zamrudpur, Greater Kailash, New Delhi, 110048
                            </p>
                        </div>
                     </div>
                     
                  </div>
               </div>
            </div>
         </div>
         @include('website.include.nav')
         <div class="marquee-container">
            <div class="marquee-text">
                SKIN INSTITUTE & SCHOOL OF DERMATOLOGY, Founded by Late (Prof.) DR. P.N. BEHL since 1965.
            </div>
         </div>
         
         @yield('web-content')
         
         

        
         
         <div class="footer">
            <div class="call-to-action dark-bg grey-bg">
               <div class="grid-container grid-x grid-padding-x">
                  <div class="large-12 medium-12 small-12 cell">
                     <div class="call-to-action-text">
                        <img src="assets/images/help/icons/ribbon.png" alt="Ribbon" />
                        
                        <h2 style="text-align: center;">‘’DERMATOLOGY TO COSMETOLOGY,<br> WE KNOW SKIN BETTER’’</h2>
                        {{-- <p>Crown quis lectus et mauris commodo blandit. Morbi rutrum libero eget nibh facilisis sollicitudin.</p> --}}
                        <a class="button button-second secondary" href="{{route('appointment')}}">fix an appointment</a>
                     </div>
                  </div>
               </div>
            </div>
            <div class="footer-top grey-bg">
               <div class="grid-container grid-x grid-padding-x">
                  <div class="large-6 medium-6 small-12 cell">
                     <div class="footer-box footer-logo-side">
                        <a href="#"><img src="assets/images/logo-footer.png" width="50%" alt /></a>
                        <p style="font-size: 0.8rem; line-height: 1px; padding-left: 15px;  display: none;"> A UNIT OF SKIN INSTITUTE & PUBLIC SERVICE CHARITABLE TRUST</p>
                        <p>The Skin Institute has been serving since March 1, 1965, in New Delhi. We have served our best services from the Famous Names to the Common Man, from Cities to Villages. We are delighted to say ‘’DERMATOLOGY TO COSMETOLOGY, WE KNOW SKIN BETTER’’</p>
                        <div class="contact-us">
                           <ul>
                              <li><i class="fas fa-map-marker-alt"></i><a href="https://maps.app.goo.gl/w51ucYrz3RpiHDxS7" target="_blank"><span>Address:</span> Dr Behl's Skin Institute, Zamrudpur, N-Block, Greater Kailash-1, Opp. Lady Shri Ram College, New Delhi-110048</a></li>
                              <li><i class="fas fa-mobile-alt"></i><a ><span>Phone:</span> <b onclick="window.location.href='tel:+918448662349';"> +91-8448662349</b>, <b onclick="window.location.href='tel:+919355594442';"> 9355594442 </b></a></li>
                              <li><i class="fas fa-envelope"></i><a href="mailto:info@drbehlsisd.com"><span>Email:</span> info@drbehlsisd.com</a></li>
                           </ul>
                        </div>
                        <div class="social-icons">
                           <ul class="menu">
                              <li><a href="#"><i class="fab fa-facebook-f"></i></a></li>
                              <li><a href="#"><i class="fab fa-twitter"></i></a></li>
                              <li><a href="#"><i class="fab fa-instagram"></i></a></li>
                              <li><a href="#"><i class="fab fa-youtube"></i></a></li>
                              <li><a href="#"><i class="fab fa-google-plus-g"></i></a></li>
                           </ul>
                        </div>
                     </div>
                  </div>
                  <div class="large-6 medium-6 small-12 cell">
                     <div class="footer-box border-btm">
                        <h6>About Our Clinic</h6>
                        <ul class="links">
                           <li><a href="{{route('aboutus')}}">About Us</a></li>
                           <li><a href="{{route('serviceP')}}">Our Services</a></li>
                           {{-- <li><a href="{{route('')}}"> Why Chose Us?</a></li> --}}
                           {{-- <li><a href="{{route('')}}">Our Location</a></li> --}}
                           <li><a href="{{route('staff')}}">Staff & Doctors</a></li>
                           {{-- <li><a href="{{route('')}}">Our Mission</a></li> --}}
                           <li><a href="{{route('faqs')}}">Frequent Questions</a></li>
                           <li><a href="{{route('contact')}}">Contact Us</a></li>
                        </ul>
                        {{-- <ul class="links">
                           <li><a href="#">Cosmetic </a></li>
                           <li><a href="#">Cosmetic Surgery</a></li>
                           <li><a href="#">Hair Transplant</a></li>
                           <li><a href="#">Clinical Dermatology</a></li>
                           <li><a href="#">Medical Dermatology</a></li>
                           <li><a href="#">Skin Care Products</a></li>
                        </ul> --}}
                     </div>
                  </div>
                  <div class="large-4 medium-4 small-12 cell " style="display: none;">
                     <div class="footer-box border-btm">
                        <h6>Recent News</h6>
                        <div class="footer-news-post">
                           <div class="footer-news">
                              <img src="assets/images/help/footer-icon-1.jpg" alt="News" />
                              <h2><a href="#">How can we help you get the amazing skin results from us?</a></h2>
                              <p>09 July 2024</p>
                           </div>
                           <div class="footer-news">
                              <img src="assets/images/help/footer-icon-2.jpg" alt="News" />
                              <h2><a href="#">How can you keep your skin glowing and infection less in sprint</a></h2>
                              <p>10 July 2024</p>
                           </div>
                        </div>
                     </div>
                  </div>
               </div>
            </div>
            <div class="footer-bottom" style="background: #123f56">
               <div class="grid-container grid-x grid-padding-x">
                  <div class="medium-6 large-6 small-12 cell">
                     <div class="copyrightinfo">© Copyright 2024 All rights reserved. Powered by <a href="https://www.apperatechnologies.com/" target="_blank">App Era Technologies</a></div>
                  </div>
                  <div class="medium-6 large-6 small-12 cell">
                     <div class="footer-bottom-nav">
                        <ul class="menu">
                           <li><a href="{{route('home')}}">Home</a></li>
                           <li><a href="{{route('aboutus')}}">About Us</a></li>
                           <li><a href="{{route('contact')}}">Contact Us</a></li>
                           <li><a href="{{route('privacy')}}">Privacy Policy</a></li>
                           <li><a href="{{route('term')}}">Terms & Conditions</a></li>
                        </ul>
                     </div>
                  </div>
               </div>
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
      
      <style>
         /* Modal styles */
         .modal {
             display: none; /* Initially hidden */
             position: fixed;
             z-index: 1000;
             left: 0;
             top: 0;
             width: 100%;
             height: 100%;
             background-color: rgba(0, 0, 0, 0.5);
             display: flex;
             justify-content: center;
             align-items: center;
         }
         .modal-content {
             background: white;
             padding: 20px;
             border-radius: 10px;
             text-align: center;
             position: relative;
             width: 90%;
             max-width: 400px;
             box-shadow: 0px 4px 10px rgba(0, 0, 0, 0.3);
         }
         .close-btn {
             position: absolute;
             top: 10px;
             right: 15px;
             font-size: 20px;
             cursor: pointer;
             color: #555;
         }
         h2 {
             color: #333;
         }
         p {
             color: #666;
             font-size: 16px;
         }
         .qr-code img {
             width: 150px;
             height: 150px;
             margin: 10px 0;
         }
         .review-btn {
             display: inline-block;
             background-color: #ff9800;
             color: white;
             padding: 10px 15px;
             border-radius: 5px;
             text-decoration: none;
             font-weight: bold;
             margin-top: 10px;
         }
         .review-btn:hover {
             background-color: #e68900;
         }
     </style>
     <!-- Review Popup Modal -->
   <div id="reviewModal" class="modal">
      <div class="modal-content">
         <span class="close-btn">&times;</span>
         <h2>We Value Your Feedback! ⭐</h2>
         <p>Please take a moment to leave us a review on Google.</p>
         <img src="assets/images/logo.png" alt="Logo" style="max-width: 60% !important;"/>
         <div class="qr-code">
            <img src="assets/images/qr_683ea369eaa4d.png" alt="Google Review QR Code">
         </div>
         <p onclick='window.open("https://maps.app.goo.gl/Req4pxjkFPz9uDz9A?g_st=ic", "_blank");' style="cursor: pointer; color: #036f9e; font-weight: bold;">
            <strong>Skin Institute and School of Dermatology,</strong>
          </p>
         <a href="https://g.page/r/CTWHh8tqjX1KEBM/review" target="_blank" class="review-btn">Leave a Review</a>
      </div>
   </div>

   <script>
      document.addEventListener("DOMContentLoaded", function () {
         // Show the modal after 3 seconds (adjust timing if needed)
         // setTimeout(function () {
         //    document.getElementById("reviewModal").style.display = "flex";
         // }, 3000);

         // Close modal when clicking the close button
         document.querySelector(".close-btn").addEventListener("click", function () {
            document.getElementById("reviewModal").style.display = "none";
         });

         // Close modal when clicking outside the modal content
         window.onclick = function(event) {
            let modal = document.getElementById("reviewModal");
            if (event.target === modal) {
                  modal.style.display = "none";
            }
         };
      });
   </script>
   </body>
</html>
