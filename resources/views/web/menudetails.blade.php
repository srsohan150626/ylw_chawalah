@extends('web.layouts.master')
@section('contents')
  <div class="">
        
    <div class="dtbottomleft">
        <img class="bottomleftimg" src="{{asset('web/img/ICONS-04B.png')}}"/>
    </div>
    <div class="dtbottomright">
        <img class="bottomrightimg" src="{{asset('web/img/ICONS-01B.png')}}"/>
    </div>
    <div class="dttopright">
    <a href="{{url('/')}}"><img class="dttoprightimg" src="{{asset('web/img/new___icons_03_1604995966.png')}}"/></a>
    </div>
    <div class="dttoprightbottom">
      <a href="{{url('/')}}"><img class="dttoprightimgbottom" src="{{asset('web/img/new___icons_01_1604995968.png')}}"/></a>
    </div>
</div>
  @if ($tot_item>0)
  
    <div class="swiper-container">
        <div class="swiper-wrapper">

          @foreach ($menuitems as $item)
          <div class="swiper-slide">
            <div class="" style="top:0px;">
              <img class="img-fluid" src="{{asset($item->imgpath)}}"/>
              <div class="text-center mt-4">
                  <h3>{{ $item->item_name }}</h3>
              <span>TK. {{ $item->item_price }}</span>
              </div>
              <div class="text-center mt-2">
                <span style="font-size: larger;"><?=stripslashes($item->item_description)?> </span>
              </div>
            </div>
          </div>
          @endforeach
        </div>
    </div>
    @else
      <div class="text-center mt-4">
      <img src="{{asset('web/img/oops.jpg')}}" class="img-fluid">
          <h3>No Items Found for your Selected Menu Category</h3>
      </div> 
    @endif
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
