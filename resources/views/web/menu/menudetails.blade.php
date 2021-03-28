@extends('web.layouts.master')
@push('style')
    <style>
      
      .transprnt{
        z-index: 1;
      }
      .bg {
          /* The image used */
          background-image: url("{{URL::to('images/' . $background_image[0]->bg_image)}}");
        
          /* Full height */
          height: 100%; 
        
          /* Center and scale the image nicely */
          background-position: center;
          background-repeat: no-repeat;
          background-size: cover;
        }
      /* .transbg{
        position: absolute;
        z-index: -1;
        top: 0;
        bottom: 0;
        left: 0;
        right: 0;
        background: url("{{URL::to('images/' . $background_image[0]->bg_image)}}") center center;
        background-position: center;
        background-repeat: no-repeat;
        background-size: cover;
        height: 100%;
      }
      @media (min-width: 1200px) { 
        .transbg{
          height: 100%;
        }
      }
      @media (min-width: 720px) { 
        .transbg{
          height: 100%;
        }
      } */
    </style>
@endpush
@section('contents')
  <div class="bg test">

        
    {{-- <div class="dtbottomleft">
      <a href="{{url('/drinks')}}"><img class="bottomleftimg" src="{{asset('web/img/ICONS-04B.png')}}"/></a>
    </div>

    <div class="dtbottomright">
      <a href="{{url('/menu3')}}"><img class="bottomrightimg menu3" src="{{asset('web/img/ICONS-01B.png')}}"/></a>
    </div> --}}
    
    <div class="swiper-container ">
      <div class="swiper-wrapper">
        <div class="swiper-slide">
          <div class="overlay">
              <a href="{{url('/')}}"><img class="dttoprightimg" src="{{asset('web/img/new___icons_01_1604995968.png')}}" /></a>
          </div>

          <div class="overlayhome">
              <a href="{{ url()->previous() }}"> <img class="dttoprightimgbottom" src="{{asset('web/img/new___icons_03_1604995966.png')}}" /></a>
          </div>

         <!--  <div class="overlayone">
              <img class="dttoprightimgbottomone" src="{{asset('web/img/new___icons_02_1604995967.png')}}" />
          </div> -->

          <div class="" style="top:0px;">
              {{-- <img class="imagesquare"  src="{{asset($menuitemsindividual[0]->imgpath)}}"/> --}}
              <img class="imagesquare"  src="{{URL::to('images/' . $menuitemsindividual[0]->item_image)}}" alt="" >
              <div class="card" style="opacity: 0.8; height: 370px;">
                <div class="card-body">
                  <div class="text-center mt-4">
                    <h3 class="vrr">{{ $menuitemsindividual[0]->item_name }}</h3>
                  <span class="vrr">TK. {{ $menuitemsindividual[0]->item_price }}</span>
                  </div>
                  <div class="mt-2 ml-2 text-center">
                    <span style="font-size: larger;" class="vrr"><?=stripslashes($menuitemsindividual[0]->item_description)?> </span>
                  </div>
                </div>
              
              </div>
          </div>
          </div>

  @if ($tot_item>0)
      @foreach ($menuitems as $item)
      <div class="swiper-slide">
        <div class="overlay">
          <a href="{{url('/')}}"><img class="dttoprightimg" src="{{asset('web/img/new___icons_01_1604995968.png')}}" /></a>
        </div>

        <div class="overlayhome">
          <a href="{{ url()->previous() }}"> <img class="dttoprightimgbottom" src="{{asset('web/img/new___icons_03_1604995966.png')}}" /></a>
        </div>

        {{-- <div class="overlayone">
          <img class="dttoprightimgbottomone" src="{{asset('web/img/new___icons_02_1604995967.png')}}" />
        </div> --}}

        <div class="" style="top:0px;">
          {{-- <img class="imagesquare"  src="{{asset($item->imgpath)}}"/> --}}
          <img class="imagesquare"  src="{{URL::to('images/' . $item->item_image)}}" alt="" >

          <div class="card" style="opacity: 0.8; height: 370px;">
            <div class="card-body">
              <div class="text-center mt-4">
                <h3 class="vrr">{{ $item->item_name }}</h3>
              <span class="vrr">TK. {{ $item->item_price }}</span>
              </div>
              <div class="mt-2 ml-2 text-center">
                <span style="font-size: larger;" class="vrr"><?=stripslashes($item->item_description)?> </span>
              </div>
            </div>
           
          </div>
         
        </div>
      </div>
      @endforeach
      @endif

      @include('web.common.catlist')

    </div>
</div>
 
   
  </div>

    @push('scripts')
 
    <script type="text/javascript">
        var swiper = new Swiper('.swiper-container', {
        effect: 'coverflow',
        grabCursor: true,
        centeredSlides: true,
        slidesPerView: 'auto',
        infinite: true,
        coverflowEffect: {
          rotate: 50,
          stretch: 0,
          depth: 100,
          modifier: 1,
          slideShadows: true,
        },
        // If we need pagination
        pagination: {
          el: '.swiper-pagination',
        }
       
      });
    </script>
  @endpush
@endsection
