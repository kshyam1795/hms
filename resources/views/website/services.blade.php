@extends('welcome')
@section('web-content')
<style>
   .service-box img{
      height: 280px!important;
   }
   .service-box .service-text {
    background-color: #ffffff;
    padding: 23px 20px;
    height: 300px;
}
.call-to-action.dark-bg:after {
    background: url(http://3.108.33.182/healthplix/public/assets/images/help/doctor-image-1.jpg) repeat fixed center center / cover;
}
</style>
<div class="title-section dark-bg">
    <div class="grid-container grid-x grid-padding-x">
       <div class="small-12 cell">
          <h1>Our Services</h1>
       </div>
       <div class="small-12 cell">
          <ul class="breadcrumbs">
             <li><a href="{{route('home')}}">Home</a></li>
             {{-- <li class="disabled">Gene Splicing</li> --}}
             <li><span class="show-for-sr">Current: </span> Services</li>
          </ul>
       </div>
    </div>
 </div>
 <div class="services ">
   <img src="{{ asset('assets/images/help/services/Centre_for_Laser_Cosmetic_Surgery_&_Dermatology.jpg')}}" alt="" srcset="" style="width:100%">
 </div>
 <div class="services grey-bg">
    <div class="padding-between services-wrap">
       <div class="grid-container grid-x grid-padding-x grid-padding-y">
          <div class="large-4 medium-6 small-12 cell">
            <div class="service-box hover-wrap">
               <div class="hover-img">
                  <img src="{{ asset('assets/images/help/services/antiagging.webp')}}" alt="Service Images" />
                  <div class="service-detail hover-info">
                     <a href="#" class="button primary">Know More</a>
                  </div>
               </div>
               <div class="service-text hover-bottom">
                  <h6><a href="#">Anti Aging</a></h6>
                  <p>Anti-Aging is a process to delay, stop or retard the aging. Our bodies are made of cells, and aging occurs when there is cell death.</p>
                  <br>
                  <p>As an infant, child, and young adults, our body’s cells are strong and can make new cells. As the years advance, our body’s ability to generate new cells diminishes, cell death occurs, and the aging process happens.</p>
               </div>
            </div>
          </div>
          <div class="large-4 medium-6 small-12 cell">
            <div class="service-box hover-wrap">
               <div class="hover-img">
                  <img src="{{ asset('assets/images/help/services/Skin-Pigmentation-Treatment.jpg')}}" alt="Service Images" />
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
                  <img src="{{ asset('assets/images/help/services/THERMAGE.jpg')}}" alt="Service Images" />
                  <div class="service-detail hover-info">
                     <a href="#" class="button primary">Know More</a>
                  </div>
               </div>
               <div class="service-text hover-bottom">
                  <h6><a href="#">Thermage</a></h6>
                  <p>Thermage is a leading non-invasive skin tightening treatment that uses radio-frequency energy to regenerate and remodel collagen through a natural process for a smooth and toned look. Approved by the US, FDA.
                  </p>
                   
                 </div>
            </div>
            
          </div>
       </div>
       <div class="grid-container grid-x grid-padding-x grid-padding-y">
          <div class="large-4 medium-6 small-12 cell">
            <div class="service-box hover-wrap">
               <div class="hover-img">
                  <img src="{{ asset('assets/images/help/services/VAMPIRE-FACIAL.jpeg')}}" alt="Service Images" />
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
                  <img src="{{ asset('assets/images/help/services/THREAD-LIFT.jpeg')}}" alt="Service Images" />
                  <div class="service-detail hover-info">
                     <a href="#" class="button primary">Know More</a>
                  </div>
               </div>
               <div class="service-text hover-bottom">
                  <h6><a href="#">Thread Lift</a></h6>
                  <p>Thread lift is a minimally invasive procedure that uses medical-grade sutures to pull up your sagging skin. It's a simple thirty minutes procedure and can only be done by a trained dermatologist.</p>
                  <p>These barbed threads are inserted into the layers of skin through tiny needle prick.</p>
                 </div>
            </div>
          </div>
          <div class="large-4 medium-6 small-12 cell">
            <div class="service-box hover-wrap">
               <div class="hover-img">
                  <img src="{{ asset('assets/images/help/services/LASER-SCAR-REMOVAL.jpeg')}}" alt="Service Images" />
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
       </div>
       <div class="grid-container grid-x grid-padding-x grid-padding-y">
          <div class="large-4 medium-6 small-12 cell">
             <div class="service-box hover-wrap">
                <div class="hover-img">
                   <img src="assets/images/help/services/DERMAL-FILLERS.jpeg" alt="Service Images" />
                   <div class="service-detail hover-info">
                      <a href="#" class="button primary">Know More</a>
                   </div>
                </div>
                <div class="service-text hover-bottom">
                   <h6><a href="#">DERMAL FILLERS</a></h6>
                   <p>Dermal fillers are gel-like substances that are infused underneath the skin to re-
                     establish lost volume, smooth lines, and mellow wrinkles, or upgrade facial shapes.</p>
                  <p>More than 1 million people every year have picked this mainstream facial revival
                     treatment, which can be a financially savvy approach to look more youthful without
                     medical procedures or personal time.</p>
                </div>
             </div>
          </div>
          <div class="large-4 medium-6 small-12 cell">
             <div class="service-box hover-wrap">
                <div class="hover-img">
                   <img src="assets/images/help/services/UNDER-EYE-TREATMENTS.jpeg" alt="Service Images" />
                   <div class="service-detail hover-info">
                      <a href="#" class="button primary">Know More</a>
                   </div>
                </div>
                <div class="service-text hover-bottom">
                   <h6><a href="#">UNDER EYE TREATMENTS.</a></h6>
                   <p>SISD offers advanced under eye treatments under care of top dermatologists.
                     Under eye laser, Under eye wrinkle and pigmentation fillers, crow&#39;s feet treatment all are
                     available at our Institutes in New Delhi.</p>
                  <p>Our dermatologist can detect the cause of under eye puffiness and dark circles
                     and design your treatment with 360 degree approach.</p>
                </div>
             </div>
          </div>
          <div class="large-4 medium-6 small-12 cell">
             <div class="service-box hover-wrap">
                <div class="hover-img">
                   <img src="assets/images/help/services/LASER-HAIR-REMOVAL.avif" alt="Service Images" />
                   <div class="service-detail hover-info">
                      <a href="#" class="button primary">Know More</a>
                   </div>
                </div>
                <div class="service-text hover-bottom">
                   <h6><a href="#">LASER HAIR REMOVAL</a></h6>
                   <p>Laser Hair Removal at Skin Institute and School Of Dermatology (SISD), is most
                     efficient and cost-effective. Its the most painless way to get rid of unwanted hair for a
                     lifetime.</p>
                  <p>The laser is actually a laser hair reduction and not removal. So you get rid of
                     most of the hair but 100% hair will go is not true. Some hairs especially hormone-
                     dependent hair may remain.</p>

                </div>
             </div>
          </div>
       </div>
       <div class="grid-container grid-x grid-padding-x grid-padding-y">
         <div class="large-4 medium-6 small-12 cell">
            <div class="service-box hover-wrap">
               <div class="hover-img">
                  <img src="assets/images/help/services/MOLE-REMOVAL.jpeg" alt="Service Images" />
                  <div class="service-detail hover-info">
                     <a href="#" class="button primary">Know More</a>
                  </div>
               </div>
               <div class="service-text hover-bottom">
                  <h6><a href="#">MOLE REMOVAL</a></h6>
                  <p>Moles occur when cells in the skin grow in a cluster instead of being spread
                     throughout the skin. They make the pigment that gives skin its natural color .</p>
                 <p>Moles are growths on the skin that are usually brown or black. Moles can appear
                  anywhere on the skin.</p>
               </div>
            </div>
         </div>
         <div class="large-4 medium-6 small-12 cell">
            <div class="service-box hover-wrap">
               <div class="hover-img">
                  <img src="assets/images/help/services/GFC-FOR-HAIR-LOSS.jpeg" alt="Service Images" />
                  <div class="service-detail hover-info">
                     <a href="#" class="button primary">Know More</a>
                  </div>
               </div>
               <div class="service-text hover-bottom">
                  <h6><a href="#">GFC FOR HAIR LOSS</a></h6>
                  <p>Skin Institute and School Of Dermatology (SISD), recently introduced Growth
                     factor concentrate (MGFC) treatment to fight hair loss. MGFC is the latest and most
                     advanced treatment to treat early hair loss in patients.</p>
                 <p>The world is doing old platelet treatments for hair loss until now growth factor
                  concentrate will soon take over all old treatments in India and the world.</p>
               </div>
            </div>
         </div>
         <div class="large-4 medium-6 small-12 cell">
            <div class="service-box hover-wrap">
               <div class="hover-img">
                  <img src="assets/images/help/services/wart-removal.jpg" alt="Service Images" />
                  <div class="service-detail hover-info">
                     <a href="#" class="button primary">Know More</a>
                  </div>
               </div>
               <div class="service-text hover-bottom">
                  <h6><a href="#">WART REMOVAL</a></h6>
                  <p>Warts are actually an infection in the top layer of skin, caused by viruses in the
                     human papillomavirus, or HPV, family.</p>
                 <p>When the virus invades this outer layer of skin, usually through a tiny scratch, it
                  causes rapid growth of cells on the outer layer of skin – creating the wart.</p>
                    
               </div>
            </div>
         </div>
      </div>
    </div>
 </div>
@endsection