<div class="swiper-slide">
    <div class="overlay">
      <a href="{{url('/')}}"><img class="dttoprightimg" src="{{asset('web/img/new___icons_01_1604995968.png')}}" /></a>
    </div>

    <div class="overlayhome">
      <a href="{{ url()->previous() }}"> <img class="dttoprightimgbottom" src="{{asset('web/img/new___icons_03_1604995966.png')}}" /></a>
    </div>

    <div class="card text-center menucardlist">
          @foreach ($categories as $item)
          <span class="text-center vrr mt-3"><a href="{{url('/menulist/'.$item->categories_id)}}" style="color: black;"><b class="uprcse">{{ $item->categories_name }}</b></a> </span>
          @endforeach
          <br>
      
    </div>



  </div>