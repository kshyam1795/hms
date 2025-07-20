@extends('welcome')
@section('web-content')
<style>
   .service-box img {
      height: 280px !important;
      width: 100%;
      object-fit: cover;
      border-radius: 10px;
   }
   .service-box .service-text {
      background-color: #ffffff;
      padding: 20px;
      height: auto;
      border-radius: 10px;
      box-shadow: 0px 4px 10px rgba(0, 0, 0, 0.1);
      text-align: center;
   }
   
   /* .title-section {
      padding: 40px 0;
      text-align: center;
      background-color: #f8f9fa;
   }
   .breadcrumbs {
      display: flex;
      justify-content: center;
      list-style: none;
      padding: 0;
   }
   .breadcrumbs li {
      margin: 0 5px;
      font-weight: bold;
   }
   .breadcrumbs a {
      color: #007bff;
      text-decoration: none;
   } */
   .services {
      padding: 50px 0;
   }
   .services h2 {
      text-align: center;
      font-size: 28px;
      margin-bottom: 20px;
   }
   .services ol {
      columns: 2;
      padding: 20px;
   }
   .services li {
      margin-bottom: 10px;
      font-size: 16px;
   }
   .call-to-action.dark-bg:after {
        background: url(http://3.108.33.182/healthplix/public/assets/images/help/doctor-image-1.jpg) repeat fixed center center / cover;
    }
   @media (max-width: 768px) {
      .services ol {
         columns: 1;
      }
   }
</style>



<div class="title-section dark-bg">
    <div class="grid-container grid-x grid-padding-x">
       <div class="small-12 cell">
          <h1>Skin Diseases & Treatments</h1>
       </div>
       <div class="small-12 cell">
          <ul class="breadcrumbs">
             <li><a href="{{route('home')}}">Home</a></li>
             {{-- <li class="disabled">Gene Splicing</li> --}}
             <li><span class="show-for-sr">Current: </span> Skin Diseases & Treatments</li>
          </ul>
       </div>
    </div>
 </div>

<div class="services grey-bg">
   <div class="grid-container">
      <div class="large-12 cell">
         <h2><strong>Skin Diseases</strong></h2>
         <ol>
             
            <li>Leprosy</li>
            <li>Pigmentation Treatment</li>
            <li>Vitiligo</li>
            <li>Leucoderma</li>
            <li>Melasma</li>
            <li>Bacterial, Fungal, and Viral Skin Diseases</li>
            <li>Sexually Transmitted Diseases (STD)</li>
            <li>Autoimmune Skin Disorders (SLE, DLE)</li>
            <li>Acne</li>
            <li>Rosacea</li>
            <li>Psoriasis</li>
            <li>Lichen Planus</li>
            <li>Seborrheic Dermatitis</li>
            <li>Allergic Contact Dermatitis</li>
            <li>Cutaneous Drug Reactions</li>
            <li>Scabies</li>
         </ol>
         <h2><strong>Laser Services & Treatments</strong></h2>
         <ol>
            <li>Scar Reduction</li>
            <li>Wart Removal</li>
            <li>Skin Tag Removal</li>
            <li>Birthmark Removal</li>
            <li>Tattoo Removal</li>
            <li>Hair Removal</li>
            <li>Fractional Laser Treatment</li>
            <li>Papilloma</li>
            <li>Epithelioma</li>
         </ol>
         <h2><strong>Surgeries</strong></h2>
         <ol>
            <li>Scar Revision Surgery</li>
            <li>Mole Removal</li>
            <li>Vampire Facial</li>
            <li>Micro-Needling</li>
            <li>Post Acne Scar Treatment</li>
            <li>Post Chickenpox Scars</li>
            <li>Cyst & Abscess Removal</li>
            <li>Keloid Treatment</li>
            <li>Ear Lobe Surgery</li>
            <li>Nail Surgery</li>
            <li>Radiofrequency Therapy</li>
            <li>Corn/Wart/Callosity Removal</li>
         </ol>
         <h2><strong>Skin Treatments</strong></h2>
         <ol>
            <li>Under Eye Treatments</li>
            <li>Anti-Aging</li>
            <li>Thermage</li>
            <li>HydraFacial</li>
            <li>Skin Boosters</li>
         </ol>
         <h2><strong>Hair Growth Treatments</strong></h2>
         <ol>
            <li>Hair Loss</li>
            <li>Androgenetic Alopecia (Male & Female Pattern Baldness)</li>
            <li>Alopecia Areata</li>
            <li>Hair Fall</li>
            <li>Platelet Rich Plasma Therapy (PRP)</li>
         </ol>
         <h2><strong>Aesthetic & Cosmetology Treatments</strong></h2>
         <ol>
            <li>Thread Lift</li>
            <li>Dermal Fillers</li>
            <li>Scalp Micropigmentation</li>
            <li>Eyebrow Microblading</li>
            <li>Powder Brows</li>
            <li>Chemical Peels</li>
            <li>Botox Therapy</li>
         </ol>
         <h2><strong>Nail Treatments</strong></h2>
         <ol>
            <li>Paronychia</li>
            <li>Onychomycosis</li>
            <li>Dystrophy</li>
         </ol>
      </div>
   </div>
</div>
@endsection
