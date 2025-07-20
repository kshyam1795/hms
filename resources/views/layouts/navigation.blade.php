<nav id="responsive-menu" >
    
    <ul class="menu vertical large-horizontal dropdown" data-responsive-menu="accordion medium-dropdown" role="menubar" data-dropdown-menu="4gg5js-dropdown-menu" data-disable-hover="true">
        @auth
        @if (Auth::user()->hasRole('super_admin'))
            <li role="menuitem">
                <a class="nav-border" href="{{ route('superadmin.dashboard') }}">Dashboard</a>
            </li>
            <li role="menuitem">
                <a href="{{ route('superadmin.receptionists.index') }}">Receptionists</a>
            </li>
            
            <li role="menuitem">
                <a href="{{ route('doctors.index') }}">Doctors</a>
            </li>

            <li role="menuitem">
                <a href="{{ route('patients.index') }}">Patients</a>
            </li>
            <li role="menuitem">
                <a href="{{ route('appointments.index') }}">Appointments</a>
            </li>
            <li role="menuitem">
                <a href="{{ route('medical-records.index') }}">Medical Records</a>
            </li>
            <li role="menuitem">
                <a href="{{ route('notifications.index') }}">Notifications</a>
            </li>
            <li role="menuitem">
                <a href="{{ route('reports.index') }}">Reports</a>
            </li>

        

        @elseif (Auth::user()->hasRole('receptionist'))
            
            <li class="single-sub parent-nav is-dropdown-submenu-parent opens-right" role="menuitem" aria-haspopup="true" aria-expanded="false" aria-label="Courses">
                <a href="{{url('/dashboard')}}">Dashboard</a>
                
            </li>
            <li class="single-sub parent-nav is-dropdown-submenu-parent opens-right" role="menuitem" aria-haspopup="true" aria-expanded="false" aria-label="Home Page">
                <a class="nav-border" href="#" tabindex="0">All Bills</a>
                <ul class="child-nav menu vertical submenu is-dropdown-submenu first-sub" data-submenu aria-hidden="true" role="menu" style="background-color: #123f56">
                    <li role="menuitem" class="is-submenu-item is-dropdown-submenu-item"><a href="{{route('rece.reports.index')}}">Reports</a></li>
                    <li role="menuitem" class="is-submenu-item is-dropdown-submenu-item"><a href="{{route('reports.payment-methods')}}">Payments Report</a></li>
                </ul>
            </li>
            <li class="single-sub parent-nav is-dropdown-submenu-parent opens-right" role="menuitem" aria-haspopup="true" aria-expanded="false" aria-label=" Pages ">
                <a href="{{route('services.index')}}"> Add Services </a>
                
            </li>
            {{-- <li class="single-sub parent-nav is-dropdown-submenu-parent opens-right" role="menuitem" aria-haspopup="true" aria-expanded="false" aria-label="Courses">
                <a href="#">Patients Q</a>
                
            </li> --}}
            {{-- <li class="single-sub parent-nav is-dropdown-submenu-parent opens-right" role="menuitem" aria-haspopup="true" aria-expanded="false" aria-label=" Staff">
                <a href="#"> Online Consultation</a>
                
            </li> --}}
            <li role="menuitem">
                <a href="#" data-toggle="modal" data-target="#addPatient" >Add patients</a>
            </li>
         
        @elseif (Auth::user()->hasRole('doctor'))  
            <li class="single-sub parent-nav is-dropdown-submenu-parent opens-right" role="menuitem" aria-haspopup="true" aria-expanded="false" aria-label="Home Page">
                <a class="nav-border" href="{{url('/dashboard')}}" tabindex="0">My Appointments</a>
                
            </li>
            <li class="single-sub parent-nav is-dropdown-submenu-parent opens-right" role="menuitem" aria-haspopup="true" aria-expanded="false" aria-label=" Pages ">
                <a href="{{ route('doctor.report', ['doctorId' => auth()->user()->doctor->id]) }}">Reports</a>
                
            </li>
            {{--
            <li class="single-sub parent-nav is-dropdown-submenu-parent opens-right" role="menuitem" aria-haspopup="true" aria-expanded="false" aria-label="Courses">
                <a href="ser#">Tele Consults</a>
                
            </li>
            <li class="single-sub parent-nav is-dropdown-submenu-parent opens-right" role="menuitem" aria-haspopup="true" aria-expanded="false" aria-label=" Staff">
                <a href="#" > + Patient</a>
                
            </li> --}}
            

         

        @elseif (Auth::user()->hasRole('patient')) 
            <li class="single-sub parent-nav is-dropdown-submenu-parent opens-right" role="menuitem" aria-haspopup="true" aria-expanded="false" aria-label="Home Page">
                <a class="nav-border" href="#" tabindex="0">My Appointment Details</a>
                
            </li>
            
            
         

        @elseif (Auth::user()->hasRole('webadmin'))

        <li class="single-sub parent-nav is-dropdown-submenu-parent opens-right" role="menuitem" aria-haspopup="true" aria-expanded="false" aria-label="Courses"><a href="{{ route('webadmin.dashboard') }}" >Dashboard</a></li>
        <li class="single-sub parent-nav is-dropdown-submenu-parent opens-right" role="menuitem" aria-haspopup="true" aria-expanded="false" aria-label="Courses"><a href="{{ route('webadmin.blog.index') }}" >Blog Posts</a></li>
        <li class="single-sub parent-nav is-dropdown-submenu-parent opens-right" role="menuitem" aria-haspopup="true" aria-expanded="false" aria-label="Courses"><a href="{{ route('webadmin.categories.index') }}" >Categories</a></li>
        <li class="single-sub parent-nav is-dropdown-submenu-parent opens-right" role="menuitem" aria-haspopup="true" aria-expanded="false" aria-label="Courses"><a href="{{ route('webadmin.tags.index') }}" >Tags</a></li>
        <li class="single-sub parent-nav is-dropdown-submenu-parent opens-right" role="menuitem" aria-haspopup="true" aria-expanded="false" aria-label="Courses"><a href="{{ route('webadmin.sliders.index') }}" >Sliders</a></li>
        @else
            {{-- Fallback for any other roles or if no role is assigned --}}
        @endif
            <li role="menuitem"><a href="#">Profile Menu</a></li>
            <li role="menuitem" style="float: right"><a  href="{{ route('logout') }}"
                onclick="event.preventDefault();
                              document.getElementById('logout-form').submit();">
                 {{ __('Logout') }}
             </a>
            </li>
            <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                @csrf
            </form>
                   
        @endauth
    </ul>
 </nav>