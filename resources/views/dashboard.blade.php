@extends('layouts.app')
@section('content')
    @auth
         
        @if (Auth::user()->role->name == 'super_admin')
            <!-- Admin dashboard content -->
            <h1>Super Admin Dashboard</h1>
            <p>Welcome, {{ Auth::user()->name }}.</p>
            <!-- Add more admin-specific content here -->
            @include('dashboards.superadmin')    
        @elseif (Auth::user()->role->name == 'doctor')
            <!-- Manager dashboard content -->
            {{-- <h1>doctor Dashboard</h1>
            <p>Welcome, {{ Auth::user()->name }}. Here you can manage your team and tasks.</p> --}}
            <!-- Add more manager-specific content here -->
            
            @include('dashboards.doctor')

        @elseif (Auth::user()->role->name == 'patient')
            <!-- Regular user dashboard content -->
            <h1>patient Dashboard</h1>
            <p>Welcome, {{ Auth::user()->name }}. Here you can view your data and tasks.</p>
            <!-- Add more user-specific content here -->
        @elseif (Auth::user()->role->name == 'receptionist')
            
            @include('dashboards.receptionist')
            <!-- Add more user-specific content here -->
        @elseif (Auth::user()->role->name == 'MD-trustee')
            <!-- Regular user dashboard content -->
            <h1>MD-trustee Dashboard</h1>
            <p>Welcome, {{ Auth::user()->name }}. Here you can view your data and tasks.</p>

            <!-- Add more user-specific content here -->
        @elseif (Auth::user()->role->name == 'webadmin')
            <!-- Regular user dashboard content -->
            <h1>MD-trustee Dashboard</h1>
            <p>Welcome, {{ Auth::user()->name }}. Here you can view your data and tasks.</p>
            <!-- Add more user-specific content here -->
            @include('dashboards.webadmin')

        @elseif (Auth::user()->role->name == 'guest')
            <!-- Default content for authenticated users without a specific role -->
            <h1>guest Dashboard</h1>
            <p>Welcome, {{ Auth::user()->name }}.</p>
         
        @else
        <!-- Content for guests -->
        <h1>Welcome to the Application</h1>
        <p>Please <a href="{{ route('login') }}">log in</a> to access your dashboard.</p>
        @endif
    @endauth
@endsection