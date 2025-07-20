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
         <h1>Mission</h1>
      </div>
      <div class="small-12 cell">
         <ul class="breadcrumbs">
            <li><a href="{{route('home')}}">Home</a></li>
            {{-- <li class="disabled">Gene Splicing</li> --}}
            <li><span class="show-for-sr">Current: </span> Mission</li>
         </ul>
      </div>
   </div>
</div>

<div class="information-boxes grey-bg module">
   <div class="grid-container grid-x grid-padding-x">
      <div class="small-12 medium-12 large-12 cell">
         <div class="information-box">
            {{-- <h2 style="text-align: center"><u>Mission</u></h2> --}}
            <p>At Dr Behl Skin Institute and School of Dermatology, our mission is to provide world-class dermatological care while advancing skin care through education, research, and innovation. We are committed to offering personalised, evidence-based treatments to enhance the health and beauty of our patients' skin, fostering a holistic approach to wellness. <br>
                Through our comprehensive and cutting-edge training programs, we aim to equip future dermatologists with the knowledge, clinical skills, and ethical foundation necessary to excel in the ever-evolving field of dermatology. We take pride in creating a nurturing environment that fosters the development of compassionate, patient-centred healthcare professionals. <br>
                Our dedication to excellence in patient care, professional development, and groundbreaking research ensures that we continue to set the standard for dermatology in both practice and education. By promoting the highest standards of ethics, patient safety, and innovation, we aspire to lead the way in shaping the future of dermatology globally and making a lasting impact on the skin health of communities worldwide.
                </p>

         </div>
            
      </div>
   </div>
</div>



@endsection