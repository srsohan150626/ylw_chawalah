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
  <div class="transprnt test">
        <div class="transbg"></div>

        
    <div class="dtbottomleft">
      <a href="{{url('/')}}"><img class="bottomleftimg" src="{{asset('web/img/Food-01B.png')}}"/></a>
    </div>
    <div class="dtbottomright">
        <img class="bottomrightimg" src="{{asset('web/img/ICONS-01B.png')}}"/>
    </div>

    <div class="swiper-container ">
        <div class="swiper-wrapper">
        <div class="swiper-slide">
            <div class="text-center mt-4">
                <div class="overlay">
                    <a href="{{url('/drinks')}}"><img class="dttoprightimg" src="{{asset('web/img/new___icons_01_1604995968.png')}}" /></a>
                  </div>
            
                  <div class="overlayhome">
                    <a href="{{ url()->previous() }}"> <img class="dttoprightimgbottom" src="{{asset('web/img/new___icons_03_1604995966.png')}}" /></a>
                  </div>
                <img src="{{asset('web/img/oops.jpg')}}" class="img-fluid" style="margin-top: 125px;">
                <h3 class="vrr">No Items Found for your Selected Menu Category</h3>
            </div> 
        </div>

        <div class="swiper-slide">
            <div class="overlay">
                <a href="{{url('/drinks')}}"><img class="dttoprightimg" src="{{asset('web/img/new___icons_01_1604995968.png')}}" /></a>
              </div>
        
              <div class="overlayhome">
                <a href="{{ url()->previous() }}"> <img class="dttoprightimgbottom" src="{{asset('web/img/new___icons_03_1604995966.png')}}" /></a>
              </div>
        <div class="card text-center mlist" style="width: 18rem;top:125px;left:36px; opacity: 0.8;">
                    @foreach ($categories as $item)
                    <span class="text-center vrr mt-3"><a href="{{url('/menulistdrinks/'.$item->categories_id)}}" style="color: black;"><b class="uprcse">{{ $item->categories_name }}</b></a> </span>
                    @endforeach
                    <br>
                </ul>
            </div>
        </div>

    
    
    
    
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
