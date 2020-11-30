
<header class="main-header">


    <!-- Logo -->
    <a href="<?php echo e(URL::to('admin/dashboard')); ?>" class="logo">
      <!-- mini logo for sidebar mini 50x50 pixels -->
      
      <div id="logosetting">
        <img style="margin-left: -15px; margin-top: -3px;" src="<?php echo e(asset('admin/images/admin-panel-logo.jpg')); ?>" alt="">
      </div>
    </a>
 
      <!-- logo for regular state and mobile devices -->
      
      
    </a>

    <!-- Header Navbar: style can be found in header.less -->
    <nav class="navbar navbar-static-top">
      <!-- Sidebar toggle button-->
      <a href="#" class="sidebar-toggle" id="linkid" data-toggle="offcanvas" role="button" onclick="logosetting()">
        <span class="sr-only"><?php echo e(trans('labels.toggle_navigation')); ?></span>
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

            <span class="hidden-xs"><?php echo e(auth()->user()->first_name); ?> <?php echo e(auth()->user()->last_name); ?>  </span>
          </a>
          <ul class="dropdown-menu">
            <!-- User image -->
            <li class="user-header">

              <p>
                <?php echo e(auth()->user()->first_name); ?> <?php echo e(auth()->user()->last_name); ?> 
                <small><?php echo e(trans('labels.administrator')); ?></small>
              </p>
            </li>
            <!-- Menu Footer-->
            <li class="user-footer">
              <div class="pull-left">
                <a href="<?php echo e(URL::to('admin/admin/profile')); ?>" class="btn btn-default btn-flat"><?php echo e(trans('labels.profile_link')); ?></a>
              </div>
              <div class="pull-right">
                <a href="<?php echo e(URL::to('admin/logout')); ?>" class="btn btn-default btn-flat"><?php echo e(trans('labels.sign_out')); ?></a>
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
      html+=`<img style="margin-left: -15px;" src="<?php echo e(asset('admin/images/mediasoft-logo-mini.png')); ?>" alt="">`
      $("#logosetting").html(html);
      counter++;
    }else{
      html="";
      html+=`<img style="margin-left: -15px;margin-top: -3px;" src="<?php echo e(asset('admin/images/admin-panel-logo.jpg')); ?>" alt="">`
      $("#logosetting").html(html);
      counter++;
    }
   //alert(counter);
  }
</script><?php /**PATH D:\sohan_project\backup\New folder\chawalah\resources\views/admin/common/header.blade.php ENDPATH**/ ?>