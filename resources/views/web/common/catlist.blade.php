<div class="swiper-slide">
    <div class="overlay">
      <a href="{{url('/')}}"><img class="dttoprightimg" src="{{asset('web/img/new___icons_01_1604995968.png')}}" /></a>
    </div>

    <div class="overlayhome">
      <a href="{{url('/menucategory')}}"> <img class="dttoprightimgbottom" src="{{asset('web/img/new___icons_03_1604995966.png')}}" /></a>
    </div>

    <div class="card text-center" style="width: 18rem;top:125px;left:36px; opacity: 0.9;">
          @foreach ($categories as $item)
          <span class="text-center vrr mt-3"><a href="{{url('/menu/'.$item->categories_id)}}" style="color: black;"><b class="uprcse">{{ $item->categories_name }}</b></a> </span>
          @endforeach
          <br>
      </ul>
    </div>



  </div>