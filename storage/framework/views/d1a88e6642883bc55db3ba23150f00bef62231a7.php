<aside class="main-sidebar">
    <!-- sidebar: style can be found in sidebar.less -->
    <section class="sidebar">

      <!-- sidebar menu: : style can be found in sidebar.less -->
      <ul class="sidebar-menu">
        <li class="header"><?php echo e(trans('labels.navigation')); ?></li>
        <li class="treeview <?php echo e(Request::is('admin/dashboard') ? 'active' : ''); ?>">
          <a href="<?php echo e(URL::to('admin/dashboard')); ?>">
            <i class="fa fa-dashboard"></i> <span><?php echo e(trans('labels.header_dashboard')); ?></span>
          </a>
        </li>
 
      <li class="treeview <?php echo e(Request::is('admin/media/add') ? 'active' : ''); ?>">
        <a href="#">
          <i class="fa fa-picture-o"></i> <span><?php echo e(trans('labels.media')); ?></span> <i class="fa fa-angle-left pull-right"></i>
        </a>
        <ul class="treeview-menu">
          <li class="treeview <?php echo e(Request::is('admin/media/add') ? 'active' : ''); ?> ">
              <a href="<?php echo e(url('admin/media/add')); ?>">

                  <i class="fa fa-circle-o" aria-hidden="true"></i> <span> <?php echo e(trans('labels.media')); ?> </span>
              </a>
          </li>

          <li class="treeview <?php echo e(Request::is('admin/media/display') ? 'active' : ''); ?> <?php echo e(Request::is('admin/addimages') ? 'active' : ''); ?> <?php echo e(Request::is('admin/uploadimage/*') ? 'active' : ''); ?> ">
              <a href="<?php echo e(url('admin/media/display')); ?>">

                  <i class="fa fa-circle-o" aria-hidden="true"></i> <span> <?php echo e(trans('labels.Media Setings')); ?> </span>
              </a>
          </li>
        </ul>
      </li>

     
        
        <li class="treeview <?php echo e(Request::is('admin/products/edit/*') ? 'active' : ''); ?>  <?php echo e(Request::is('admin/addproductimages/*') ? 'active' : ''); ?> <?php echo e(Request::is('admin/categories/display') ? 'active' : ''); ?> <?php echo e(Request::is('admin/categories/add') ? 'active' : ''); ?> <?php echo e(Request::is('admin/categories/edit/*') ? 'active' : ''); ?> <?php echo e(Request::is('admin/categories/filter') ? 'active' : ''); ?> ">
          <a href="#">
            <i class="fa fa-database"></i> <span><?php echo e(trans('labels.Catalog')); ?></span> <i class="fa fa-angle-left pull-right"></i>
          </a>
          <ul class="treeview-menu">
              <li class="<?php echo e(Request::is('admin/categories/display') ? 'active' : ''); ?> <?php echo e(Request::is('admin/categories/add') ? 'active' : ''); ?> <?php echo e(Request::is('admin/categories/edit/*') ? 'active' : ''); ?> <?php echo e(Request::is('admin/categories/filter') ? 'active' : ''); ?>"><a href="<?php echo e(URL::to('admin/categories/display')); ?>"><i class="fa fa-circle-o"></i> <?php echo e(trans('labels.link_main_categories')); ?></a></li>

              <li class="<?php echo e(Request::is('admin/menuitems/extras/display') ? 'active' : ''); ?> <?php echo e(Request::is('admin/menuitems/extras/add') ? 'active' : ''); ?> <?php echo e(Request::is('admin/menuitems/extras/edit/*') ? 'active' : ''); ?> <?php echo e(Request::is('admin/menuitems/extras/filter') ? 'active' : ''); ?>"><a href="<?php echo e(URL::to('admin/menuitems/extras/display')); ?>"><i class="fa fa-circle-o"></i> Extras</a></li>
              
              <li class="<?php echo e(Request::is('admin/menuitems/display') ? 'active' : ''); ?> <?php echo e(Request::is('admin/menuitems/add') ? 'active' : ''); ?> <?php echo e(Request::is('admin/menuitems/edit/*') ? 'active' : ''); ?> <?php echo e(Request::is('admin/menuitems/filter') ? 'active' : ''); ?>"><a href="<?php echo e(URL::to('admin/menuitems/display')); ?>"><i class="fa fa-circle-o"></i> Menuitems</a></li>
          </ul>
        </li>
            
         

            <li class="<?php echo e(Request::is('admin/seo') ? 'active' : ''); ?> "><a href="<?php echo e(URL::to('admin/seo')); ?>"><i class="fa fa-circle-o"></i> <?php echo e(trans('labels.seo content')); ?></a></li>

    

         <li class="treeview <?php echo e(Request::is('admin/admins') ? 'active' : ''); ?> <?php echo e(Request::is('admin/addadmins') ? 'active' : ''); ?> <?php echo e(Request::is('admin/editadmin/*') ? 'active' : ''); ?> <?php echo e(Request::is('admin/manageroles') ? 'active' : ''); ?> <?php echo e(Request::is('admin/addadminType') ? 'active' : ''); ?> <?php echo e(Request::is('admin/editadminType/*') ? 'active' : ''); ?>">
          <a href="#">
            <i class="fa fa-users" aria-hidden="true"></i>
  <span> <?php echo e(trans('labels.Manage Admins')); ?></span> <i class="fa fa-angle-left pull-right"></i>
          </a>

          <ul class="treeview-menu">
            <li class="<?php echo e(Request::is('admin/admins') ? 'active' : ''); ?> <?php echo e(Request::is('admin/addadmins') ? 'active' : ''); ?> <?php echo e(Request::is('admin/editadmin/*') ? 'active' : ''); ?>"><a href="<?php echo e(URL::to('admin/admins')); ?>"><i class="fa fa-circle-o"></i> <?php echo e(trans('labels.link_admins')); ?></a></li>
            <li class="<?php echo e(Request::is('admin/manageroles') ? 'active' : ''); ?> <?php echo e(Request::is('admin/addadminType') ? 'active' : ''); ?> <?php echo e(Request::is('admin/editadminType/*') ? 'active' : ''); ?>"><a href="<?php echo e(URL::to('admin/manageroles')); ?>"><i class="fa fa-circle-o"></i> <?php echo e(trans('labels.link_manage_roles')); ?></a></li>
          </ul>
        </li>
        
        
      </ul>
    </section>
    <!-- /.sidebar -->
  </aside>
<?php /**PATH D:\sohan_project\chawalah\resources\views/admin/common/sidebar.blade.php ENDPATH**/ ?>