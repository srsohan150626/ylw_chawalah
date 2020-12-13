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
    <div id="fakeLoader"></div>
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
            
                <div class="card " style="width: 18rem; opacity: 0.8;">
                   
                    <div class="card-body">
                        <br>
                      <h3 class="card-title text-center yellow_label   "> <b class="gza" >YELLOW</b> </h3>
                      <p class="card-text text-center vrr home_text_1">
                          @if (isset($hometext[0]->upper_text))
                          {{ strip_tags($hometext[0]->upper_text) }}
                          @endif
                          
                        </p>
                        <br>
                        <p class="card-text text-center vrr home_text_2" >
                            @if (isset($hometext[0]->lower_text))
                            {{strip_tags($hometext[0]->lower_text)}}
                            @endif
                            </p>
                        <br>
                    </div>
                  </div>

                  <div class="card next" style="width: 18rem; opacity: 0.8;">
                        @foreach ($categories as $item)
                        <span class="text-center vrr mt-3"><a href="{{url('/menulist/'.$item->categories_id)}}" style="color: black;"><b class="uprcse">{{ $item->categories_name }}</b></a> </span>
                        @endforeach
                        <br>
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
            autoHeight: true,
            callback: function(index, elem, dir) {},
            transitionEnd: function(index, elem) {}
            
        });
    </script>
    <script type="text/javascript">

            $("#fakeLoader").fakeLoader({
                    timeToHide: 1000, //Time in milliseconds for fakeLoader disappear
                    zIndex: 999, // Default zIndex
                    spinner: "spinner6", //Options: 'spinner1', 'spinner2', 'spinner3', 'spinner4', 'spinner5', 'spinner6', 'spinner7' 
                    bgColor: "#000000", //Hex, RGB or RGBA colors
                    // imagePath:"../img/coyaiconforgif_17__2_.gif" //If you want can you insert your custom image
                });
         </script>
    @endpush
    @endsection
    
 
