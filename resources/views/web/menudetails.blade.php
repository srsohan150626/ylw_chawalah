@extends('web.layouts.master')
@push('scripts')
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
        opacity: .1;
        width: 100%;
        /* background-image: url("{{asset('web/img/tableabove10001499.jpg')}}"); */
        height: 700px;
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

  @if ($tot_item>0)
  
    <div class="swiper-container ">
        <div class="swiper-wrapper">

          @foreach ($menuitems as $item)
          <div class="swiper-slide">
            <div class="overlay">
              <a href="{{url('/menucategory')}}"><img class="dttoprightimg" src="{{asset('web/img/new___icons_03_1604995966.png')}}" /></a>
            </div>

            <div class="overlayhome">
              <a href="{{url('/')}}"> <img class="dttoprightimgbottom" src="{{asset('web/img/new___icons_01_1604995968.png')}}" /></a>
            </div>

            <div class="overlayone">
              <img class="dttoprightimgbottomone" src="{{asset('web/img/new___icons_02_1604995967.png')}}" />
            </div>

            <div class="" style="top:0px;">
              <img class="img-fluid" style="height: 380px;" src="{{asset($item->imgpath)}}"/>
              <div class="text-center mt-4">
                  <h3 class="yfont">{{ $item->item_name }}</h3>
              <span class="yfont">TK. {{ $item->item_price }}</span>
              </div>
              <div class="mt-2 ml-2 text-center">
                <span style="font-size: larger;" class="yfont"><?=stripslashes($item->item_description)?> </span>
              </div>
            </div>
          </div>
          @endforeach
          <div class="swiper-slide">
            <div class="overlay">
              <a href="{{url('/menucategory')}}"><img class="dttoprightimg" src="{{asset('web/img/new___icons_03_1604995966.png')}}" /></a>
            </div>

            <div class="overlayhome">
              <a href="{{url('/')}}"> <img class="dttoprightimgbottom" src="{{asset('web/img/new___icons_01_1604995968.png')}}" /></a>
            </div>
            <div class="card text-center" style="width: 18rem;top:125px;left:36px;">
              <ul class="list-group list-group-flush text-center">
                  @foreach ($categories as $item)
                  <li class="list-group-item"><a href="{{url('/menu/'.$item->categories_id)}}"><span style="font-size: 20px;" class="yfont">{{ $item->categories_name }}</span></a> </li>
                  @endforeach
              </ul>
            </div>
          </div>
        </div>
    </div>
    @else
      <div class="text-center mt-4">
        <div class="overlay">
          <a href="{{url('/menucategory')}}"><img class="dttoprightimg" src="{{asset('web/img/new___icons_03_1604995966.png')}}" /></a>
        </div>

        <div class="overlayhome">
          <a href="{{url('/')}}"> <img class="dttoprightimgbottom" src="{{asset('web/img/new___icons_01_1604995968.png')}}" /></a>
        </div>
      <img src="{{asset('web/img/oops.jpg')}}" class="img-fluid" style="margin-top: 125px;">
          <h3 class="yfont">No Items Found for your Selected Menu Category</h3>
      </div> 
    @endif
  </div>

    @push('scripts')
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
    </script>
  @endpush
@endsection
