@extends('welcome') 
@section('web-content')
<div class="title-section dark-bg">
    <div class="grid-container grid-x grid-padding-x">
       <div class="small-12 cell">
          <h1>OUR TESTIMONIALS</h1>
       </div>
       <div class="small-12 cell">
          <ul class="breadcrumbs">
             <li><a href="{{route('home')}}">Home</a></li>
             {{-- <li class="disabled">Gene Splicing</li> --}}
             <li><span class="show-for-sr">Current: </span> Testimonial</li>
          </ul>
       </div>
    </div>
 </div>
 <div class="testimonials testimonial-page grey-bg">
    <div class="padding-between-inner-pags">
       <div class="grid-container grid-x grid-padding-x">
          <div class="large-9 medium-7 small-12 cell">
             <div class="testimonial grid-container grid-x grid-padding-x grid-padding-y">
                <div class="large-12 medium-12 small-12 cell">
                   <div class="testimonial-text">
                      <img src="assets/images/help/testimonial-1.png" alt />
                      <p>Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry's standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book. It has survived not only five centuries, but also the leap into electronic typesetting, remaining essentially unchanged. </p>
                      <h6>John Doe - <span>Google Ads</span></h6>
                   </div>
                </div>
                <div class="large-12 medium-12 small-12 cell">
                   <div class="testimonial-text">
                      <img src="assets/images/help/testimonial-2.png" alt />
                      <p>Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry's standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book. It has survived not only five centuries, but also the leap into electronic typesetting, remaining essentially unchanged. </p>
                      <h6>John Doe - <span>Google Ads</span></h6>
                   </div>
                </div>
                <div class="large-12 medium-12 small-12 cell">
                   <div class="testimonial-text">
                      <img src="assets/images/help/testimonial-1.png" alt />
                      <p>Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry's standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book. It has survived not only five centuries, but also the leap into electronic typesetting, remaining essentially unchanged. </p>
                      <h6>John Doe - <span>Google Ads</span></h6>
                   </div>
                </div>
             </div>
          </div>
          <div class="large-3 medium-5 small-12 cell sidebar">
             <div class="widget">
                <h2>Submit Feedback </h2>
                <div class="widget-content">
                   <form>
                      <input type="text" placeholder="Your name..." />
                      <input type="text" placeholder="Your Email ...." />
                      <select>
                         <option>Select rating</option>
                         <option>1 Star</option>
                         <option>2 Star</option>
                         <option>3 Star</option>
                         <option selected>4 Star</option>
                         <option>5 Star</option>
                      </select>
                      <select>
                         <option>Select Service</option>
                         <option>Service 1</option>
                         <option>Service 2</option>
                         <option>Service 3</option>
                      </select>
                      <select>
                         <option>Select Doctor</option>
                         <option>Doctor 1</option>
                         <option>Doctor 2</option>
                         <option>Doctor 3</option>
                      </select>
                      <input type="text" placeholder="Reason of satisfaction..." />
                      <label>Select Your Image
                      <input type="file" />
                      </label>
                      <textarea placeholder="Your review..." rows="2"></textarea>
                      <input type="submit" class="button primary last-item" />
                   </form>
                </div>
             </div>
          </div>
       </div>
    </div>
 </div>
@endsection