
<header class="main-header">


    <!-- Logo -->
    <a href="{{ URL::to('admin/dashboard')}}" class="logo">
      <!-- mini logo for sidebar mini 50x50 pixels -->
      {{-- <span class="logo-mini" style="font-size:12px"><b>{{ trans('labels.admin') }}</b></span> --}}
      <div id="logosetting">
        <img style="margin-left: -15px; margin-top: -3px;" src="{{asset('admin/images/admin-panel-logo.jpg')}}" alt="">
      </div>
    </a>
 
      <!-- logo for regular state and mobile devices -->
      {{-- <span class="logo-lg"><b>{{ trans('labels.admin') }}</b></span> --}}
      {{-- <img src="{{asset('admin/images/mediasoft-logo-mini.png')}}" alt=""> --}}
    </a>

    <!-- Header Navbar: style can be found in header.less -->
    <nav class="navbar navbar-static-top">
      <!-- Sidebar toggle button-->
      <a href="#" class="sidebar-toggle" id="linkid" data-toggle="offcanvas" role="button" onclick="logosetting()">
        <span class="sr-only">{{ trans('labels.toggle_navigation') }}</span>
      </a>
		<div id="countdown" style="
    width: 350px;
    margin-top: 13px !important;
    position: absolute;
    font-size: 16px;
    color: #ffffff;
    display: inline-block;
    margin-left: -175px;
    left: 50%;
"></div>
     <!-- Navbar Right Menu -->
     <div class="navbar-custom-menu">
      <ul class="nav navbar-nav">
        <li class="dropdown user user-menu">
          <a href="#" class="dropdown-toggle" data-toggle="dropdown">

            <span class="hidden-xs">{{ auth()->user()->first_name }} {{ auth()->user()->last_name }}  </span>
          </a>
          <ul class="dropdown-menu">
            <!-- User image -->
            <li class="user-header">

              <p>
                {{ auth()->user()->first_name }} {{ auth()->user()->last_name }} 
                <small>Administrator</small>
              </p>
            </li>
            <!-- Menu Footer-->
            <li class="user-footer">
              <div class="pull-left">
                <a href="#" class="btn btn-default btn-flat">{{ trans('labels.profile_link')}}</a>
              </div>
              <div class="pull-right">
                <a href="{{ URL::to('admin/logout')}}" class="btn btn-default btn-flat">Sign Out</a>
              </div>
            </li>
          </ul>
        </li>
      </ul>
    </div>
    </nav>
  </header>
<script>
  var counter=1;
  function logosetting()
  {
    var html="";
    if(counter%2!=0)
    {
      html+=`<img style="margin-left: -15px;" src="{{asset('admin/images/mediasoft-logo-mini.png')}}" alt="">`
      $("#logosetting").html(html);
      counter++;
    }else{
      html="";
      html+=`<img style="margin-left: -15px;margin-top: -3px;" src="{{asset('admin/images/admin-panel-logo.jpg')}}" alt="">`
      $("#logosetting").html(html);
      counter++;
    }
   //alert(counter);
  }
</script>