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
    <div class="bg test">
        <div class="">
        
            {{-- <div class="bottomleft">
                <a href="{{url('/fastfood')}}"><img class="bottomleftimg bottomleftimgdrink" src="{{asset('web/img/Food-01B.png')}}"/></a>
            </div>
            <div class="bottomright">
                <a href="{{url('/drinks')}}"><img class="bottomrightimg menu3" src="{{asset('web/img/ICONS-04B.png')}}"/></a>
            </div> --}}
        </div>
    
        <div id="mySwipe" class="swipe resslider">
            <div class="swipe-wrap ">
            
                <div class="card " style="width: 18rem; opacity: 0.8;">
                   
                    <div class="card-body">
                        <br>
                      <h3 class="card-title text-center yellow_label   "> <b class="gza" >YELLOW</b> </h3>
                      <h4 class="card-text text-center vrr home_text_1">
                          @if (isset($parent_name->categories_name))
                          {{ $parent_name->categories_name }}
                          @endif
                          
                      </h4>
                        <br>
                        <br>
                    </div>
                  </div>

                  <div class="card next" style="width: 18rem; opacity: 0.8;">
                        @foreach ($categories as $item)
                        <span class="text-center vrr mt-3"><a href="{{url('/menulist3/'.$item->categories_id)}}" style="color: black;"><b class="uprcse">{{ $item->categories_name }}</b></a> </span>
                        @endforeach
                        <br>
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
            autoHeight: true,
            callback: function(index, elem, dir) {},
            transitionEnd: function(index, elem) {}
            
        });
    </script>
    
    @endpush
    @endsection
    
 
