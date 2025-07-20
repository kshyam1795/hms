<div class="banner-container">
   <div class="main-banner">
       @forelse($sliders as $slider)
           <div class="slide transparent-background">
               <img src="{{ asset('storage/'.$slider->image) }}" alt="{{ $slider->title }}" />
               <div class="slide-text">
                   <h2>{{ $slider->title }}</h2>
                   <h3>{{ $slider->description }}</h3>
                   @if($slider->link)
                       <a class="button primary" href="{{ $slider->link }}">Read More &gt;</a>
                   @endif
               </div>
           </div>
       @empty
           <!-- Static fallback if no slider in DB -->
           <div class="slide transparent-background slide-one">
               <img src="{{ asset('assets/images/help/slide1.jpg')}}" alt="banner" />
               <div class="slide-text">
                   <h2>Meet Experts</h2>
                   <h3>Customized Skin Care</h3>
                   <p>Facilisi. Porta integer neque hac, iaculis dui felis Consectetuer.<br>Venenatis sollicitudin potenti pretium sem lobortis erat.</p>
                   <a class="button primary" href="#">Read More &gt;</a>
               </div>
           </div>
           <div class="slide transparent-background slide-two">
               <img src="{{ asset('assets/images/help/slide2.jpg')}}" alt="banner" />
               <div class="slide-text">
                   <h2>Meet Experts</h2>
                   <h3>Customized Skin Care</h3>
                   <p>Facilisi. Porta integer neque hac, iaculis dui felis Consectetuer.<br>Venenatis sollicitudin potenti pretium sem lobortis erat.</p>
                   <a class="button primary" href="#">Read More &gt;</a>
               </div>
           </div>
       @endforelse
   </div>
</div>
