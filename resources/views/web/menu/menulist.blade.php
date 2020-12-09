@extends('web.layouts.master')
@push('style')
<style>
      body, html {
          height: 100%;
          margin: 0;
        }
    .bground {
          /* The image used */
          background-image: url("{{asset('web/img/tableabove10001499.jpg')}}");
        
          /* Full height */
          height: 100%; 
        
          /* Center and scale the image nicely */
          background-position: center;
          background-repeat: no-repeat;
          background-size: cover;
        }
</style>
@endpush
@section('contents')
<div class="bground">

  <div class="overlay">
    <a href="{{url('/')}}"><img class="dttoprightimg" src="{{asset('web/img/new___icons_01_1604995968.png')}}" /></a>
  </div>

  <div class="overlayhome">
    <a href="{{url('/menucategory')}}"> <img class="dttoprightimgbottom" src="{{asset('web/img/new___icons_03_1604995966.png')}}" /></a>
  </div>

  <div class="dtbottomleft">
    <img class="bottomleftimg" src="{{asset('web/img/ICONS-04B.png')}}"/>
  </div>
  <div class="dtbottomright">
      <img class="bottomrightimg" src="{{asset('web/img/ICONS-01B.png')}}"/>
  </div>

    <div class="card ml-2 mr-2" style="top:130px; background-color: seashell; opacity:0.9">
        <div class="card-body">
          <h3 class="vrr" style="color: burlywood;"><b>{{ $menuitems[0]->categories_name }}</b></h3>
          <span class="vrr mt-1" style="color: burlywood;">{{ $tot_item }} Items</span>

          @foreach ($menuitems as $item)
    
          <div class=" mt-3 ml-1" >
            <div style="display: inline-block;width:290px;">
            <a href="{{url('/menu/'.$item->categories_id.'/'.$item->item_slug)}}" style="color: black;"><span class="vrr"><b>  {!! str_limit(strip_tags($item->item_name), $limit = 25, $end = '...') !!}</b></span></a>
              <span  style="color: burlywood;float: right;"><b>{{ $item->item_price}}</b></span>
            </div>
              
              <span class="vrr"> {!! str_limit(strip_tags($item->item_description), $limit = 25, $end = '...') !!}</span>
         </div>

          @endforeach
          
        </div>
        <br>
    </div>
       
    
</div>


@push('scripts')
@endpush
@endsection
