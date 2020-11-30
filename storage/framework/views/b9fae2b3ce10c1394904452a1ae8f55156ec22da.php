<?php $__env->startSection('content'); ?>
    <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <section class="content-header">
            <h1> Menuitems <small>Listing all the Menuitems...</small> </h1>
            <ol class="breadcrumb">
                <li><a href="<?php echo e(URL::to('admin/dashboard')); ?>"><i class="fa fa-dashboard"></i> <?php echo e(trans('labels.breadcrumb_dashboard')); ?></a></li>
                <li class="active"> Menuitems</li>
            </ol>
        </section>

        <!-- Main content -->
        <section class="content">
            <!-- Info boxes -->

            <!-- /.row -->
            <div class="row">
                <div class="col-md-12">
                    <div class="box">
                        <div class="box-header">

                            <div CLASS="col-lg-12"> <h7 style="font-weight: bold; padding:0px 16px; float: left;">Filter by Category or Menuitem:</h7>

                                <br>
                           <div class="col-lg-10 form-inline">

                                <form  name='registration' id="registration" class="registration" method="get">
                                    <input type="hidden" name="_token" value="<?php echo e(csrf_token()); ?>">

                                    <div class="input-group-form search-panel ">
                                        <select id="FilterBy" type="button" class="btn btn-default dropdown-toggle form-control input-group-form " data-toggle="dropdown" name="categories_id">

                                            <option value="" selected disabled hidden><?php echo e(trans('labels.ChooseCategory')); ?></option>
                                            <?php $__currentLoopData = $results['categories']; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key=>$categories): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                                <option value="<?php echo e($categories->id); ?>"
                                                        <?php if(isset($_REQUEST['categories_id']) and !empty($_REQUEST['categories_id'])): ?>
                                                          <?php if( $categories->categories_id == $_REQUEST['categories_id']): ?>
                                                            selected
                                                          <?php endif; ?>
                                                        <?php endif; ?>
                                                ><?php echo e($categories->categories_slug); ?></option>
                                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                        </select>
                                        <input type="text" class="form-control input-group-form " name="item" placeholder="Search term..." id="parameter"  <?php if(isset($item)): ?> value="<?php echo e($item); ?>" <?php endif; ?> />
                                        <button class="btn btn-primary " id="submit" type="submit"><span class="glyphicon glyphicon-search"></span></button>
                                        <?php if(isset($product,$categories_id)): ?>  <a class="btn btn-danger " href="<?php echo e(url('admin/menuitems/display')); ?>"><i class="fa fa-ban" aria-hidden="true"></i> </a><?php endif; ?>
                                    </div>
                                </form>
                                <div class="col-lg-4 form-inline" id="contact-form12"></div>
                            </div>
                            <div class="box-tools pull-right">
                                <a href="<?php echo e(URL::to('admin/menuitems/add')); ?>" type="button" class="btn btn-block btn-primary"><?php echo e(trans('labels.AddNew')); ?></a>
                            </div>
                            </div>
                        </div>
                        <!-- /.box-header -->
                        <div class="box-body">

                            <div class="row">
                                <div class="col-xs-12">
                                    <?php if(count($errors) > 0): ?>
                                        <?php if($errors->any()): ?>
                                            <div class="alert alert-success alert-dismissible" role="alert">
                                                <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                                                <?php echo e($errors->first()); ?>

                                            </div>
                                        <?php endif; ?>
                                    <?php endif; ?>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-xs-12">
                                    <table id="example1" class="table table-bordered table-striped">
                                        <thead>
                                        <tr>
                                            <th>SL No.</th>
                                            <th><?php echo e(trans('labels.Image')); ?></th>
                                            <th><?php echo \Kyslik\ColumnSortable\SortableLink::render(array ('categories_name', trans('labels.Category')));?></th>
                                            <th><?php echo \Kyslik\ColumnSortable\SortableLink::render(array ('item_name', trans('labels.Name')));?></th>
                                            <th><?php echo e(trans('labels.Additional info')); ?></th>
                                            <th>Added Date</th>
                                            <th>Action</th>
                                        </tr>
                                        </thead>
                                        <tbody>
                                        <?php if(count($results['menuitems'])>0): ?>
                                            <?php  $resultsItem = $results['menuitems']->unique('item_id')->keyBy('item_id');  ?>
                                            <?php $__currentLoopData = $results['menuitems']; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key=>$item): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                                <tr>
                                                    <td><?php echo e($loop->index+1); ?></td>
                                                    <td><img src="<?php echo e(asset($item->path)); ?>" alt="" height="50px"></td>
                                                    <td>
                                                        <?php echo e($item->categories_name); ?>

                                                    </td>
                                                    <td>
                                                        <?php echo e($item->item_name); ?>

                                                    </td>
                                                    <td>
                                                        
                                                        <strong><?php echo e(trans('labels.Price')); ?>: </strong>   
                                                        <?php echo e($item->item_price); ?>

                                                        <br>
                                                        <?php if(!empty($item->items_addons_id)): ?>
                                                            <strong class="badge bg-light-blue">Have Addons</strong><br>
                                                        <?php endif; ?>
                                                        <?php if($item->is_new==1): ?>
                                                        <strong class="badge bg-light-green">New Item</strong><br>
                                                        <?php endif; ?>
                                                    </td>
                                                    <td> <?php echo e($item->item_date_added); ?> </td>
                                                    <td>
                                                      <a class="btn btn-primary" style="width: 100%; margin-bottom: 5px;" href="<?php echo e(url('admin/menuitems/edit')); ?>/<?php echo e($item->item_id); ?>">Edit</a>
                                                      </br>
                                                      <?php if($item->items_addons_id>0): ?>
                                                          <a class="btn btn-info" style="width: 100%;  margin-bottom: 5px;" href="<?php echo e(url('admin/menuitems/addons/display')); ?>/<?php echo e($item->item_id); ?>">Addons</a>
                                                          </br>
                                                      <?php endif; ?>
                                                      <a class="btn btn-danger" style="width: 100%;  margin-bottom: 5px;" id="deleteProductId" products_id="<?php echo e($item->item_id); ?>">Delete</a>
                                                      </td>
                                                </tr>
                                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                        <?php else: ?>
                                            <tr>
                                                <td colspan="5"><?php echo e(trans('labels.NoRecordFound')); ?></td>
                                            </tr>
                                        <?php endif; ?>
                                        </tbody>
                                    </table>

                                </div>


                            </div>
                                <div class="col-xs-12" style="background: #eee;">


                                  <?php
                                    if($results['menuitems']->total()>0){
                                      $fromrecord = ($results['menuitems']->currentpage()-1)*$results['menuitems']->perpage()+1;
                                    }else{
                                      $fromrecord = 0;
                                    }
                                    if($results['menuitems']->total() < $results['menuitems']->currentpage()*$results['menuitems']->perpage()){
                                      $torecord = $results['menuitems']->total();
                                    }else{
                                      $torecord = $results['menuitems']->currentpage()*$results['menuitems']->perpage();
                                    }

                                  ?>
                                  <div class="col-xs-12 col-md-6" style="padding:30px 15px; border-radius:5px;">
                                    <div>Showing <?php echo e($fromrecord); ?> to <?php echo e($torecord); ?>

                                        of  <?php echo e($results['menuitems']->total()); ?> entries
                                    </div>
                                  </div>
                                <div class="col-xs-12 col-md-6 text-right">
                                    <?php echo e($results['menuitems']->links()); ?>

                                </div>
                              </div>
                        </div>
                        <!-- /.box-body -->
                    </div>
                    <!-- /.box -->
                </div>
                <!-- /.col -->
            </div>

            <!-- deleteProductModal -->
            <div class="modal fade" id="deleteproductmodal" tabindex="-1" role="dialog" aria-labelledby="deleteProductModalLabel">
                <div class="modal-dialog" role="document">
                    <div class="modal-content">
                        <div class="modal-header">
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                            <h4 class="modal-title" id="deleteProductModalLabel"><?php echo e(trans('labels.DeleteProduct')); ?></h4>
                        </div>
                        <?php echo Form::open(array('url' =>'admin/menuitems/delete', 'name'=>'deleteProduct', 'id'=>'deleteProduct', 'method'=>'post', 'class' => 'form-horizontal', 'enctype'=>'multipart/form-data')); ?>

                        <?php echo Form::hidden('action',  'delete', array('class'=>'form-control')); ?>

                        <?php echo Form::hidden('products_id',  '', array('class'=>'form-control', 'id'=>'products_id')); ?>

                        <div class="modal-body">
                            <p><?php echo e(trans('labels.DeleteThisProductDiloge')); ?>?</p>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-default" data-dismiss="modal"><?php echo e(trans('labels.Close')); ?></button>
                            <button type="submit" class="btn btn-primary" id="deleteProduct"><?php echo e(trans('labels.DeleteProduct')); ?></button>
                        </div>
                        <?php echo Form::close(); ?>

                    </div>
                </div>
            </div>
            <!-- /.row -->

            <!-- Main row -->

            <!-- /.row -->
        </section>
        <!-- /.content -->
    </div>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('admin.layout', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH D:\sohan_project\chawalah\resources\views/admin/menuitems/index.blade.php ENDPATH**/ ?>