@extends('web.layouts.master')
    @section('contents')
    <div style="background-color: #adb5bd17;">

            <div class="scrollmenu menufonts" id="navbar" >
                    @foreach ($categories as $category)
                    <span><a href="#{{ $category->categories_id }}" class="catfontsize cat{{$category->categories_id}}" >{{ $category->categories_name }}</a></span>
                    @endforeach
              </div>
              
            <div class="overlaymenu">
                <a href="{{ url()->previous() }}"> <img class="dttoprightimgbottom" src="{{asset('web/img/new___icons_03_1604995966.png')}}" /></a>
            </div>

              <div class="content mt-2 menufonts">
                  @php
                      $previous_category= "";
                  @endphp
                @foreach ($menuitems as $key=>$item)
        
                 @if ($previous_category != $item->categories_id )
                    <div id="{{ $item->categories_id}}" style="margin-top: 2.5rem;">
                       <strong><h4 class="menuTitle">{{ $item->categories_name }}</h4></strong> 
                 @endif
                        <div class="card mt-2">
                            <div class="card-body">
                                <a href="{{url('/menu/'.$item->categories_id.'/'.$item->item_slug)}}" style="color: black;text-decoration:none"><span class="itemName">{{ $item->item_name }}</span> </a><br>
                                @if (isset($item->item_description) and $item->item_description!="")
                                <span class="itemdescription"> {!! str_limit(strip_tags($item->item_description), $limit = 75, $end = '...') !!}</span> <br>
                                @endif
                                <span class="itemprice">BDT {{ $item->item_price }}</span>
                            </div>
        
                        </div>
                      
                        @php
                            $previous_category = $item->categories_id ;
                        @endphp
                @if($previous_category != $item->categories_id)
                
                </div>
               
                @endif
        
                @endforeach
              </div>
            </div>

    @push('scripts')
      <script>
          window.onscroll = function() {myFunction()};
            var navbar = document.getElementById("navbar");
            var sticky = navbar.offsetTop;
            //console.log(window.pageYOffset);
            function myFunction() {
           
            if (window.pageYOffset >= sticky) {
                navbar.classList.add("sticky");
            }else {
                navbar.classList.remove("sticky");
            }
            }
      </script>
      <script>
          // Cache selectors
            var lastId,
            topMenu = $("#navbar"),
            topMenuHeight = topMenu.outerHeight()+15,
           
            // All list items
            menuItems = topMenu.find("a"),
            // Anchors corresponding to menu items
            scrollItems = menuItems.map(function(){
            var item = $($(this).attr("href"));
            if (item.length) { return item; }
            });
           
            // Bind click handler to menu items
            // so we can get a fancy scroll animation
            menuItems.click(function(e){
            var href = $(this).attr("href"),
                offsetTop = href === "#" ? 0 : $(href).offset().top-topMenuHeight+1;
            $('html, body').stop().animate({ 
                scrollTop: offsetTop
            }, 300);
            e.preventDefault();
            });

            // Bind to scroll
            $(window).scroll(function(){
            // Get container scroll position
            var fromTop = $(this).scrollTop()+topMenuHeight;
           
            // Get id of current scroll item
            var cur = scrollItems.map(function(){
                if ($(this).offset().top < fromTop)
                return this;
            });
            
            // Get the id of the current element
            cur = cur[cur.length-1];
            var id = cur && cur.length ? cur[0].id : "";
            
            if (lastId !== id) {
                lastId = id;
                // Set/remove active class
                menuItems
                    .parent().removeClass("active")
                    .end().filter("[href='#"+id+"']").parent().addClass("active");
                    var scrollpos= $('.active').offset().left;
                   //console.log (scrollpos);
                    document.getElementById('navbar').scrollLeft += scrollpos;
            }                   
            });
      </script>
   
    @endpush
    @endsection
    
 
