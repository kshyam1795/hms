@extends('welcome')
@section('web-content')
<style>
   .partners .partners-logo a img {
    /* width: 100%; */
    height: auto !important;
}
p,h1,h2,h3,h4,li,a{
   text-align: justify;
   font-size:1rem;
}
.cell{
   /* background: white; */
}
</style>
<div class="title-section dark-bg module">
   <div class="grid-container grid-x grid-padding-x">
      <div class="small-12 cell">
         <h1>AIMS & OBJECTIVES</h1>
      </div>
      <div class="small-12 cell">
         <ul class="breadcrumbs">
            <li><a href="{{route('home')}}">Home</a></li>
            {{-- <li class="disabled">Gene Splicing</li> --}}
            <li><span class="show-for-sr">Current: </span> AIMS & OBJECTIVES</li>
         </ul>
      </div>
   </div>
</div>
<div class="about-section module">
   <div class="grid-container grid-x grid-padding-x">
    <div class="small-12 medium-12 large-6 cell">
        <div class="about-img">
           <img src="{{ asset('assets/images/help/doctor-image-1.jpg')}}" alt="About-img" />
           <p style="text-align: center; width: 100%;">Late Prof. (Dr.) P.N. Behl <br>
            “Father of Dermatosurgery in India”
             </p>
             
        </div>
        
     </div>
     <div class="small-12 medium-12 large-6 cell ">
        <div class="introduction-side">
           <div class="about-text">
              <h2 style='font-family: "Helvetica Neue", Helvetica, Roboto, Arial, sans-serif;'>AIMS & OBJECTIVES </h2>
              
             <div class="about-info-box">
                {{-- <i class="fas fa-check"></i> --}}
                <div class="about-info-text" style="width: 100% !important;">
                   
                   <ul style="list-style-type: number;">
                      <li>Dr. P. N. Behl believed in LIFE IS DUTY, he believed in fulfilling our responsibilities and obligations to ourselves, our community, and the world around us with a sense of purpose to make a positive impact by doing what is morally right and necessary.</li>
                      <li>At our institute, we are motivated by a deep-seated missionary zeal and a commitment to charitable service, embodying the essence of humanitarian values.</li>
                      <li>Our primary goal is to provide exemplary healthcare services and relief to those in need, particularly those who are economically disadvantaged.
                      </li>
                      <li>We are dedicated to serving all individuals with compassion and respect, regardless of caste, creed, gender, economic status, or religion.
                      </li>
                      <li>We strive to deliver the highest quality of treatment with a strong focus on patient satisfaction. Our approach emphasizes minimizing financial burdens and alleviating any potential economic hardships for our patients.</li>
                      <li>We believe in job satisfaction and are committed to creating a healthy working environment for all our staff members. We promote the well-being of our team.
                      </li> 
                      <li>We are also committed to the academic advancement of our staff, offering opportunities for research, writing, and teaching. Our institute encourages continuous learning and professional development to enrich both individual and collective knowledge.</li>                    
                         
                   </ul> 
                   <p>Together, we aim to fulfill our mission of compassionate healthcare while lifting the spirits and lives of those we serve.</p>
                </div>
             </div>
           
           
        </div>
     </div>
   
      
   </div>
</div>



@endsection