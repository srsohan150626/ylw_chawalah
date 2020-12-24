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
        /* width: 100%; */
        /* background-image: url("{{asset('web/img/tableabove10001499.jpg')}}"); */
        height: 750px;
        background-position: center;
        background-repeat: no-repeat;
        background-size: cover;
      }
      @media (min-width: 1200px) { 
        .transbg{
          height: 1200px;
        }
      }
      @media (min-width: 720px) { 
        .transbg{
          height: 1076px;
        }
      }
    </style>
@endpush
@section('contents')
  <div class="transprnt test">
        <div class="transbg"></div>

        
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
                <a href="{{url('/menucategory')}}"> <img class="dttoprightimgbottom" src="{{asset('web/img/new___icons_03_1604995966.png')}}" /></a>
            </div>

            {{-- <div class="overlayhome">
              <a href="{{url('/menucategory')}}"> <img class="dttoprightimgbottom" src="{{asset('web/img/new___icons_03_1604995966.png')}}" /></a>
            </div> --}}

            <div class="card catcard" >
              <div class="card-body">
                <h3 class="vrr" style="color: burlywood;"><b>{{ $menuitems[0]->categories_name }}</b></h3>
                    <span class="vrr" style="color: burlywood;">{{ $tot_item }} Items</span>

                    @foreach ($menuitems as $item)
                    
                        <div class="mt-2">
                            <a href="{{url('/menu/'.$item->categories_id.'/'.$item->item_slug)}}" style="color: black;text-decoration:none"><span class="vrr"><b>  {!! str_limit(strip_tags($item->item_name), $limit = 25, $end = '...') !!}</b></span></a>
                            <span  style="color: burlywood;float: right;"><b>{{ $item->item_price}}</b></span> 
                            
                        </div>
                        <span class="vrr "> {!! str_limit(strip_tags($item->ingredients), $limit = 45, $end = '...') !!} </span>

                    @endforeach
                    <br>
                    <br>
                    <span class="vrr usermsg" style="font-size: larger;"><i class="fa fa-reply"></i> Swipe Left or Click on Menu <i class="fa fa fa-hand-pointer-o"></i> </span>
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
