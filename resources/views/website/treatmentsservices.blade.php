@extends('welcome')
@section('web-content')
<style>
   .service-box img {
      height: 280px !important;
      object-fit: cover;
      border-radius: 10px;
   }
   .service-box .service-text {
      background-color: #ffffff;
      padding: 20px;
      height: auto;
      border-radius: 10px;
      box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
   }
   .call-to-action.dark-bg:after {
      background: url('http://3.108.33.182/healthplix/public/assets/images/help/doctor-image-1.jpg') no-repeat center center / cover;
      opacity: 0.8;
   }
   .services {
      padding: 50px 0;
   }
    .services h2 {
      text-align: center;
      font-size: 2rem;
      font-weight: bold;
      margin-bottom: 30px;
   }
   .service-category {
      font-size: 1.5rem;
      font-weight: bold;
      text-transform: uppercase;
      border-bottom: 2px solid #000000;
      display: inline-block;
      margin-bottom: 15px;
   }
   .service-item  {
      background: #fff;
      padding: 20px;
      margin-bottom: 20px;
      border-radius: 8px;
      box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
   }
   .service-item strong {
      color: #000000;
      text-transform:capitalize; 
   } 
   /* .breadcrumbs {
      display: flex;
      gap: 5px;
   }
   .breadcrumbs li {
      list-style: none;
   } */ 
</style>

<div class="title-section dark-bg">
    <div class="grid-container grid-x grid-padding-x">
       <div class="small-12 cell text-center">
          <h1>Treatments & Services</h1>
          <ul class="breadcrumbs">
             <li><a href="{{route('home')}}">Home</a></li>
             <li><span class="show-for-sr">Current: </span> Treatments & Services</li>
          </ul>
       </div>
    </div>
</div>

<div class="services grey-bg">
    <div class="grid-container">
       <div class="grid-x grid-padding-x grid-padding-y">
          <div class="large-12 cell">
            
            
            <div class="service-item">
                <p class="service-category">Skin Diseases</p>
                <p><strong>PIGMENTATION TREATMENT:</strong> Pigmentation is one of the most difficult treatments and diseases in Asian Skin. Our Indian skin is especially more prone to different types of pigmentation due to our environment and lifestyle.</p>
            </div>

            <div class="service-item">
                <p class="service-category">Surgeries</p>
                <p><strong>MICRO-NEEDLING:</strong> Micro-needling or Collagen Induction Treatment is a minimally invasive procedure that encourages collagen production using tiny, sterilised needles. Micro-needling helps to reduce the appearance of scars, dark spots, wrinkles and large pores. You may need multiple sessions for the best results.</p>
                <p><strong>MOLE  REMOVAL:</strong> Moles occur when pigment-forming cells called melanocytes grow in a cluster instead of spreading throughout the skin. Moles are growths on the skin that are usually brown or black. They make the pigment that gives skin its natural colour. Moles can appear anywhere on the skin. Moles can be removed by laser or by surgical excision.</p>
                <p><strong>VAMPIRE FACIAL:</strong> Vampire Facial promotes healthy activity in your skin cells stimulated by your blood cells. Our blood contains various blood cells. These blood cells are separated using a special machine and growth factors are removed. Platelets are rich in growth factors, which essentially act as energy boosters for our skin.</p>
                <p><strong>HAIR GROWTH TREATMENTS -  GFC FOR HAIR LOSS:</strong> At Skin Institute and School Of Dermatology (SISD), we use Growth factor concentrate (GFC) which is an advanced version of platelet-rich plasma to treat hair loss. GFC is the latest and most advanced treatment to treat early hair loss in patients. The world is doing old platelet treatments for hair loss until now growth factor concentrate will soon take over all old treatments in India and the world. The benefits of this treatment are it increases blood supply to the hair follicles, Maintains the viability of hair follicles, Decreases hair loss and controls hair fall effectively, and Strengthens inactive hair follicles.</p>
            
            </div>

            <div class="service-item">
                <p class="service-category">Laser Services & Treatments</p>
                <p><strong>LASER SCAR REDUCTION:</strong> 
                    Laser treatment for skin acne scars concentrates light on the top layers of your skin to separate scar tissue. Simultaneously, the treatment supports new, sound skin cells to develop and supplant the scar tissue. Carbon dioxide laser is the gold standard treatment for acne scars. Fractional CO2 laser helps to reduce acne scarring by stimulating collagen that helps tighten and smooth out the scars.  The treatment supports new, sound skin cells to develop and supplant the scar tissue.  All scars will not go but you will see a dramatic improvement in the pits and scars.
                </p>
                <p><strong>WART REMOVAL:</strong> 
                    Warts are an infection in the top layer of skin, caused by viruses in the human papillomavirus, or HPV, family. When the virus invades this outer layer of skin, usually through a tiny scratch, it causes rapid growth of cells on the outer layer of skin – creating the wart. Treatment options include electrocautery, radiofrequency, CO2 laser, chemical cautery and immunotherapy.
                </p>
                <p><strong>SKIN TAG REMOVAL:</strong> 
                    Skin Tags or Acrochordons are commonly acquired benign skin-colored growths. They usually occur on eyelids, neck, underarms and groin. They can be removed by electro-cautery or  CO2 laser.
                </p>
                <p><strong>LASER TATTOO REMOVAL:</strong> 
                    Q-switch Nd-Yag laser is a revolutionary technology widely used for tattoo removal. The laser energy targets and breaks down the tattoo ink particles, gradually fading the tattoo over multiple sessions. While treatment is generally safe, there can be swelling, temporary redness and discomfort at the treatment site.
                </p>
                <p><strong>LASER HAIR REMOVAL :</strong> 
                    Laser Hair Removal at the Skin Institute and School Of Dermatology (SISD), is the most efficient and cost-effective. We use the Lumenis Splendor X laser hair removal system. It is the most comprehensive, FDA-approved laser hair removal system.  It's the most painless way to get rid of unwanted hair for a lifetime. The laser is a laser hair reduction and not removal. So you get rid of most of the hair but 100% hair will go is not true. Some hairs, especially hormone-dependent hair may remain and may require more sessions.
                </p>
                 
            </div>

            <div class="service-item">
                <p class="service-category">Skin Treatments</p>
                <p><strong>UNDER EYE TREATMENTS:</strong> SISD offers advanced eye treatments under the care of top dermatologists. Under eye peel, laser, under eye fillers and crow's feet treatment are available at our Institutes in New Delhi. Our dermatologist can detect the cause of under-eye puffiness and dark circles and design your treatment with a 360-degree approach.</p>
                <p><strong>ANTI-AGEING :</strong> Anti-Ageing is a process to delay, stop or retard ageing. Our bodies are made of cells, and ageing occurs when there is cell death. As an infant, children, and young adults, our body’s cells are strong and can make new cells. As the years advance, our body’s ability to generate new cells diminishes, cell death occurs, and the ageing process happens.</p>
                <p><strong>THERMAGE:</strong> Thermage is a leading non-invasive skin tightening treatment that uses radio-frequency energy to regenerate and remodel collagen through a natural process for a smooth and toned look. Approved by the US, FDA.</p>
                <p><strong>HYDRA FACIAL:</strong> Unlike the ordinary facial, hydra facial is a medical-grade facial with the following benefits, offering longer-lasting results, and nourishing the skin deep within and it's done in the clinical environment under the supervision of an expert.</p>
                
            </div>
            <div class="service-item">
                <p class="service-category">Aesthetic Treatments</p>
                <p><strong>THREAD LIFT:</strong> Thread lift is a minimally invasive procedure that uses medical-grade sutures to pull up your sagging skin. It's a simple thirty-minute procedure and can only be done by a trained dermatologist. These barbed threads are inserted into the layers of skin through tiny needle pricks.</p>
                <p><strong>DERMAL FILLERS:</strong> Dermal fillers are gel-like substances that are infused underneath the skin to re-establish lost volume, smooth lines, and mellow wrinkles, or upgrade facial shapes. More than 1 million people every year have picked this mainstream facial revival treatment, which can be a financially savvy approach to looking more youthful without medical procedures or personal time.</p>
                <p><strong>SCALP MICROPIGMENTATION:</strong>It is a safe, non-surgical procedure that helps you conceal your bald spots and makes your hair look fuller. A thin needle is used to deposit tiny dots of pigment on the scalp. Usually, 2-3 sessions are required to achieve the perfect look.  </p>
                <p><strong>EYEBROW MICROBLADING & POWDER BROWS:</strong> Microblading uses a blade-shaped tool with a row of tiny needles to create hair-like strokes along your brows. The powder technique fills in sparse areas creating a soft, powdery finish that complements the client’s facial features. </p>
            </div>
          </div>
       </div>
    </div>
</div>
@endsection
