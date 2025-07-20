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
         <h1>Vision</h1>
      </div>
      <div class="small-12 cell">
         <ul class="breadcrumbs">
            <li><a href="{{route('home')}}">Home</a></li>
            {{-- <li class="disabled">Gene Splicing</li> --}}
            <li><span class="show-for-sr">Current: </span> Vision</li>
         </ul>
      </div>
   </div>
</div>
 
 
<div class="information-boxes dark-bg  module">
    <div class="grid-container grid-x grid-padding-x">
       <div class="small-12 medium-12 large-12 cell">
          <div class="information-box">
             {{-- <h3 style="text-align: center"><u>Vision</u></h3> --}}
             <p>At Dr Behl Hospital, Skin Institute, and School of Dermatology, our vision is to lead the way in transforming the future of dermatology through a comprehensive, patient-centred approach that integrates world-class clinical care, pioneering research, and excellence in education. We aspire to be a global hub of dermatological innovation, providing cutting-edge treatments that empower individuals to achieve optimal skin health and radiance, regardless of age or background. <br>
                We envision a future where advanced dermatological care is accessible to all, and where holistic treatments, supported by the latest scientific advancements, ensure not only the aesthetic beauty of the skin but also its long-term health. Through groundbreaking research and technological advancements, we seek to address the most complex skin conditions and challenges, improving lives across the globe. <br>
                As an institution committed to fostering a culture of learning, compassion, and integrity, we strive to cultivate the next generation of skilled dermatologists, equipped with the expertise and ethical foundation to shape the future of the field. Our focus on comprehensive training and professional development aims to produce leaders in dermatology who are passionate about driving positive change and enhancing the quality of care in communities worldwide.<br>
                We aspire to set the highest standards in patient care, education, and scientific exploration, with a relentless commitment to improving skin health outcomes. Our legacy will be one of transformative impact—empowering individuals, advancing the dermatology profession, and creating a healthier, more confident global community.
                </p>
 
          </div>
             
       </div>
    </div>
 </div>


@endsection