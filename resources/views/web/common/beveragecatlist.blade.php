<div class="swiper-slide">
    <div class="overlay">
      <a href="{{url('/')}}"><img class="dttoprightimg" src="{{asset('web/img/new___icons_01_1604995968.png')}}" /></a>
    </div>

    <div class="overlayhome">
      <a href="{{ url()->previous() }}"> <img class="dttoprightimgbottom" src="{{asset('web/img/new___icons_03_1604995966.png')}}" /></a>
    </div>
    <div class="beveragebtleft"> <a href="{{url('/beverages')}}"><img class="bottomleftimg" src="{{asset('web/img/ICONS-01B.png')}}"/></a>
    </div>
    <div class="beveragebtright"> <a href="{{url('/menucategory')}}"><img class="bottomrightimg menu3" src="{{asset('web/img/Food-01B.png')}}"/></a>
    </div>
    <div class="card text-center beveragemenucatlist" >
          @foreach ($categories as $item)
          <span class="text-center vrr mt-3"><a href="{{url('/menulistbeverages/'.$item->categories_id)}}" style="color: black;text-decoration:none;"><b class="uprcse">{{ $item->categories_name }}</b></a> </span>
          @endforeach
          <small class="text-center vrr mt-4"><b><i class="fa fa fa-hand-pointer-o"></i> Click to view category</b></small>

      
    </div>



  </div>
 