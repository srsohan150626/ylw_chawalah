@extends('web.layouts.master')
@push('style')
    <style>
      
      .transprnt{
        z-index: 1;
      }
      .transbg{
        position: absolute;
        z-index: -1;
        top: 0;
        bottom: 0;
        left: 0;
        right: 0;
        background: url("{{asset('web/img/tableabove10001499.jpg')}}") center center;
        width: 100%;
        /* background-image: url("{{asset('web/img/tableabove10001499.jpg')}}"); */
        height: 100%;
        background-position: center;
        background-repeat: no-repeat;
        background-size: cover;
      }
    </style>
@endpush
@section('contents')
  <div class="transprnt test">
        <div class="transbg"></div>

        
    <div class="dtbottomleft">
      <a href="{{url('/drinks')}}"><img class="bottomleftimg" src="{{asset('web/img/ICONS-04B.png')}}"/></a>
    </div>
    </div>
    <div class="dtbottomright">
      <a href="{{url('/menu3')}}"><img class="bottomrightimg menu3" src="{{asset('web/img/ICONS-01B.png')}}"/></a>
    </div>

  @if ($tot_item>0)
  
    <div class="swiper-container ">
        <div class="swiper-wrapper">

          <div class="swiper-slide">
            <div class="overlay">
              <a href="{{url('/')}}"><img class="dttoprightimg" src="{{asset('web/img/new___icons_01_1604995968.png')}}" /></a>
            </div>

            <div class="overlayhome">
              <a href="{{url('/menucategory')}}"> <img class="dttoprightimgbottom" src="{{asset('web/img/new___icons_03_1604995966.png')}}" /></a>
            </div>

            <div class="card catcard">
              <div class="card-body">
                <br>
                <h3 class="card-title text-center "> <b class="vrr2 uprcse">{{ $menuitems[0]->categories_name }}</b> </h3>
                <br>
              </div>
            </div>

          </div>
            
          @foreach ($menuitems as $item)
          <div class="swiper-slide">
            <div class="overlay">
              <a href="{{url('/')}}"><img class="dttoprightimg" src="{{asset('web/img/new___icons_01_1604995968.png')}}" /></a>
            </div>

            <div class="overlayhome">
              <a href="{{url('/menucategory')}}"> <img class="dttoprightimgbottom" src="{{asset('web/img/new___icons_03_1604995966.png')}}" /></a>
            </div>

            <div class="overlayone">
              <img class="dttoprightimgbottomone" src="{{asset('web/img/new___icons_02_1604995967.png')}}" />
            </div>

            <div class="" style="top:0px;">
              <img class="imagesquare"  src="{{asset($item->imgpath)}}"/>

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
          @include('web.common.catlist')

        </div>
    </div>
  @else 
  <div class="swiper-container ">
    <div class="swiper-wrapper">
      
  <div class="swiper-slide">
    <div class="text-center mt-4">
      <div class="overlay">
        <a href="{{url('/')}}"><img class="dttoprightimg" src="{{asset('web/img/new___icons_01_1604995968.png')}}" /></a>
      </div>

      <div class="overlayhome">
        <a href="{{url('/menucategory')}}"> <img class="dttoprightimgbottom" src="{{asset('web/img/new___icons_03_1604995966.png')}}" /></a>
      </div>
        <img src="{{asset('web/img/oops.jpg')}}" class="img-fluid" style="margin-top: 125px;">
        <div class="ml-2 mr-2 mt-2 text-center">
          <h3 class="vrr" style="background-color: white;">No Items Found for your Selected Menu Category</h3>
        </div>
        
    </div> 
    </div>

    @include('web.common.catlist')

  </div> 
</div>
  @endif
   
  </div>

    @push('scripts')
    <script>
      
    </script>
    <script type="text/javascript">
        var swiper = new Swiper('.swiper-container', {
        effect: 'coverflow',
        grabCursor: true,
        centeredSlides: true,
        slidesPerView: 'auto',
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
    //  var some= $('.swiper-slide-active img').attr('src');
    //  console.log(some);
    </script>
  @endpush
@endsection
