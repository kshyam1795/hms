@extends('welcome')
@section('web-content')
@include('website.include.banner',  ['sliders' => $sliders])
<style>
   .call-to-action.dark-bg:after {
    background: url(http://3.108.33.182/healthplix/public/assets/images/help/doctor-image-1.jpg) repeat fixed center center / cover;
}
</style>
<div class="information-boxes grey-bg module">
    <div class="grid-container grid-x grid-padding-x">
       <div class="small-12 medium-12 large-12 cell">
          <div class="information-box">
             <div class="information-icon">
                <img src="{{ asset('assets/images/help/information-boxes/icon-1.png')}}" alt="Icon" />
             </div>
             <div class="information-text">
                <h4><a class="#">LASER SCAR REDUCTION</a></h4>
                <p>Laser treatment for skin acne scars concentrates light on the top layers of your skin to separate scar tissue. Simultaneously, the treatment supports new, sound skin cells to develop and supplant the scar tissue. </p>
                <a href="http://3.108.33.182/healthplix/public/treatments-services#:~:text=LASER%20SCAR%20REDUCTION%3A">Learn More ...</a>
             </div>
          </div>
          <div class="information-box second-information-box">
             <div class="information-icon">
                <img src="{{ asset('assets/images/help/information-boxes/icon-2.png')}}" alt="Icon" />
             </div>
             <div class="information-text">
                <h4><a class="#">VAMPIRE FACIAL</a></h4>
                <p>Vampire Facial promotes healthy activity in your skin cells stimulated by your blood cells. Our blood contains various blood cells. These blood cells are separated using a special machine and growth factors are removed.</p>
                <a href="http://3.108.33.182/healthplix/public/treatments-services#:~:text=by%20surgical%20excision.-,VAMPIRE%20FACIAL,-%3A%20Vampire%20Facial">Learn More ...</a>
             </div>
          </div>
          <div class="information-box">
             <div class="information-icon">
                <img src="{{ asset('assets/images/help/information-boxes/icon-3.png')}}" alt="Icon" />
             </div>
             <div class="information-text">
                <h4><a class="#">HAIR GROWTH TREATMENTS</a></h4>
                <p>At Skin Institute and School Of Dermatology (SISD), we use Growth factor concentrate (GFC) which is an advanced version of platelet-rich plasma to treat hair loss. GFC is the latest and most advanced treatment to</p>
                <a href="http://3.108.33.182/healthplix/public/treatments-services#:~:text=HAIR%20GROWTH%20TREATMENTS">Learn More ...</a>
             </div>
          </div>
       </div>
    </div>
 </div>
 <div class="about-section module">
    <div class="grid-container grid-x grid-padding-x">
      <div class="small-12 medium-12 large-3 cell">
         {{-- just for ceterlized --}}
      </div>
       <div class="small-12 medium-12 large-6 cell">
          <div class="about-img">
             <img src="{{ asset('assets/images/help/doctor-image-1.jpg')}}" alt="About-img" />
             <p style="text-align: center">‘‘Those who knew him, Would not be able to define his greatness. 
               Those who feel they defined it, Could not have known him.
               ’’</p>
               
          </div>
          <div class="about-info-box" style="margin: 10% 0; text-align: center;">
            <a class="button primary" href="{{route('drpnbehl')}}">More about Dr. PN Behl</a>
            <a class="button secondary" href="#">Why Chose Us</a>
          </div>
       </div>
       <div class="small-12 medium-12 large-3 cell">
         {{-- just for ceterlized --}}
      </div>
       <div class="small-12 medium-12 large-6 cell " style="display:none;">
          <div class="introduction-side">
             <div class="about-text">
                <h1>Welcome to Professor (Dr.) Pran Nath Behl, </h1>
                <h3>MB, FRCP, (Edinburgh), FICAI, FIAMS,</span></h3>
                <p>a world-renowned dermatologist and specialist in Cutaneous surgery, occupied a distinguished position among the leading physicians in India. Besides being eminent in the field of medicines, he devoted himself to teaching, research, writing, farming and missionary works. He delivered lectures at various Universities and scientific centers, within the country as well as other countries viz. US, USSR, Europe, China, Africa, Japan, South America and the Far East</p>
                <p> </p>
               </div>
               <div class="about-info-box">
                  {{-- <i class="fas fa-check"></i> --}}
                  <div class="about-info-text" style="width: 100% !important;">
                     <h4>AIMS & OBJECTIVES  </h4>
                     <ul>
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
 <div class="services module grey-bg">
    <div class="section-title">
       <h2>Best Services</h2>
       <p>Explore Our Best Dermatology Services</p>
    </div>
    <div class="padding-between services-wrap">
       <div class="grid-container grid-x grid-padding-x grid-padding-y">
          <div class="large-4 medium-6 small-12 cell">
             <div class="service-box hover-wrap">
                <div class="hover-img">
                   <img src="{{ asset('assets/images/help/services/service-img-1.png')}}" alt="Service Images" />
                   <div class="service-detail hover-info">
                      <a href="#" class="button primary">Know More</a>
                   </div>
                </div>
                <div class="service-text hover-bottom">
                   <h6><a href="#">Anti Aging</a></h6>
                   <p>Anti-Aging is a process to delay, stop or retard the aging. Our bodies are made of cells, and aging occurs when there is cell death.</p>
                   <br>
                   {{-- <p>As an infant, child, and young adults, our body’s cells are strong and can make new cells. As the years advance, our body’s ability to generate new cells diminishes, cell death occurs, and the aging process happens.</p> --}}
                </div>
             </div>
          </div>
          <div class="large-4 medium-6 small-12 cell">
             <div class="service-box hover-wrap">
                <div class="hover-img">
                   <img src="{{ asset('assets/images/help/services/service-img-2.png')}}" alt="Service Images" />
                   <div class="service-detail hover-info">
                      <a href="#" class="button primary">Know More</a>
                   </div>
                </div>
                <div class="service-text hover-bottom">
                   <h6><a href="#">Pigmentation Treatment</a></h6>
                   <p>Pigmentation is one of the most difficult treatments and diseases in Asian Skin. We especially Indians are more prone to different types of pigmentation due to our environment and lifestyle
                  </p>
                </div>
             </div>
          </div>
          <div class="large-4 medium-6 small-12 cell">
             <div class="service-box hover-wrap">
                <div class="hover-img">
                   <img src="{{ asset('assets/images/help/services/service-img-3.png')}}" alt="Service Images" />
                   <div class="service-detail hover-info">
                      <a href="#" class="button primary">Know More</a>
                   </div>
                </div>
                <div class="service-text hover-bottom">
                   <h6><a href="#">Thermage</a></h6>
                   <p>Thermage is a leading non-invasive skin tightening treatment that uses radio-frequency energy to regenerate and remodel collagen through a natural process for a smooth and toned look...</p>
                   
                  </div>
             </div>
          </div>
       </div>
       <div class="grid-container grid-x grid-padding-x grid-padding-y">
          <div class="large-4 medium-6 small-12 cell">
             <div class="service-box hover-wrap">
                <div class="hover-img">
                   <img src="{{ asset('assets/images/help/services/service-img-4.png')}}" alt="Service Images" />
                   <div class="service-detail hover-info">
                      <a href="#" class="button primary">Know More</a>
                   </div>
                </div>
                <div class="service-text hover-bottom">
                   <h6><a href="#">Laser Scar Reduction</a></h6>
                   <p>Laser treatment for skin acne scars concentrates light on the top layers of your skin to separate scar tissue. Simultaneously, the treatment supports new, sound skin cells to develop..</p>
                   
                  </div>
             </div>
          </div>
          <div class="large-4 medium-6 small-12 cell">
             <div class="service-box hover-wrap">
                <div class="hover-img">
                   <img src="{{ asset('assets/images/help/services/service-img-5.png')}}" alt="Service Images" />
                   <div class="service-detail hover-info">
                      <a href="#" class="button primary">Know More</a>
                   </div>
                </div>
                <div class="service-text hover-bottom">
                   <h6><a href="#">Vampire Facial</a></h6>
                   <p>Vampire Facial promotes healthy activity in your skin cells stimulated by your blood cells. Our blood contains various blood cells. These blood cells are separated using a special ...</p>
                   {{-- <p>separated using a special machine and growth factors are taken out. Platelets are rich in growth factors, which essentially act as energy boosters for our skin.</p> --}}
                </div>
             </div>
          </div>
          <div class="large-4 medium-6 small-12 cell">
             <div class="service-box hover-wrap">
                <div class="hover-img">
                   <img src="{{ asset('assets/images/help/services/service-img-6.png')}}" alt="Service Images" />
                   <div class="service-detail hover-info">
                      <a href="#" class="button primary">Know More</a>
                   </div>
                </div>
                <div class="service-text hover-bottom">
                   <h6><a href="#">Thread Lift</a></h6>
                   <p>Thread lift is a minimally invasive procedure that uses medical-grade sutures to pull up your sagging skin. It's a simple thirty minutes procedure and can only be done by a trained dermatologist.</p>
                   {{-- <p>These barbed threads are inserted into the layers of skin through tiny needle prick.</p> --}}
                  </div>
             </div>
          </div>
       </div>
    </div>
 </div>
 <div class="our-staff module" style="display:none;">
    <div class="section-title">
       <h2>Best Dermatologists</h2>
       <p>Meet Our Best Dermatologists</p>
    </div>
    <div class="grid-container grid-x grid-padding-x">
       <div class="large-3 medium-6 small-12 cell">
          <div class="staff-box hover-wrap">
             <div class="hover-img">
                <img src="{{ asset('assets/images/help/our-staff/staff-img-1.jpg')}}" alt="Staff Images" />
                <div class="staff-detail hover-info">
                   <a href="#" class="button primary">Know More</a>
                </div>
             </div>
             <div class="staff-text hover-bottom">
                <h6><a href="#">Dr. Robert Doe</a></h6>
                <p>Sr. Dermatologist</p>
             </div>
          </div>
       </div>
       <div class="large-3 medium-6 small-12 cell">
          <div class="staff-box hover-wrap">
             <div class="hover-img">
                <img src="{{ asset('assets/images/help/our-staff/staff-img-2.jpg')}}" alt="Staff Images" />
                <div class="staff-detail hover-info">
                   <a href="#" class="button primary">Know More</a>
                </div>
             </div>
             <div class="staff-text hover-bottom">
                <h6><a href="#">Dr. Tina Meena</a></h6>
                <p>Jr. Dermatologist</p>
             </div>
          </div>
       </div>
       <div class="large-3 medium-6 small-12 cell">
          <div class="staff-box hover-wrap">
             <div class="hover-img">
                <img src="{{ asset('assets/images/help/our-staff/staff-img-3.jpg')}}" alt="Staff Images" />
                <div class="staff-detail hover-info">
                   <a href="#" class="button primary">Know More</a>
                </div>
             </div>
             <div class="staff-text hover-bottom">
                <h6><a href="#">Dr. Seena Tina</a></h6>
                <p>Sr. Dermatologist</p>
             </div>
          </div>
       </div>
       <div class="large-3 medium-6 small-12 cell">
          <div class="staff-box hover-wrap">
             <div class="hover-img">
                <img src="{{ asset('assets/images/help/our-staff/staff-img-4.jpg')}}" alt="Staff Images" />
                <div class="staff-detail hover-info">
                   <a href="#" class="button primary">Know More</a>
                </div>
             </div>
             <div class="staff-text hover-bottom">
                <h6><a href="#">Dr. Mario Doe</a></h6>
                <p>Sr. Dermatologist</p>
             </div>
          </div>
       </div>
    </div>
 </div>
 <div class="achievement-counter dark-bg grey-bg module" >
    <div class="grid-container grid-x grid-padding-x">
       <div class="large-3 medium-6 small-12 cell">
          <div class="counter">
             <div class="counter-icon">
                <img src="{{ asset('assets/images/help/icons/chemestry.png')}}" alt="Counter Icon" />
             </div>
             <div class="counter-text">
                <h2>8000+</h2>
                <p>Cosmetic Surgeries</p>
             </div>
          </div>
       </div>
       <div class="large-3 medium-6 small-12 cell">
          <div class="counter">
             <div class="counter-icon">
                <img src="{{ asset('assets/images/help/icons/rocket.png')}}" alt="Counter Icon" />
             </div>
             <div class="counter-text">
                <h2>2500+</h2>
                <p>Hair Transplants</p>
             </div>
          </div>
       </div>
       <div class="large-3 medium-6 small-12 cell">
          <div class="counter">
             <div class="counter-icon">
                <img src="{{ asset('assets/images/help/icons/friends.png')}}" alt="Counter Icon" />
             </div>
             <div class="counter-text">
                <h2>5000+</h2>
                <p>Dermatology Specialists</p>
             </div>
          </div>
       </div>
       <div class="large-3 medium-6 small-12 cell">
          <div class="counter">
             <div class="counter-icon">
                <img src="{{ asset('assets/images/help/icons/cup.png')}}" alt="Counter Icon" />
             </div>
             <div class="counter-text">
                <h2>25+</h2>
                <p>Awards Winning</p>
             </div>
          </div>
       </div>
    </div>
 </div>
 <div class="why-chose-us module" style="display: none;">
    <div class="section-title">
       <h2>Awesome Facts</h2>
       <p>why we are best in industry</p>
    </div>
    <div class="grid-container grid-x grid-padding-x">
       <div class="large-5 medium-12 small-12 cell">
          <ul class="accordion" data-accordion data-deep-link="true" data-update-history="true" data-deep-link-smudge="500" id="deeplinked-accordion">
             <li class="accordion-item" data-accordion-item>
                <a href="#" class="accordion-title">What makes us the best dermatologist in town?</a>
                <div class="accordion-content" data-tab-content id="deeplink1">
                   Phasellus quis ex nec ex molestie tincidunt. Vimus cursus metus ac lacus comdsmo venenatis. The Aenean pulvinar ornare justo, eu efficitur leo dinga mushi.
                </div>
             </li>
             <li class="accordion-item" data-accordion-item>
                <a href="#" class="accordion-title">What makes us the best dermatologist in town?</a>
                <div class="accordion-content" data-tab-content id="deeplink2">
                   Phasellus quis ex nec ex molestie tincidunt. Vimus cursus metus ac lacus comdsmo venenatis. The Aenean pulvinar ornare justo, eu efficitur leo dinga mushi.
                </div>
             </li>
             <li class="accordion-item" data-accordion-item>
                <a href="#" class="accordion-title">What makes us the best dermatologist in town?</a>
                <div class="accordion-content" data-tab-content id="deeplink3">
                   Phasellus quis ex nec ex molestie tincidunt. Vimus cursus metus ac lacus comdsmo venenatis. The Aenean pulvinar ornare justo, eu efficitur leo dinga mushi.
                </div>
             </li>
             <li class="accordion-item is-active" data-accordion-item>
                <a href="#" class="accordion-title">What makes us the best dermatologist in town?</a>
                <div class="accordion-content" data-tab-content id="deeplink4">
                   Phasellus quis ex nec ex molestie tincidunt. Vimus cursus metus ac lacus comdsmo venenatis. The Aenean pulvinar ornare justo, eu efficitur leo dinga mushi.
                </div>
             </li>
          </ul>
       </div>
       <div class="large-7 medium-12 small-12 cell">
          <div class="after-before-item">
             <div class="twentytwenty-container">
                <img src="{{ asset('assets/images/help/before.jpg')}}" alt />
                <img src="{{ asset('assets/images/help/after.jpg')}}" alt />
             </div>
          </div>
       </div>
    </div>
 </div>
 <div class="testimonials dark-bg grey-bg" style="display: none;">
    <div class="section-title-second">
       <h2>Awesome Reviews</h2>
       <p>What our customers say about us</p>
    </div>
    <div class="grid-container grid-x grid-padding-x">
       <div class="testimonial-slid">
          <div class="testimonial-text">
             <img src="{{ asset('assets/images/help/testimonial-1.png')}}" alt />
             <p>Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry's standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book. It has survived not only five centuries, but also the leap into electronic typesetting, remaining essentially unchanged. </p>
             <h6>John Doe - <span>Google Ads</span></h6>
          </div>
          <div class="testimonial-text">
             <img src="{{ asset('assets/images/help/testimonial-2.png')}}" alt />
             <p>Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry's standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book. It has survived not only five centuries, but also the leap into electronic typesetting, remaining essentially unchanged. </p>
             <h6>John Doe - <span>Google Ads</span></h6>
          </div>
          <div class="testimonial-text">
             <img src="{{ asset('assets/images/help/testimonial-1.png')}}" alt />
             <p>Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry's standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book. It has survived not only five centuries, but also the leap into electronic typesetting, remaining essentially unchanged. </p>
             <h6>John Doe - <span>Google Ads</span></h6>
          </div>
       </div>
    </div>
 </div>
 <div class="products grey-bg module" style="display: none;">
    <div class="section-title">
       <h2>Awesome Skin care</h2>
       <p>amazing skin products for you</p>
    </div>
    <div class="grid-container grid-x grid-padding-x products-box">
       <div class="large-3 medium-6 small-12 cell">
          <div class="product">
             <div class="product-icon">
                <img src="{{ asset('assets/images/help/products/product-1.png')}}" alt="Product Img" />
             </div>
             <div class="product-text">
                <h6><a href="#">Sun Block Herbal Lotion</a></h6>
                <p>$39.00 - <span>$50.00</span></p>
             </div>
          </div>
       </div>
       <div class="large-3 medium-6 small-12 cell">
          <div class="product">
             <div class="product-icon">
                <img src="{{ asset('assets/images/help/products/product-2.png')}}" alt="Product Img" />
             </div>
             <div class="product-text">
                <h6><a href="#">Multi Vitamin Skin Product</a></h6>
                <p>$39.00 - <span>$50.00</span></p>
             </div>
          </div>
       </div>
       <div class="large-3 medium-6 small-12 cell">
          <div class="product">
             <div class="product-icon">
                <img src="{{ asset('assets/images/help/products/product-3.png')}}" alt="Product Img" />
             </div>
             <div class="product-text">
                <h6><a href="#">Whitening special Cream</a></h6>
                <p>$39.00 - <span>$50.00</span></p>
             </div>
          </div>
       </div>
       <div class="large-3 medium-6 small-12 cell">
          <div class="product">
             <div class="product-icon">
                <img src="{{ asset('assets/images/help/products/product-4.png')}}" alt="Product Img" />
             </div>
             <div class="product-text">
                <h6><a href="#">Sun Block Special Lotion</a></h6>
                <p>$39.00 - <span>$50.00</span></p>
             </div>
          </div>
       </div>
    </div>
 </div>
 <div class="blog-section module" style="display: none;">
    <div class="section-title">
       <h2>Our weekly news alert</h2>
       <p>What we wrote for you this week</p>
    </div>
    <div class="grid-container grid-x grid-padding-x">
       <div class="large-4 medium-6 small-12 cell">
          <div class="blog">
             <div class="blog-img">
                <img src="{{ asset('assets/images/help/blog/blog-img-1.jpg')}}" alt="Product Img" />
             </div>
             <div class="blog-text">
                <h6><a href="#">How you can protect your skin?</a></h6>
                <div class="meta-tags">
                   <i class="far fa-user"> <span>By:</span><a href="#">Ateeq</a></i>
                   <i class="far fa-comment"> <a href="#">3 Comments</a></i>
                </div>
                <p>There are many variations of passages of Lorem Ipsum available, but the majority have suffered some <a href="#">Read More &gt;&gt;</a></p>
             </div>
          </div>
       </div>
       <div class="large-4 medium-6 small-12 cell">
          <div class="blog">
             <div class="blog-img">
                <img src="{{ asset('assets/images/help/blog/blog-img-2.jpg')}}" alt="Product Img" />
             </div>
             <div class="blog-text">
                <h6><a href="#">How harm can be local creams?</a></h6>
                <div class="meta-tags">
                   <i class="far fa-user"> <span>By:</span><a href="#">Ateeq</a></i>
                   <i class="far fa-comment"> <a href="#">3 Comments</a></i>
                </div>
                <p>There are many variations of passages of Lorem Ipsum available, but the majority have suffered some <a href="#">Read More >></a></p>
             </div>
          </div>
       </div>
       <div class="large-4 medium-6 small-12 cell">
          <div class="blog">
             <div class="blog-img">
                <img src="{{ asset('assets/images/help/blog/blog-img-3.jpg')}}" alt="Product Img" />
             </div>
             <div class="blog-text">
                <h6><a href="#">Skin care advice for month of august.</a></h6>
                <div class="meta-tags">
                   <i class="far fa-user"> <span>By:</span><a href="#">Ateeq</a></i>
                   <i class="far fa-comment"> <a href="#">3 Comments</a></i>
                </div>
                <p>There are many variations of passages of Lorem Ipsum available, but the majority have suffered some <a href="#">Read More &gt;</a></p>
             </div>
          </div>
       </div>
    </div>
 </div>
 
 <div class="form-section module dark-bg grey-bg">
    <div class="grid-container grid-x grid-padding-x">
       <div class="large-7 medium-7 small-12 large-offset-5 medium-offset-5 cell">
          <div class="form">
             <h2>Contact Us</h2>
             <p>Want to book an appointment with us? Fill up the form below to get appointment.</p>
             @if(session('success'))
                  <div class="alert alert-success alert-dismissible fade show" role="alert">
                     {{ session('success') }}
                     <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                  </div>
               @endif

               @if(session('error'))
                  <div class="alert alert-danger alert-dismissible fade show" role="alert">
                     {{ session('error') }}
                     <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                  </div>
               @endif
             <form action="{{ route('contact.submit') }}" method="POST">
               @csrf
               <input type="text" name="name" placeholder="Full Name" required>
               <input type="email" name="email" placeholder="Email Address" required>
               <input type="text" name="phone" placeholder="Phone Number" required>
               <textarea name="message" rows="3" placeholder="Your Message here ..." required></textarea>
               <button type="submit" class="button secondary button-second">Send Message</button>
           </form>
          </div>
          <div class="clearfix"></div>
       </div>
    </div>
 </div>
 <div class="our-partners module" style="display: none">
    <div class="grid-container grid-x grid-padding-x">
       <div class="small-12 cell">
          <div class="partners">
             <div class="partners-logo">
                <a href="#"><img src="{{ asset('assets/images/help/partners/logo-1.jpg')}}" alt /></a>
             </div>
             <div class="partners-logo">
                <a href="#"><img src="{{ asset('assets/images/help/partners/logo-2.jpg')}}" alt /></a>
             </div>
             <div class="partners-logo">
                <a href="#"><img src="{{ asset('assets/images/help/partners/logo-3.jpg')}}" alt /></a>
             </div>
             <div class="partners-logo">
                <a href="#"><img src="{{ asset('assets/images/help/partners/logo-4.jpg')}}" alt /></a>
             </div>
             <div class="partners-logo">
                <a href="#"><img src="{{ asset('assets/images/help/partners/logo-5.jpg')}}" alt /></a>
             </div>
          </div>
       </div>
    </div>
 </div>
    
@endsection