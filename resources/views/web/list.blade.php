@extends('web.layouts.master')
    @push('style')
    <style>
        body, html {
          height: 100%;
          margin: 0;
        }
        
        .bg {
          /* The image used */
          background-image: url("{{asset('web/img/tableabove10001499.jpg')}}");
        
          /* Full height */
          height: 100%; 
        
          /* Center and scale the image nicely */
          background-position: center;
          background-repeat: no-repeat;
          background-size: cover;
        }
        .container {
            position: relative;
            }

            .bottomleft {
            position: absolute;
            bottom: 8px;
            left: 16px;
            font-size: 18px;
            }
            .bottomright {
            position: absolute;
            bottom: 8px;
            right: 16px;
            font-size: 18px;
            }
            .topright {
            position: absolute;
            top: 8px;
            right: 16px;
            font-size: 18px;
            }
            .toprightbottom {
            position: absolute;
            top: 30px;
            right: 16px;
            font-size: 18px;
            }
        .resslider{
            top: 200px;
            margin-left: 35px;
            margin-right: 35px;
        }
    </style>
    @endpush
    @section('contents')
    <div class="bg">
        <div class="">
        
            <div class="bottomleft">
                <img class="bottomleftimg" src="{{asset('web/img/ICONS-04B.png')}}"/>
            </div>
            <div class="bottomright">
                <img class="bottomrightimg" src="{{asset('web/img/ICONS-01B.png')}}"/>
            </div>
            <div class="toprightbottom">
                <a href="{{url('/')}}"> <img class="toprightimgbottom" src="{{asset('web/img/new___icons_01_1604995968.png')}}"/></a>
            </div>
        </div>
    
        <div id="mySwipe" class="swipe resslider">
            <div class="swipe-wrap ">
                <div class="card " style="width: 18rem;">
                    <ul class="list-group list-group-flush text-center">
                        @foreach ($categories as $item)
                        <li class="list-group-item"><a href="{{url('/menu/'.$item->categories_id)}}"><span style="font-size: 20px;" class="yfont">{{ $item->categories_name }}</span></a> </li>
                        @endforeach
                    </ul>
                  </div>
                <div class="card next" style="width: 18rem;">
                    <div class="card-body">
                      <h4 class="card-title text-center yfont"> <b>YELLOW</b> </h4>
                      <p class="card-text text-center yfont">Swift Left and Watch your Favourite Dishes come to Life.</p>
                        <br>
                        <p class="card-text text-center yfont" >All Prices are inclusive 5% VAT,10% Service Charge.</p>
                    </div>
                  </div>

                  
                </div>
             </div>
        </div>
       
   
    </div>
    @push('scripts')
    <script type="text/javascript">

        var element = document.getElementById('mySwipe');
        window.mySwipe = new Swipe(element, {
            startSlide: 0,
            speed: 1000,
            auto: false,
            draggable: true,
            continuous: false,
            autoRestart: false,
            disableScroll: false, // prevent touch events from scrolling the page
            stopPropagation: false, 
            callback: function(index, elem, dir) {},
            transitionEnd: function(index, elem) {}
            
        });
    </script>
    @endpush
    @endsection
    
 
