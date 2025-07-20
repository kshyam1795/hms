@extends('welcome')
@section('web-content')

<style>
    .service-box img {
        height: 280px !important;
        object-fit: cover;
    }
    .service-box .service-text {
        background-color: #ffffff;
        padding: 23px 20px;
        height: auto;
        min-height: 300px;
        border-radius: 10px;
        box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
    }
    .call-to-action.dark-bg:after {
        background: url('{{ asset('assets/images/help/doctor-image-1.jpg') }}') repeat fixed center center / cover;
    }
    /* .title-section {
        text-align: center;
        padding: 50px 0;
        background: linear-gradient(rgba(0,0,0,0.6), rgba(0,0,0,0.6)), url('{{ asset('assets/images/banner.jpg') }}') no-repeat center center/cover;
        color: #fff;
    }
    .title-section h1 {
        font-size: 36px;
        font-weight: bold;
    }
    .breadcrumbs {
        display: flex;
        justify-content: center;
        list-style: none;
        padding: 0;
        margin-top: 10px;
    }
    .breadcrumbs li {
        margin: 0 5px;
        color: #fff;
    }
    .breadcrumbs a {
        color: #f8d210;
        text-decoration: none;
    } */
    .services {
        background-color: #f9f9f9;
        padding: 50px 0;
    }
    .service-content {
        text-align: center;
        max-width: 900px;
        margin: 0 auto;
        background: #fff;
        padding: 30px;
        border-radius: 10px;
        box-shadow: 0 4px 10px rgba(0, 0, 0, 0.1);
    }
    .service-content h2 {
        font-size: 28px;
        font-weight: bold;
        color: #333;
        margin-bottom: 20px;
        border-bottom: 3px solid #0073e6;
        display: inline-block;
        padding-bottom: 5px;
    }
    .service-content p {
        font-size: 18px;
        color: #555;
        line-height: 1.6;
        margin-bottom: 15px;
    }
    .para p {
        font-size: 14.5px !important;
    }
</style>

<div class="title-section dark-bg">
    <div class="grid-container grid-x grid-padding-x">
       <div class="small-12 cell">
          <h1>FACILITIES AVAILABLE</h1>
       </div>
       <div class="small-12 cell">
          <ul class="breadcrumbs">
             <li><a href="{{route('home')}}">Home</a></li>
             {{-- <li class="disabled">Gene Splicing</li> --}}
             <li><span class="show-for-sr">Current: </span> FACILITIES AVAILABLE</li>
          </ul>
       </div>
    </div>
 </div>

 <div class="services grey-bg">
    <div class="padding-between services-wrap para">
       <div class="grid-container grid-x grid-padding-x grid-padding-y">
          <div class="large-6 medium-6 small-12 cell" >
            
            <h2><strong>DERMATOLOGY</strong></h2>
            <p>Treatment for all kinds of diseases related to:</p>
            <p>Skin, Hair, and Nails.</p>
            <hr>
            <h2><strong>O.P.D.</strong> </h2>
            <p>General and Private</p>
            <hr>
            <h2><strong>WARDS</strong></h2>
            <p>In-Patient Care Ward</p>
            <hr>
            <h2><strong>LASER FACILITIES</strong></h2>
            <p>Versa Pulse Aesthetic Laser, Light Sheer Diode Laser, CO2 Laser, Fractional Laser, and Super Pulse RF System for wrinkle removal.</p>
            <hr>
            <h2><strong>SURGERIES</strong></h2>
            <p>Melanocyte Grafting, Vitiligo Surgery, Nail Surgery, Scar Treatment, Lipo-Suction, Skin Culture, Leprosy Surgery, Chemical Peeling, Cryo Surgery, Burns, and Plastic Surgery.</p>
            <hr>
          </div>
          <div class="large-6 medium-6 small-12 cell" >
            <h2><strong>HAIR TRANSPLANTATION</strong></h2>
            <p>Afro Hair Transplant, FUE, Receding Hairline Reconstruction, Beard Hair Transplant, Hair Transplant Surgeries, and Botox.</p>
            <hr>
            <h2><strong>COSMETOLOGY</strong></h2>
            <p>Wart Removal, Skin Tag Removal, Mole Removal, Laser Tattoo Removal.</p>
            <hr>
            <h2><strong>SCAR REDUCTION TREATMENTS</strong></h2>
            <p>Laser Scar Reduction, Micro-Needling, Laser Scar Removal, and Under Eye Treatments.</p>
            <hr>
            <h2><strong>PHARMACY</strong></h2>
            <p>Two well-furnished Pharmacies.</p>
            <hr>
            <h2><strong>LABORATORIES & HISTOPATHOLOGY</strong></h2>
            <p>Complete Blood Count, Liver Function Test, Lipid Profile, Thyroid Test, Blood Sugar, HbA1c, Vitamin D, Vitamin B12, HBsAg, HCV, HIV, VDRL, TPHA, Pus & Urine Culture, Gram Stain, IgE Levels, Skin Biopsy, Scraping for Fungal Infections, Slit Smear for AFB, Tzanck Smear, Wood Lamp Examination, Allergy Skin Tests.</p>
            <hr>
        </div>
        </div>
    </div>
</div>

@endsection


