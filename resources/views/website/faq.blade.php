@extends('welcome') @section('web-content')
<div class="title-section dark-bg module">
    <div class="grid-container grid-x grid-padding-x">
        <div class="small-12 cell">
            <h1>FRQUENTLY ASKED QUESTIONS</h1>
        </div>
        <div class="small-12 cell">
            <ul class="breadcrumbs">
                <li><a href="{{route('home')}}">Home</a></li>
                {{--
                <li class="disabled">Gene Splicing</li> --}}
                <li><span class="show-for-sr">Current: </span> FAQS</li>
            </ul>
        </div>
    </div>
</div>
<div class="why-chose-us module">
    
    <div class="grid-container grid-x grid-padding-x">
        
        <div class="large-12 medium-12 small-12 cell">
            <ul class="accordion" data-accordion data-deep-link="true" data-update-history="true" data-deep-link-smudge="500" id="deeplinked-accordion">
                <li class="accordion-item is-active" data-accordion-item>
                    <a href="#" class="accordion-title">Who is a Dermatologist?</a>
                    <div class="accordion-content" data-tab-content id="deeplink1">
                     A dermatologist is a doctor who specializes in the care of the skin, hair, and nails. They are experts in diagnosing and treating diseases related to these areas and can address various skin disorders, including hair loss and nail issues. The skin is
                     the largest organ in the body and serves many important functions, such as protecting you from heat, cold, germs, infections, and harmful radiation. It acts as an important indicator of overall health; changes in colour or texture may signal
                     an underlying medical problem. Proper care of your skin, hair, and nails is essential, and consulting a dermatologist can help with any underlying issues.
                 
                    </div>
                </li>
                <li class="accordion-item   " data-accordion-item>
                    <a href="#" class="accordion-title">What does a Dermatologist do?</a>
                    <div class="accordion-content" data-tab-content id="deeplink2">
                     Dermatologists are medical doctors who specialize in diagnosing and treating conditions affecting the skin, hair, and nails. They can recognize symptoms that may appear on the skin and indicate problems within the body, such as organ diseases or cancer.
                     Based on their examination, dermatologists provide treatment options, which may include medical, surgical, or laser therapies for various systemic disorders and conditions.
                    </div>
                </li>
                <li class="accordion-item" data-accordion-item>
                    <a href="#" class="accordion-title">What conditions can a dermatologist treat?</a>
                    <div class="accordion-content" data-tab-content id="deeplink3">
                     <p>
                        Dermatologists can treat a wide range of skin, hair, and nail-related conditions. These include:
                    </p>
                    <p>
                        - Leprosy
                    </p>
                    <p>
                        - Vitiligo
                    </p>
                    <p>
                        - Leucoderma
                    </p>
                    <p>
                        - Melasma
                    </p>
                    <p>
                        - Acne and Rosacea (hypo/hyperpigmentation)
                    </p>
                    <p>
                        - Psoriasis
                    </p>
                    <p>
                        - Lichen planus
                    </p>
                    <p>
                        - Seborrheic dermatitis
                    </p>
                    <p>
                        - Photodermatitis
                    </p>
                    <p>
                        - Allergic skin disorders
                    </p>
                    <p>
                        - Pemphigus
                    </p>
                    <p>
                        - Bullous Pemphigoid
                    </p>
                    <p>
                        - Allergic contact dermatitis
                    </p>
                    <p>
                        - Cutaneous drug reactions
                    </p>
                    <p>
                        - Scabies
                    </p>
                    <p>
                        - Nail diseases (such as paronychia, onychomycosis, dystrophy)
                    </p>
                    <p>
                        - Bacterial, fungal, and viral skin diseases
                    </p>
                    <p>
                        - Warts and papillomas
                    </p>
                    <p>
                        - Epithelioma
                    </p>
                    <p>
                        - Hair loss (including alopecia and male pattern baldness)
                    </p>
                    <p>
                        - Sexually transmitted diseases (STDs)
                    </p>
                    <p>
                        - Autoimmune skin disorders (such as lupus erythematosus)
                    </p>
                    <p>
                        - Rashes
                    </p>
                    <p>
                        - Melanoma
                    </p>
                    <p>
                        - Cancerous growths
                    </p>
                    <p>
                        - Unwanted warts or moles
                    </p>
                    <p>
                        - Birthmarks
                    </p>
                    <p>
                        - Vein procedures
                    </p>
                    <p>
            
                    </p>
                    </div>
                </li>
                <li class="accordion-item" data-accordion-item>
                    <a href="#" class="accordion-title">When should I consult a dermatologist?</a>
                    <div class="accordion-content" data-tab-content id="deeplink4">
                     <p>
                        You should consult a dermatologist if you experience any of the following symptoms or conditions:
                    </p>
                    <p>
                        - A patch of skin or a mole that has changed in size, colour, or shape
                    </p>
                    <p>
                        - Vitiligo
                    </p>
                    <p>
                        - Skin cancer
                    </p>
                    <p>
                        - Severe, persistent, or uncontrollable acne
                    </p>
                    <p>
                        - Rashes
                    </p>
                    <p>
                        - Hives
                    </p>
                    <p>
                        - Scars
                    </p>
                    <p>
                        - Eczema
                    </p>
                    <p>
                        - Psoriasis
                    </p>
                    <p>
                        - Rosacea
                    </p>
                    <p>
                        - Dark spots on your face (hyperpigmentation)
                    </p>
                    <p>
                        - Long-lasting skin irritation or burning
                    </p>
                    <p>
                        - Skin infections
                    </p>
                    <p>
                        - Warts
                    </p>
                    <p>
                        - Unusual hair loss
                    </p>
                    <p>
                        - Nail disorders, such as ingrown nails or nail fungus
                    </p>
                    <p>
                        - Varicose and spider veins
                    </p>
                    <p>
                        - Itchy, red, flaky, cracked, dry, or scaly skin
                    </p>
                    <p>
                        - Signs of ageing, such as wrinkles and freckles
                    </p>
                    <p>
            
                    </p>
                  </div>
                </li>
                <li class="accordion-item" data-accordion-item>
                  <a href="#" class="accordion-title">How do they diagnose diseases?</a>
                  <div class="accordion-content" data-tab-content id="deeplink1">
                     <p>
                        Our doctors diagnose diseases using the following methods:
                    </p>
                    <ol>
                        <li>
                            <strong>Diagnosis: </strong>Dermatologists examine patients through laboratory tests and microscopic examinations to assess conditions. Laboratory investigations are available at affordable rates in our hospital. They typically recommend
                            the following laboratory tests first depending on your medical condition and symptoms:
                        </li>
                    </ol>
                    <p>
            
                    </p>
                    <ul>
                        <li>
                            <span>       </span> Complete Blood Count (CBC)
                        </li>
                        <li>
                            <span>       </span> Liver Function Test
                        </li>
                        <li>
                            <span>       </span> Lipid Profile
                        </li>
                        <li>
                            <span>       </span> Thyroid Test
                        </li>
                        <li>
                            <span>       </span> Blood Sugar Test
                        </li>
                        <li>
                            <span>       </span> HbA1c
                        </li>
                        <li>
                            <span>       </span> Vitamin D
                        </li>
                        <li>
                            <span>       </span> Vitamin B12
                        </li>
                        <li>
                            <span>       </span>HBsAg
                        </li>
                        <li>
                            <span>       </span>HCV
                        </li>
                        <li>
                            <span>       </span>HIV
                        </li>
                        <li>
                            <span>       </span>VDRL
                        </li>
                        <li>
                            <span>       </span>TPHA
                        </li>
                        <li>
                            <span>       </span>Pus and Urine Culture
                        </li>
                        <li>
                            <span>       </span>Gram Stain
                        </li>
                        <li>
                            <span>       </span>IgE
                        </li>
                        <li>
                            <span>       </span>Skin Biopsy
                        </li>
                        <li>
                            <span>       </span>Scraping for Fungal Infections
                        </li>
                        <li>
                            <span>       </span>Slit Smear for AFB
                        </li>
                        <li>
                            <span>       </span>Tzanck Smear
                        </li>
                        <li>
                            <span>       </span>Wood Lamp Examination
                        </li>
                        <li>
                            <span>       </span>Allergy Skin Tests
                        </li>
                    </ul>
                    <p>
            
                    </p>
                    <p>
            
                    </p>
                    <ol start="2">
                        <li>
                            <strong>Treatment:</strong> Dermatologists treat conditions with medications, procedures, or a combination of both. Treatment options include:
                        </li>
                    </ol>
                    <ul>
                        <li>
                            <span>       </span> Topical or injected medications
                        </li>
                        <li>
                            <span>       </span> Ultraviolet (UV) light therapy
                        </li>
                        <li>
                            <span>       </span> Surgical procedures, such as mole removal and skin biopsies
                        </li>
                        <li>
                            <span>       </span> Cosmetic procedures, including chemical peels, laser treatments, dermabrasion, micro-needling, and vitiligo treatment
                        </li>
                    </ul>
                    <p>
            
                    </p>
                    <ol start="3">
                        <li>
                            <strong>Dermatology Surgeries:</strong> Our experienced doctors perform various surgeries, such as:
                        </li>
                    </ol>
                    <p>
            
                    </p>
                    <ul>
                        <li>
                            <span>       </span> Scar resurfacing (post-acne, post-chickenpox scars)
                        </li>
                        <li>
                            <span>       </span> Cyst and abscess removal
                        </li>
                        <li>
                            <span>       </span> Keloid treatment
                        </li>
                        <li>
                            <span>       </span> Earlobe surgery
                        </li>
                        <li>
                            <span>       </span> Mole removal
                        </li>
                        <li>
                            <span>       </span> Tattoo removal
                        </li>
                        <li>
                            <span>       </span> Nail surgery
                        </li>
                        <li>
                            <span>       </span> Radiofrequency therapy
                        </li>
                        <li>
                            <span>       </span> Removal of corns, warts, and callosities
                        </li>
                        <li>
                            <span>       </span> Microdermabrasion
                        </li>
                        <li>
                            <span>       </span> Treatment of minor gangrene
                        </li>
                    </ul>
                    <p>
            
                    </p>
                    <p>
                        <strong>      </strong>4<strong>. Cosmetic Concerns:</strong> Dermatologists also address cosmetic disorders, including hair loss, male pattern baldness, anti-ageing treatments, scars, acne, moles, warts, and wrinkles.
                    </p>
                    <p>
            
                    </p>
                    <p>
                        <strong><u>Cosmetic Therapy: </u></strong><u> </u><u>Treatments for cosmetic concerns include:</u>
                    </p>
                    <p>
            
                    </p>
                    <ul>
                        <li>
                            <span>      </span> Hydrafacial
                        </li>
                        <li>
                            <span>      </span> Microdermabrasion
                        </li>
                        <li>
                            <span>      </span> Microneedling
                        </li>
                        <li>
                            <span>      </span> Laser treatments
                        </li>
                        <li>
                            <span>      </span> Chemical peels
                        </li>
                        <li>
                            <span>      </span> Skin boosters
                        </li>
                        <li>
                            <span>      </span> Botox therapy
                        </li>
                        <li>
                            <span>      </span> Fillers
                        </li>
                        <li>
                            <span>      </span> Plasma-rich platelet Therapy (PRP)
                        </li>
                        <li>
                            <span>      </span> Thread lifting
                        </li>
                        <li>
                            <span>      </span> Lumiere Marine treatment (for pigmentation)
                        </li>
                        <li>
                            <span>      </span> Hyalu Pro Collagen treatment (for anti-ageing)
                        </li>
                    </ul>
                    <p>
            
                    </p>
                    <p>
                        This comprehensive approach ensures patients receive the highest quality of care for both medical and cosmetic dermatological needs.
                    </p> 
                  
                  </div>
               </li>
               <li class="accordion-item   " data-accordion-item>
                     <a href="#" class="accordion-title">How to Differentiate Skin Problems?</a>
                     <div class="accordion-content" data-tab-content id="deeplink2">
                        <p>
                           Some common skin problems include:
                       </p>
                       <p>
                           <strong> </strong>
                       </p>
                       <p>
                           <strong>A) Acne </strong>- Acne is a prevalent skin condition characterized by pimples, primarily on the face, caused by clogged pores.
                       </p>
                       <p>
                           <strong>B) Eczema</strong> - Eczema results in dry, itchy patches on the skin. It is non-contagious but quite common.
                       </p>
                       <p>
                           <strong>C) Hair Loss</strong> - This issue can arise from hormonal changes, stress, ageing, and genetic factors, disrupting the hair growth cycle and leading to increased hair loss without new strands replacing them.
                       </p>
                       <p>
                           <strong>D) Nail Fungus -</strong> Toenail fungus can cause your nails to thicken, turn yellow, and display white spots or streaks.
                       </p>
                       <p>
                           <strong>E) Psoriasis </strong>- Psoriasis is an autoimmune condition that leads to itchiness and discomfort. The most common type is plaque psoriasis, which creates thick, scaly patches on the skin.
                       </p>
                       <p>
                           <strong>F) Skin Cancer</strong> - Skin cancer develops due to exposure to ultraviolet rays. Symptoms include new bumps or patches on the skin or changes in existing growths. Most skin cancers are treatable if diagnosed early, with options
                           including medical surgery, cryotherapy, chemotherapy, and radiation therapy.
                       </p>
                       <p>
                           <strong>G) Rosacea - </strong>This skin condition results in facial redness, typically affecting the nose, cheeks, and forehead.
                       </p>
                       <p>
                           <strong>H) Leprosy </strong>- Leprosy is a chronic infectious disease caused by the bacterium <strong>Mycobacterium leprae</strong>. It primarily affects the skin and peripheral nerves, and if untreated, it can lead to progressive disabilities.
                       </p>
                     </div>
               </li>
               <li class="accordion-item" data-accordion-item>
                     <a href="#" class="accordion-title">Why is my skin so dry?</a>
                     <div class="accordion-content" data-tab-content id="deeplink3">
                        <p>
                           Dry skin is a common issue often caused by factors like cold weather, harsh skin products, and frequent washing. It occurs when the skin loses its natural moisture. While the skin produces oil to maintain hydration, using harsh soaps or washing too often
                           can deplete this moisture. We offer various moisturizers tailored to different skin types. If left untreated, dry skin can lead to inflammation or dermatitis, so it's advisable to consult a dermatologist before it worsens.
                       </p>
                     </div>
               </li>
               <li class="accordion-item" data-accordion-item>
                     <a href="#" class="accordion-title">How to Choose the Right Skin Products?</a>
                     <div class="accordion-content" data-tab-content id="deeplink4">
                        <p>
                           Understanding your skin type is crucial when selecting the right products. Here are some tips:
                       </p>
                       <p>
               
                       </p>
                       <ol>
                           <li>
                               <strong>Oily Skin</strong>: Look for non-comedogenic products that do not clog pores. Gel-based cleansers and lightweight moisturizers are ideal.
                           </li>
                           <li>
                               <strong>Dry Skin</strong>: Cream-based cleansers and rich moisturizers are beneficial. Ingredients like ceramides help restore the skin barrier.
                           </li>
                           <li>
                               <strong>Combination Skin:</strong> A balanced approach is essential. Use gel cleansers on oily areas and creamy moisturizers for dry patches.
                           <br></li>
                       </ol>
                     </div>
               </li>
               <li class="accordion-item" data-accordion-item>
                     <a href="#" class="accordion-title">What Is the Importance of Sunscreen?</a>
                     <div class="accordion-content" data-tab-content id="deeplink1">
                        <p>
                           Sunscreen is an essential part of any skincare routine, regardless of age or ethnicity. It protects against sun damage, which can lead to premature ageing and increases the risk of skin cancer.
                       </p>
                     </div>
               </li>
               <li class="accordion-item   " data-accordion-item>
                     <a href="#" class="accordion-title">How to Select the Right Sunscreen?</a>
                     <div class="accordion-content" data-tab-content id="deeplink2">
                        <p>
                           When choosing a sunscreen, consider the following:
                       </p>
                       <ul>
                           <li>
                               <span>       </span>Skin Protection: Ensure it protects against both UVA and UVB rays.
                           </li>
                           <li>
                               <span>       </span>SPF Level: A minimum SPF of 30 is recommended for daily use.
                           </li>
                           <li>
                               <span>       </span>Water Resistance: If you plan to swim or sweat, opt for water-resistant formulas.
                           </li>
                       </ul>
                     </div>
               </li>
               <li class="accordion-item" data-accordion-item>
                     <a href="#" class="accordion-title">What Type of Skin Infection Causes Rashes?</a>
                     <div class="accordion-content" data-tab-content id="deeplink3">
                        <p>
                           Four types of skin infections can cause rashes: bacterial, viral, fungal, and parasitic. If you experience widespread, painful, blistering rashes, or have a fever, seek medical attention promptly. A dermatologist can diagnose the type of rash and provide
                           appropriate treatment.
                       </p>
                     </div>
               </li>
               <li class="accordion-item" data-accordion-item>
                     <a href="#" class="accordion-title">What should I do for my rashes?</a>
                     <div class="accordion-content" data-tab-content id="deeplink4">
                        <p>
                           Rashes are often caused by environmental factors or allergies. Many skin rashes are simple irritations that typically resolve on their own within 2 to 3 weeks. If your rash does not improve or worsens, it's essential to consult a dermatologist. Conditions
                           like eczema, contact dermatitis, or atopic dermatitis are non-contagious rashes. Monitor your skin, and see a dermatologist to learn how to manage symptoms if they worsen.
                       </p>
                     </div>
               </li> 
               <li class="accordion-item" data-accordion-item>
                  <a href="#" class="accordion-title">What can I do about hair loss?</a>
                  <div class="accordion-content" data-tab-content id="deeplink1">
                     <p>
                        Thinning hair, a receding hairline, or hereditary hair loss are common issues many people face. Platelet-rich plasma (PRP) therapy can help by increasing blood flow to hair follicles and encouraging new growth. PRP therapy carries minimal risks, and results
                        may vary based on your age and gender. However, men may take a longer time to see results.
                    </p>
                  </div>
              </li>
              <li class="accordion-item   " data-accordion-item>
                  <a href="#" class="accordion-title"> What are wrinkle treatments and fillers?</a>
                  <div class="accordion-content" data-tab-content id="deeplink2">
                     <p>
                        Wrinkle treatments reduce the appearance of fine lines and wrinkles by temporarily paralyzing targeted muscles. In contrast, fillers are used to add volume to areas that have lost collagen and elastin. Both treatments may have potential side effects,
                        so following post-treatment care as advised by your dermatologist is important.
                    </p>
                  </div>
              </li>
              <li class="accordion-item" data-accordion-item>
                  <a href="#" class="accordion-title">What foods should I eat more of?</a>
                  <div class="accordion-content" data-tab-content id="deeplink3">
                     <p>
                        Certain types of food are beneficial for your skin. Nutrient-rich foods that are low in saturated fat can provide essential vitamins to help your skin thrive. Maintaining a well-balanced diet and drinking plenty of water will contribute to healthier,
                        blemish-free skin. You can ask your dermatologist for a list of recommended foods to incorporate into your diet.
                    </p>
                  </div>
              </li>
              <li class="accordion-item" data-accordion-item>
                  <a href="#" class="accordion-title">What foods should I avoid?</a>
                  <div class="accordion-content" data-tab-content id="deeplink4">
                     <p>
                        Processed foods are generally harmful to your overall health and can negatively impact your skin as well. These foods typically have very little nutritional value. If you’re unsure about which foods to avoid, consult your dermatologist. This will help
                        you maintain a balanced diet, prevent breakouts, and achieve a healthier glow.
                    </p>
                  </div>
              </li>
              <li class="accordion-item" data-accordion-item>
                <a href="#" class="accordion-title">Can I use home treatments alongside those provided by my dermatologist?</a>
                <div class="accordion-content" data-tab-content id="deeplink1">
                  <p>
                     It’s important to check with your dermatologist before combining home treatments with their recommendations. Certain products may interact negatively, potentially worsening your skin condition. Always inform your dermatologist about any products you are
                     currently using to ensure compatibility and avoid complications.
                 </p>
                </div>
             </li>
             <li class="accordion-item   " data-accordion-item>
                   <a href="#" class="accordion-title">Why do I sweat so much?</a>
                   <div class="accordion-content" data-tab-content id="deeplink2">
                     <p>
                        Sweating is a normal bodily function that helps regulate temperature. However, some individuals have overactive sweat glands, leading to excessive sweating, particularly in areas like the hands, feet, and underarms. This condition, known as hyperhidrosis,
                        can be embarrassing, resulting in soaked clothing or socks. While excessive sweating is not a serious medical issue, there are treatments available, such as Botox. This injectable treatment blocks nerve signals to the sweat glands, reducing
                        perspiration. The effects typically last between 9 to 12 months.
                    </p>
                   </div>
             </li>
             <li class="accordion-item" data-accordion-item>
                   <a href="#" class="accordion-title">What do you recommend for anti-ageing?</a>
                   <div class="accordion-content" data-tab-content id="deeplink3">
                     <p>
                        Anti-ageing treatments encompass a range of options, including medical-grade skincare products and injectables that relax facial muscles. What works best varies among individuals based on factors such as age, medical history, lifestyle, and desired results.
                        To combat the signs of ageing, including dead skin cell exfoliation and collagen boosting, we recommend a tailored skincare regimen. Treatments may include:
                    </p>
                    <p>
                        <strong>1. Aesthetic procedures</strong> like facials, derma-planing, and micro-dermabrasion to remove dead skin cells and refresh the skin.
                    </p>
                    <p>
                        <strong>2. Injectable treatments,</strong> such as neurotoxins, which relax your muscles and reduce fine lines and wrinkles, along with fillers that add volume to the skin.
                    </p>
                    <p>
                        Results from these treatments may appear within weeks but are not permanent and will require follow-up treatments to maintain efficacy.
                    </p>
                   </div>
             </li>
             <li class="accordion-item" data-accordion-item>
                   <a href="#" class="accordion-title">How often should I see a dermatologist if I have a specific skin condition or a disease?</a>
                   <div class="accordion-content" data-tab-content id="deeplink4">
                     <p>
                        The frequency of visits to a dermatologist depends on individual skin concerns. Those with chronic conditions might require more frequent appointments and follow-ups. It is essential to follow your treatment plan and monitor how your body responds to
                        prescribed medications.
                    </p>
                   </div>
             </li>
             <li class="accordion-item" data-accordion-item>
                   <a href="#" class="accordion-title">What is required for an effective skincare routine?</a>
                   <div class="accordion-content" data-tab-content id="deeplink1">
                     <p>
                        Regardless of your skin type be it oily, dry, or a combination of both dry and oily, a solid skincare routine is required which includes sunscreen with at least SPF 30. <strong>Follow these steps for optimal care:</strong>
                    </p>
                    <p>
                        1. Cleanse your skin thoroughly at least twice a day to remove impurities.
                    </p>
                    <p>
                        2. Moisturize to maintain hydration.
                    </p>
                    <p>
                        3. Apply sunscreen daily before sun exposure.
                    </p>
                    <p>
                        4. Choose products suited to your specific skin type if oily, dry or a combination of both.
                    </p>
                   </div>
             </li>
             <li class="accordion-item   " data-accordion-item>
                   <a href="#" class="accordion-title"> When should I apply sunscreen?</a>
                   <div class="accordion-content" data-tab-content id="deeplink2">
                     <p>
                        Apply sunscreen every day of the year, regardless of weather conditions. UV rays can harm your skin even on cloudy or rainy days. Use sunscreen with at least SPF 30 for protection against UVA and UVB rays. If you need guidance on which sunscreen to use,
                        consult your dermatologist for recommendations.
                    </p>
                   </div>
             </li>
             <li class="accordion-item" data-accordion-item>
                   <a href="#" class="accordion-title">What are teledermatology services?</a>
                   <div class="accordion-content" data-tab-content id="deeplink3">
                     <p>
                        Teledermatology services involve providing dermatological consultations and care remotely through telecommunication technology. This allows patients to receive diagnoses and treatment advice from a dermatologist without needing to visit a clinic, often
                        via video conferencing.
                    </p>
                   </div>
             </li>
             <li class="accordion-item" data-accordion-item>
                   <a href="#" class="accordion-title">What are the benefits of teledermatology services?</a>
                   <div class="accordion-content" data-tab-content id="deeplink4">
                     <p>
                        Teledermatology is convenient, enabling patients to consult dermatologists remotely. It saves time and enhances access to specialized care. However, it's essential to note that not all skin conditions can be accurately assessed without an in-person examination.
                    </p>
                   </div>
               </li> 
               <li class="accordion-item" data-accordion-item>
                  <a href="#" class="accordion-title">What are the pros and cons of teledermatology services?</a>
                  <div class="accordion-content" data-tab-content id="deeplink4">
                     <p>
                        <strong>Pros: </strong>Enables access to specialists without the need to travel, quick appointment availability, and overall convenience.
                    </p>
                    <p>
                        <strong>Cons:</strong> Limited ability for physical examination, risk of misdiagnosis, and potential communication problems regarding treatment effectiveness.
                    </p>
                  </div>
               </li> 
               <li class="accordion-item" data-accordion-item>
                  <a href="#" class="accordion-title">What does the consultation process at SISD entail?</a>
                  <div class="accordion-content" data-tab-content id="deeplink4">
                     <p>
                        The consultation process typically consists of a thorough evaluation of your skin and hair conditions, a review of your medical history, lab test results, and an exploration of advanced treatment options.
                    </p>
                  </div>
               </li> 
               <li class="accordion-item" data-accordion-item>
                  <a href="#" class="accordion-title">How can I book an appointment?</a>
                  <div class="accordion-content" data-tab-content id="deeplink4">
                     <p>
                        To book your appointment, you can contact our office either by phone or by using the<strong> 'Contact Form' </strong>on our website.
                    </p>
                    <p>
                        To book your appointment, call:
                    </p>
                    <ol>
                        <li>
                            <strong>Greater Kailash:</strong> (91-11) 29242350, 29232349, 29248718, 29237499, 8448662349, 9355594442
                        </li>
                        <li>
                            <strong>Ashok Vihar:</strong> 27306614, 65687265, 9560106614, 9560106614
                        </li>
                        <li>
                            <strong>Dasna in Ghaziabad</strong>: 9971155043, 9311765043
                        </li>
                    </ol>
                  </div>
               </li> 
               <li class="accordion-item" data-accordion-item>
                  <a href="#" class="accordion-title">Where is the Treatment Centre?</a>
                  <div class="accordion-content" data-tab-content id="deeplink4">
                     <p>
                        <strong>1. Dr. Behl's Skin Hospital </strong>is located at:
                    </p>
                    <p>
                        Zamrudpur, Greater Kailash-1, (Opposite Lady Shri Ram College)
                    </p>
                    <p>
                        143-A, Block C, Zamrudpur Village, Lajpat Nagar 4,
                    </p>
                    <p>
                        New Delhi - 110048, India.
                    </p>
                    <p>
                        <strong>2. Dr. Behl's Wholistic Health Centre </strong>is located at:
                    </p>
                    <p>
                        A-7, Shopping Centre, Ashok Vihar 4,
                    </p>
                    <p>
                        Delhi - 110052 (Nimri Colony, Near Deep Chand Bandhu Hospital).
                    </p>
                    <p>
                        <strong>3. Dr. Behl's Skin Hospital (</strong>RISHI - Rural-Cum-Industrial Skin &amp; Health Institute) is located at:
                    </p>
                    <p>
                        Hapur Road, Devi Mandir Marg, Dasna,
                    </p>
                    <p>
                        Distt. Ghaziabad, (U.P.) - 201015.
                    </p>
                  </div>
               </li> 
            </ul>
        </div>
        {{-- <div class="large-7 medium-12 small-12 cell">
            <div class="after-before-item small-module">
                <div class="twentytwenty-container">
                    <img src="assets/images/help/before.jpg" alt />
                    <img src="assets/images/help/after.jpg" alt />
                </div>
            </div>
        </div> --}}


        
    </div>
</div>
@endsection