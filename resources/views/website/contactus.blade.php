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
         <h1>About Us</h1>
      </div>
      <div class="small-12 cell">
         <ul class="breadcrumbs">
            <li><a href="{{route('home')}}">Home</a></li>
            {{-- <li class="disabled">Gene Splicing</li> --}}
            <li><span class="show-for-sr">Current: </span> About Us</li>
         </ul>
      </div>
   </div>
</div>
<div class="about-section module">
   <div class="grid-container grid-x grid-padding-x">
      <div class="small-12 medium-12 large-6 cell">
         <div class="about-img">
            <img src="{{ asset('assets/images/help/doctor-image-1.jpg')}}" alt="About-img" />
             <p>‘‘Those who knew him, Would not be able to define his greatness. 
               Those who feel they defined it, Could not have known him.
               ’’</p>
            </div>
      </div>
      
      <div class="small-12 medium-12 large-6 cell ">
         <div class="introduction-side">
            <div class="about-text">
               <h2>Founder<br> 
                  Late (Prof.)  Dr. P.N.Behl, </h2>
               <h4>[23-09-1923 to 15-10-2002]</h4>
               <p>The Skin Institute &amp; School Of Dermatology (SISD), was founded in 1978 by
                  late Dr.P.N. Behl, Ex-Professor and Head of the Department of Dermatology, Maulana
                  Azad Medical College. He took up a challenge to promote academic dermatology and to
                  provide inexpensive &amp; affordable humane medical services for the benefit of both the
                  poor and the rich. Through the best and latest technology available in the world.</p>
               <p> Being a visionary he established a public Charitable Trust in the name of “SKIN
                  INSTITUTE &amp; PUBLIC SERVICES CHARITABLE TRUST” duly registered under the
                  
                  Societies Act and as on date, has, a couple of health centres, associated to the trust
                  successfully treating patients from all walks of life.</p>

                  <p>Treating patients, through his missionary zeal, in the years bygone, Dr Behl has
                     not only earned reputation for himself but has made his place in the heart of many poor
                     and needy people. Thus making it the best in the field of dermatology.</p>
                  <p>A self-supporting Trust, has sustained its constant growth and striding hard
                     especially in the field of dermatology and medical services as a whole.</p>
                  <p></p>
                  </div>
            
            
            {{-- <a class="button primary" href="{{route('aboutus')}}">More about Dr. PN Behl</a>
            <a class="button secondary" href="#">Why Chose Us</a> --}}
         </div>
      </div>
   
      <div class="small-12 medium-12 large-11 cell large-offset-1">
         <div class="introduction-side">
            <div class="about-info-box" style="padding-top:5%;">
               <div class="about-info-text">
                  <p>The Skin Institute &amp; School Of Dermatology (SISD) is a center of excellence,
                     offering world-class skin care services through its most advanced techniques,
                     procedures, and equipments while treating its patients. The institute also holds an
                     exceptionally well-trained team of healthcare professionals, which makes it more
                     popular amongst patients.</p>
                        <p>Moreover, The Skin Institute &amp; School Of Dermatology is an international center
                        for professional training and procedural consultation with regular contributions from the
                        world’s most talented cosmetic physicians. Our comprehensive and individualized
                        services, capable of catering to virtually every skin care need, produce noticeable and
                        permanent improvements in skin health.
                     </p>
                     <p>At The Skin Institute &amp; School Of Dermatology, we believe that healthy skin
                     ultimately leads to the overall health and wellness of our patients.</p>
                     <p></p>

                     <h3>FOUNDER OF THE TRUST - PROFESSOR (DR.) PRAN NATH BEHL</h3>
                     <p><strong>Professor (Dr.) Pran Nath Behl, MB, FRCP, (Edinburgh), FICAI, FIAMS,</strong>  a
                     world-renowned dermatologist and specialist in Cutaneous surgery, occupied a
                     distinguished position among the leading physicians in India. Besides being eminent in
                     the field of medicines, he devoted himself to teaching, research, writing, farming and
                     missionary works. He delivered lectures at various Universities and scientific centers,
                     within the country as well as other countries viz. US, USSR, Europe, China, Africa,
                     Japan, South America and the Far East</p>

                     <h5>Dr Pran Nath Behl had published 16 books and several articles on scientific issues and social problems, prominent being:</h5>
                     <ul>
                        <li>Practice of Dermatology.</li>
                        <li>Practice of Skin Surgery.</li>
                        <li>Practice of Dermal Histopathology.</li>
                        <li>Dermatology Rediscovered – A Wholistic Approach to Derma - therapy.</li>
                        <li>Skin Irritant & Sensitising Plants Found in India.</li>
                        <li>Dermatology and Venereology for Nurses</li>
                        <li>Traditional Indian Dermatology – Concepts of Past and Present.</li>
                        <li>Herbs Useful in Dermatological Therapy.</li>
                        <li>Where No Skin Specialist is Available.</li>
                        <li>Teaching AIDS - For Medical Auxiliaries, Rural  Physicians and Lay Sufferers.</li>
                        <li>AIDS to Good Health. </li>
                        <li>Dermatology Times.</li>
                        <li>Asian Clinics in Dermatology.</li>
                        <li>Positive Health and Happiness.</li>
                        <li>The Lord of Darkness</li>
                        
                     </ul> 
                  </div>
               </div>
         </div>
      </div>
      <div class="small-12 medium-12 large-11 cell large-offset-1">
         <div class="introduction-side">
            <div class="our-partners module" style="margin-bottom: 0px;">
               <div class="grid-container grid-x grid-padding-x">
                  <div class="partners">
                     <div class="partners-logo">
                        <a href="#"><img src="assets/images/help/books/b1.png" alt /></a>
                     </div>
                     <div class="partners-logo">
                        <a href="#"><img src="assets/images/help/books/b1.png" alt /></a>
                     </div>
                     <div class="partners-logo">
                        <a href="#"><img src="assets/images/help/books/b1.png" alt /></a>
                     </div>
                     <div class="partners-logo">
                        <a href="#"><img src="assets/images/help/books/b1.png" alt /></a>
                     </div>
                     <div class="partners-logo">
                        <a href="#"><img src="assets/images/help/books/b1.png" alt /></a>
                     </div>
                  </div>
               </div>
            </div>
         </div>
      </div>
      <div class="small-12 medium-12 large-11 cell large-offset-1">
         <div class="introduction-side">
            <div class="about-info-box" style="padding-top:5%;">
               <div class="about-info-text">
                  <p>Dr. PN Behl perhaps was the only luminary, who wrote a book on his own
                     kidnapping titled “THE LORD OF DARKNESS”. The publishers of this book –
                     M/s Minerva Press of U.K. Described his kidnapping episode as under :</p>
                  <h4><b>“Kidnapped and held in a chilly sugarcane field for fifteen days in 1994,
                     Dr. Behlan eminent dermatologist followed in the great tradition of John Banyan
                     and other captives, who pit their minds against their circumstances – AND WIN”.</b></h4>
                  <p>Dr. Behl was befittingly conferred with the title of “FATHER OF DERMATOLOGY” by
                     By the Association of Cutaneous Surgeons of India at Jodhpur in the year 2000,
                     Besides, he was bestowed upon with number of awards for his pioneering and practical
                     work in dermatology. He practiced ‘Nishkarma - a practice advocated by the Rishies’. He
                     donated his private earnings and money generated by him without drawing any benefits
                     from the Institute for himself as also for his family member.</p>
                  <p>Although, The Legend, Dr. Behl, left this materialistic world, on 15 th October, 2002 at the
                     age of 79 for his eternal journey, the but he is still among us through his research studies
                     as well as the missionary works.</p>

                  <p><b>Dr. Behl’s motto - LIFE IS DUTY.</b> Which refers that the Life should be lived skillfully
                     honestly and with utmost sincerity for building up the community and the nations as a whole.</p>
                  <p>The Skin Institute &amp; School Of Dermatology (SISD) follows the &quot;MOTTO&quot;
                     religiously and meticulously.</p>
                  
               </div>
            </div>
         </div>
      </div>
   </div>
</div>
<div class="information-boxes grey-bg module">
   <div class="grid-container grid-x grid-padding-x">
      <div class="small-12 medium-12 large-12 cell">
         <div class="information-box">
            <div class="information-icon">
               <img src="assets/images/help/information-boxes/icon-1.png" alt="Icon" />
            </div>
            <div class="information-text">
               <h4><a class="#">Advanced Dermatology</a></h4>
               <p>A collection of textile samples lay spread out on the table - Samsa was a travellig salesman and above it there hung a picture that he had recently cut out in the situation of lines. Quick brown fox jumps over the lazy.</p>
               <a href="#">Learn More ...</a>
            </div>
         </div>
         <div class="information-box second-information-box">
            <div class="information-icon">
               <img src="assets/images/help/information-boxes/icon-2.png" alt="Icon" />
            </div>
            <div class="information-text">
               <h4><a class="#">Cosmetic Dermatology</a></h4>
               <p>A collection of textile samples lay spread out on the table - Samsa was a travellig salesman and above it there hung a picture that he had recently cut out in the situation of lines. Quick brown fox jumps over the lazy.</p>
               <a href="#">Learn More ...</a>
            </div>
         </div>
         <div class="information-box">
            <div class="information-icon">
               <img src="assets/images/help/information-boxes/icon-3.png" alt="Icon" />
            </div>
            <div class="information-text">
               <h4><a class="#">Laser Dermatology</a></h4>
               <p>A collection of textile samples lay spread out on the table - Samsa was a travellig salesman and above it there hung a picture that he had recently cut out in the situation of lines. Quick brown fox jumps over the lazy.</p>
               <a href="#">Learn More ...</a>
            </div>
         </div>
      </div>
   </div>
</div>


@endsection