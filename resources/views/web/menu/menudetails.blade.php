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
        opacity: .2;
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
  <div class="transprnt">
        <div class="transbg"></div>

        
    <div class="dtbottomleft">
        <img class="bottomleftimg" src="{{asset('web/img/ICONS-04B.png')}}"/>
    </div>
    <div class="dtbottomright">
        <img class="bottomrightimg" src="{{asset('web/img/ICONS-01B.png')}}"/>
    </div>

  
    <div class="swiper-container ">
        <div class="swiper-wrapper">

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
                    <img class="custmimg" style="height: 380px; width: 100%;" src="{{asset($menuitemsindividual[0]->imgpath)}}"/>
                    <div class="text-center mt-4">
                      <h3 class="vrr2 itemname_text" >{{ $menuitemsindividual[0]->item_name }}</h3>
                    <span class="vrr">TK. {{ $menuitemsindividual[0]->item_price }}</span>
                    </div>
                    <div class="mt-2 ml-2 text-center">
                    <span  class="vrr itemdes_text"><?=stripslashes($menuitemsindividual[0]->item_description)?> </span>
                    </div>
                </div>
                </div>
            
                {{-- @include('web.common.catlist') --}}
        @if ($tot_item>0)
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
              <img class="custmimg" style="height: 380px; width: 100%;" src="{{asset($item->imgpath)}}"/>
              <div class="text-center mt-4">
                  <h3 class="vrr2 itemname_text">{{ $item->item_name }} </h3>
              <span class="vrr">TK. {{ $item->item_price }}</span>
              </div>
              <div class="mt-2 ml-2 text-center">
                <span class="vrr itemdes_text"><?=stripslashes($item->item_description)?> </span>
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
