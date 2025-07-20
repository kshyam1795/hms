@extends('welcome')
@section('web-content')
<div class="title-section dark-bg">
    <div class="grid-container grid-x grid-padding-x">
       <div class="small-12 cell">
          <h1>Appointment</h1>
       </div>
       <div class="small-12 cell">
          <ul class="breadcrumbs">
            <li><a href="{{route('home')}}">Home</a></li>
             {{-- <li class="disabled">Gene Splicing</li> --}}
             <li><span class="show-for-sr">Current: </span> Appointment</li>
          </ul>
       </div>
    </div>
 </div>
 <div class="appointment-page form-section dark-bg grey-bg">
    <div class="grid-container grid-x grid-padding-x">
       <!-- #region -->
       <div class="medium-4 small-12 cell">
            <h2>Scan QR code for book your appointment</h2>
            <img src="{{ asset('assets/images/appointmentQRCode.png')}}" alt="QR Code">
       </div>
       <div class=" medium-8 small-12 cell">
          <div class="form">
             <h2>Contact Us</h2>
             <p>Want to book an appointment with us? Fill up the form below to get appointment.</p>
             <div class="appointment-form">
               <form action="" method="post">
                  @csrf
                  <div class="grid-container grid-x grid-padding-x">
                      <div class="medium-6 small-12 cell">
                          <label>Your Full Name *</label>
                          <input type="text" name="name" required placeholder="Name">
                      </div>
                      <div class="medium-6 small-12 cell">
                          <label>Your Phone# *</label>
                          <input type="text" name="phone" required placeholder="Phone">
                      </div>
                      <div class="medium-6 small-12 cell">
                          <label>Your Email *</label>
                          <input type="email" name="email" required placeholder="Email">
                      </div>
                      <div class="medium-6 small-12 cell">
                          <label>Preferred Date *</label>
                          <input type="date" name="appointment_date" required>
                      </div>
                      <div class="medium-12 small-12 cell">
                          <label>Branch Location </label>
                          <select name="location_name" required>
                           <option value="">Select Branch Location</option>
                           @foreach ($locations as $id => $name)
                                 <option value="{{ $id }}">{{ $name }}</option>
                           @endforeach                       
                              
                               
                          </select>
                      </div>
                      {{-- <div class="medium-12 cell">
                          <label>Select Doctor</label>
                          <select name="doctorList" required>
                           <option value="">Select doctor</option>
                              @foreach ($doctors as $doctor )
                                 <option value="{{$doctor->id}}">{{$doctor->name}}</option>
                              @endforeach                        
                              
                               
                          </select>
                      </div>
                      <div class="medium-12 cell">
                          <label>Select Service</label>
                          <select name="service" required>
                              <option value="">Select Service</option>
                              @foreach ($services as $service )
                                 <option value="{{$service->id}}">{{$service->name}}</option>
                              @endforeach
                               
                          </select>
                      </div> --}}
                      <div class="medium-12 cell">
                          <label>Your message</label>
                          <textarea name="your_message" placeholder="Your message" rows="4"></textarea>
                      </div>
                      <input type="hidden" name="age2" value="25">
                      <input type="hidden" name="gender" value="1">
                      <div class="medium-12 cell">
                          <button class="primary button" type="submit">Book Appointment</button>
                      </div>
                  </div>
              </form>
              
             </div>
          </div>
          <div class="clearfix"></div>
       </div>
    </div>
 </div>
    
@endsection