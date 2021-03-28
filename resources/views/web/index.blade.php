@extends('web.layouts.master')
    @push('style')
    <style>
        body, html {
          height: 100%;
          margin: 0;
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

            .bottomleft {
            position: absolute;
            bottom: 8px;
            left: 16px;
            font-size: 18px;
            z-index: 9;
            }
            .bottomright {
            position: absolute;
            bottom: 8px;
            right: 16px;
            font-size: 18px;
            z-index: 9;
            }
            .topright {
            position: absolute;
            top: 8px;
            right: 16px;
            font-size: 18px;
            z-index: 9;
            }
            .toprightbottom {
            position: absolute;
            top: 30px;
            right: 16px;
            font-size: 18px;
            z-index: 9;
            }
            .topleft {
            position: absolute;
            top: 30px;
            left: 16px;
            font-size: 18px;
            z-index: 9;
            }
        .resslider{
            margin-left: 4%;
            margin-right: 5%;
        }
        .resslidertopfix{
            margin-top: 12%;
        }
        @media (min-width: 1200px) { 
               .resslidertopfix{
                margin-top: 4%;
            }
        }
       .resslidertopfixlist{
            margin-top: 5.5%;
        }
        @media (min-width: 1200px) { 
               .resslidertopfixlist{
                margin-top: 1.5%;
            }
        }
    </style>
    @endpush
    @section('contents')
    <div id="fakeLoader"></div>
    <div class="bg test">
        
            <div class="bottomleft"> <a href="{{url('/beverages')}}"><img class="bottomleftimg" src="{{asset('web/img/ICONS-01B.png')}}"/></a>
            </div>
            <div class="bottomright"> <a href="{{url('/menucategory')}}"><img class="bottomrightimg menu3" src="{{asset('web/img/Food-01B.png')}}"/></a>
            </div>
            <div class="toprightbottom">
                <a href="{{url('/')}}"> <img class="toprightimgbottom" src="{{asset('web/img/new___icons_01_1604995968.png')}}"/></a>
            </div>
            <div class="topleft">
                {{-- <a href="{{url('/menuitems')}}"><img class="topleftimg" src="{{asset('web/img/menu.jpg')}}"/></a> --}}
                <a href="{{url('/menuitems')}}" class="btn  btn-sm" style="background-color: #fff;border-color: #B38B55;"><i class="fa fa-cutlery textmenu" aria-hidden="true"></i> <span class="textmenu vrr">Text Menu</span></a>
            </div>
    
        <div id="mySwipe" class="swipe resslider">
            <div class="swipe-wrap ">
            
                <div class="card resslidertopfix" style="width: 18rem; opacity: 0.8;">
                   
                    <div class="card-body">
                        <br>
                      <h3 class="card-title text-center yellow_label   "> <b class="gza" >KOOL CHA</b> </h3>
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
                            <br>
                            <br>
                            <span class="vrr" style="font-size: larger;"><i class="fa fa-reply"></i>   Swipe Left</span>
                        </p>
                        {{-- <span class="card-text text-center vrr"><i class="fa fa-reply"></i> Swipe Left</span> --}}
                 
                    </div>
                  </div>

                  <div class="card next resslidertopfixlist" style="width: 18rem; opacity: 0.8;">
                        @foreach ($categories as $item)
                        <span class="text-center vrr mt-3"><a  href="{{url('/menulist/'.$item->categories_id)}}" style="color: black;text-decoration:none"><b class="uprcse">{{ $item->categories_name }}</b></a> </span>
                        @endforeach
                        <small class="text-center vrr mt-4"><b><i class="fa fa fa-hand-pointer-o"></i> Click to view category</b></small>
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
    
 
