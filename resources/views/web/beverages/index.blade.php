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
        .beveragecard{
            top: 35%;
            opacity: 0.8;
            margin-left: 5%;
            margin-right: 5%;
        }
        @media (min-width: 1200px) { 
            .beveragecard{
            top: 35%;
            opacity: 0.8;
            margin-left: 5%;
            margin-right: 5%;
            }
        }
        }
       
    </style>
    @endpush
    @section('contents')
    <div class="bg test">
        <div class="">
        
            {{-- <div class="bottomleft">
                <a href="{{url('/drinks')}}"><img class="bottomleftimg" src="{{asset('web/img/ICONS-04B.png')}}"/></a>
            </div>
            <div class="bottomright">
                <a href="{{url('/menu3')}}"><img class="bottomrightimg menu3" src="{{asset('web/img/ICONS-01B.png')}}"/></a>
            </div> --}}
             <div class="bottomleft"> <a href="{{url('/menucategory')}}"><img class="bottomleftimg" src="{{asset('web/img/Food-01B.png')}}"/></a>
            </div>
            <div class="bottomright"><a href="{{url('/beverages')}}"><img class="bottomrightimg menu3" src="{{asset('web/img/ICONS-01B.png')}}"/></a>
            </div>
            <div class="toprightbottom">
                <a href="{{url('/')}}"> <img class="toprightimgbottom" src="{{asset('web/img/new___icons_01_1604995968.png')}}"/></a>
            </div>
        </div>

            <div class="card beveragecard">
                @foreach ($categories as $item)
                <span class="text-center vrr mt-3"><a  href="{{url('/menulistbeverages/'.$item->categories_id)}}" style="color: black;text-decoration:none"><b class="uprcse">{{ $item->categories_name }}</b></a> </span>
                @endforeach
                <small class="text-center vrr mt-4"><b><i class="fa fa fa-hand-pointer-o"></i> Click to view category</b></small>
                <br>
            </div>

        </div>
       
   
    </div>
    @push('scripts')
   
    @endpush
    @endsection
    
 
