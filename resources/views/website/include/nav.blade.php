@php
    use Illuminate\Support\Facades\Request;
@endphp

<div class="navigation">
    <div class="grid-container grid-x grid-padding-x nav-wrap">
       <div class="small-6 large-9 medium-9 cell">
          <div class="top-bar float-left">
             <div class="top-bar-title">
                <span data-responsive-toggle="responsive-menu" data-hide-for="large">
                <a data-toggle><span class="menu-icon dark float-left"></span></a>
                </span>
             </div>
             <nav id="responsive-menu">
                <ul class="menu vertical large-horizontal dropdown" data-responsive-menu="accordion medium-dropdown" role="menubar" data-dropdown-menu="4gg5js-dropdown-menu" data-disable-hover="true">
                   <li role="menuitem">
                      <a class="{{ Request::routeIs('home') ? 'nav-border' : '' }}" href="{{route('home')}}">Home</a>
                   </li>
                   <li class="single-sub parent-nav is-dropdown-submenu-parent opens-right" role="menuitem" aria-haspopup="true" aria-expanded="false" aria-label="Pages">
                      <a class="{{ Request::routeIs('aboutus*') ? 'nav-border' : '' }}" href="{{route('aboutus')}}">About Us</a>
                      <ul class="child-nav menu vertical submenu is-dropdown-submenu first-sub" data-submenu aria-hidden="true" role="menu">
                         {{-- <li role="menuitem" class="is-submenu-item is-dropdown-submenu-item"><a class="{{ Request::routeIs('aboutus') ? 'nav-border' : '' }}" href="{{route('aboutus')}}">About Us</a></li> --}}
                         <li role="menuitem" class="is-submenu-item is-dropdown-submenu-item"><a class="{{ Request::routeIs('aimsobjectives') ? 'nav-border' : '' }}" href="{{route('aimsobjectives')}}">Aims & Objectives</a></li>
                         <li role="menuitem" class="is-submenu-item is-dropdown-submenu-item"><a class="{{ Request::routeIs('mission') ? 'nav-border' : '' }}" href="{{route('mission')}}">Mission</a></li>
                         <li role="menuitem" class="is-submenu-item is-dropdown-submenu-item"><a class="{{ Request::routeIs('vision') ? 'nav-border' : '' }}" href="{{route('vision')}}">Vision</a></li>
                         {{-- <li role="menuitem" class="is-submenu-item is-dropdown-submenu-item"><a class="{{ Request::routeIs('testimonial') ? 'nav-border' : '' }}" href="{{route('testimonial')}}">Testimonials</a></li> --}}
                         <li role="menuitem" class="is-submenu-item is-dropdown-submenu-item"><a class="{{ Request::routeIs('faqs') ? 'nav-border' : '' }}" href="{{route('faqs')}}">FAQ's</a></li>
                     </ul>
                   </li>
                   <li class="single-sub parent-nav is-dropdown-submenu-parent opens-right" role="menuitem" aria-haspopup="true" aria-expanded="false" aria-label="Services">
                     <a class="{{ Request::is('drpnbehl') ? 'nav-border' : '' }}" href="{{route('drpnbehl')}}">Dr. P.N. Behl</a>
                  </li>
                   <li class="single-sub parent-nav is-dropdown-submenu-parent opens-right" role="menuitem" aria-haspopup="true" aria-expanded="false" aria-label="Services">
                      <a class="{{ Request::is('serviceP*') ? 'nav-border' : '' }}" href="{{route('serviceP')}}">Services</a>
                      <ul class="child-nav menu vertical submenu is-dropdown-submenu first-sub" data-submenu aria-hidden="true" role="menu">
                         <li role="menuitem" class="is-submenu-item is-dropdown-submenu-item"><a class="{{ Request::routeIs('facilities') ? 'nav-border' : '' }}" href="{{route('facilities')}}">Facilities</a></li>
                         <li role="menuitem" class="is-submenu-item is-dropdown-submenu-item"><a class="{{ Request::routeIs('skin-diseases-treatments') ? 'nav-border' : '' }}" href="{{route('skin-diseases-treatments')}}">Skin Diseases & Treatments</a></li>
                         <li role="menuitem" class="is-submenu-item is-dropdown-submenu-item"><a class="{{ Request::routeIs('treatments-services') ? 'nav-border' : '' }}" href="{{route('treatments-services')}}">Treatments & Services</a></li>
                      </ul>
                   
                     </li>
                   <li role="menuitem" >
                      <a class="{{ Request::routeIs('staff') ? 'nav-border' : '' }}" href="{{route('staff')}}">Our Staff</a>
                      
                   </li>
                   <li class="single-sub parent-nav is-dropdown-submenu-parent opens-right" role="menuitem" aria-haspopup="true" aria-expanded="false" aria-label="Pages">
                     <a class="{{ Request::routeIs('contact*') ? 'nav-border' : '' }}" href="{{route('contact')}}">Contact us</a>
                        <ul class="child-nav menu vertical submenu is-dropdown-submenu first-sub" data-submenu aria-hidden="true" role="menu">
                           <li role="menuitem" class="is-submenu-item is-dropdown-submenu-item">
                              
                              <a class="{{ Request::routeIs('appointment') ? 'nav-border' : '' }}" href="{{route('appointment')}}">Appointment</a>
                           </li>
                        
                        </ul>
                     </li>
                   <li role="menuitem">
                     <a class="{{ Request::is('blog') ? 'nav-border' : '' }}" href="{{route('blog')}}">Blog</a>
                  </li>
                   
                   {{-- <li role="menuitem">
                      <a class="{{ Request::is('contact') ? 'nav-border' : '' }}" href="{{route('contact')}}">Contact</a>
                   </li> --}}
                </ul>
             </nav>
          </div>
       </div>
       <div class="small-6 large-3 medium-3 cell">
          <div class="social-icons">
                @if (Route::has('login'))
                    <div class="">
                       @auth
                           @php
                           
                              $dashboardRoute = match(auth()->user()->role->name) {
                                    'webadmin' => 'webadmin.dashboard',
                                    'doctor' => 'doctor.dashboard',
                                    'super_admin' => 'superadmin.dashboard',
                                    'receptionist' => 'receptionist.dashboard',
                                    'patient' => 'patient.dashboard',
                                    'lab' => 'lab.dashboard',
                                    default => 'home'
                              };
                               //die('Auth User Role: ' . $dashboardRoute);
                           @endphp
                           <a href="{{ route($dashboardRoute) }}"
                              class="{{ Request::routeIs($dashboardRoute) ? 'nav-border' : '' }}">
                              Dashboard
                           </a>
                       @else
                        <a href="{{ route('login') }}" class="button primary" style="min-width: 100px;">Log in </a>
                       @if (Route::has('register'))
                        <a href="{{ route('register') }}" class="button secondary" style="min-width: 100px;">Register</a>
                       @endif
                       @endauth
                    </div>
                @endif
             <div class="clearfix"></div>
          </div>
          <div class="clearfix"></div>
       </div>
    </div>
 </div>
