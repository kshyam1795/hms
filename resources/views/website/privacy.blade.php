@extends('welcome') 
@section('web-content')
<div class="title-section dark-bg">
    <div class="grid-container grid-x grid-padding-x">
       <div class="small-12 cell">
          <h1>Privacy Policy</h1>
       </div>
       <div class="small-12 cell">
          <ul class="breadcrumbs">
            <li><a href="{{route('home')}}">Home</a></li>
             {{-- <li class="disabled">Gene Splicing</li> --}}
             <li><span class="show-for-sr">Current: </span> Privacy Policy</li>
          </ul>
       </div>
    </div>
 </div>
@endsection