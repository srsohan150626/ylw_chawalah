<?php $__env->startSection('content'); ?>
    <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <section class="content-header">
            <h1> Extras <small>Listing All The Extras Options...</small> </h1>
            <ol class="breadcrumb">
                <li><a href="<?php echo e(URL::to('admin/dashboard')); ?>"><i class="fa fa-dashboard"></i> <?php echo e(trans('labels.breadcrumb_dashboard')); ?></a></li>
                <li class="active">Extras</li>
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
                            <div class="col-lg-6 form-inline">
                                <form  name='registration' id="registration" class="registration" method="get" action="<?php echo e(url('admin/menuitems/extras/filter')); ?>">
                                    <input type="hidden" name="_token" value="<?php echo e(csrf_token()); ?>">
                                    <div class="input-group-form search-panel ">
                                        <select type="button" class="btn btn-default dropdown-toggle form-control input-group-form " data-toggle="dropdown" name="FilterBy" id="FilterBy" >
                                            <option value="" selected disabled hidden><?php echo e(trans('labels.Filter By')); ?></option>
                                            <option value="Name"  <?php if(isset($name)): ?> <?php if($name == "Name"): ?> <?php echo e('selected'); ?> <?php endif; ?> <?php endif; ?>><?php echo e(trans('labels.Name')); ?></option>
                                            <!-- <option value="Main"  <?php if(isset($name)): ?> <?php if($name == "Main"): ?> <?php echo e('selected'); ?> <?php endif; ?> <?php endif; ?>>Main Category</option> -->
                                        </select>
                                        <input type="text" class="form-control input-group-form " name="parameter" placeholder="<?php echo e(trans('labels.Search')); ?>..." id="parameter"  <?php if(isset($param)): ?> value="<?php echo e($param); ?>" <?php endif; ?> >
                                        <button class="btn btn-primary " id="submit" type="submit"><span class="glyphicon glyphicon-search"></span></button>
                                        <?php if(isset($param,$name)): ?>  <a class="btn btn-danger " href="<?php echo e(url('admin/menuitems/extras/display')); ?>"><i class="fa fa-ban" aria-hidden="true"></i> </a><?php endif; ?>
                                    </div>
                                </form>
                                <div class="col-lg-4 form-inline" id="contact-form12"></div>
                            </div>
                            <div class="box-tools pull-right">
                                <a href="<?php echo e(URL::to('admin/menuitems/extras/add')); ?>" type="button" class="btn btn-block btn-primary">Add Extras</a>
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
                                            <th><?php echo e(trans('labels.Name')); ?></th>
                                            <th><?php echo e(trans('labels.Image')); ?></th>
                                            <th><?php echo \Kyslik\ColumnSortable\SortableLink::render(array ('status', trans('labels.Status')));?></th>
                                            <th><?php echo e(trans('labels.Action')); ?></th>
                                        </tr>
                                        </thead>
                                        <tbody>
                                        <?php if(count($extraoptions)>0): ?>
                                            <?php $__currentLoopData = $extraoptions; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key=>$extra): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                                    <tr>
                                                    <td><?php echo e($loop->index+1); ?></td>
                                                        <td><?php echo e($extra->extra_options_name); ?></td>
                                                        <td><img src="<?php echo e(asset($extra->imgpath)); ?>" alt="" width=" 100px"></td>
                                                        <td>
                                                          <?php if($extra->extra_options_status==1): ?>
                                                          <span class="label label-success">
                                                            <?php echo e(trans('labels.Active')); ?>

                                                          </span>
                                                          <?php elseif($extra->extra_options_status==0): ?>
                                                          <span class="label label-danger">
                                                              <?php echo e(trans('labels.InActive')); ?>

                                                          <?php endif; ?>
                                                        </td>
                                                        <td>
                                                            <a data-toggle="tooltip" data-placement="bottom" title="Edit" href="<?php echo e(url('admin/menuitems/extras/edit/'. $extra->extra_options_id)); ?>" class="badge bg-light-blue"><i class="fa fa-pencil-square-o" aria-hidden="true"></i></a>
                                                            
                                                            <?php if($extra->extra_options_id >0 ): ?><a id="delete" category_id="<?php echo e($extra->extra_options_id); ?>" href="#" class="badge bg-red " ><i class="fa fa-trash" aria-hidden="true"></i></a><?php endif; ?>
                                                        </td>
                                                    </tr>

                                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                        <?php else: ?>
                                            <tr>
                                                <td colspan="7"><?php echo e(trans('labels.NoRecordFound')); ?></td>
                                            </tr>
                                        <?php endif; ?>
                                        </tbody>
                                    </table>
                                    <?php if($extraoptions != null): ?>
                                      <div class="col-xs-12 text-right">
                                          <?php echo e($extraoptions->links()); ?>

                                      </div>
                                    <?php endif; ?>
                                </div>
                            </div>
                        </div>
                        <!-- /.box-body -->
                    </div>
                    <!-- /.box -->
                </div>
                <!-- /.col -->
            </div>
            <!-- /.row -->

            <div class="modal fade" id="deleteModal" tabindex="-1" role="dialog" aria-labelledby="deleteModalLabel">
                <div class="modal-dialog" role="document">
                    <div class="modal-content">
                        <div class="modal-header">
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                            <h4 class="modal-title" id="deleteModalLabel"><?php echo e(trans('labels.Delete')); ?></h4>
                        </div>
                        <?php echo Form::open(array('url' =>'admin/menuitems/extras/delete', 'name'=>'deleteBanner', 'id'=>'deleteBanner', 'method'=>'post', 'class' => 'form-horizontal', 'enctype'=>'multipart/form-data')); ?>

                        <?php echo Form::hidden('action',  'delete', array('class'=>'form-control')); ?>

                        <?php echo Form::hidden('id',  '', array('class'=>'form-control', 'id'=>'category_id')); ?>

                        <div class="modal-body">
                            <p><?php echo e(trans('labels.DeleteText')); ?></p>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-default" data-dismiss="modal"><?php echo e(trans('labels.Close')); ?></button>
                            <button type="submit" class="btn btn-primary" id="deleteBanner"><?php echo e(trans('labels.Delete')); ?></button>
                        </div>
                        <?php echo Form::close(); ?>

                    </div>
                </div>
            </div>

            <!-- Main row -->

            <!-- /.row -->
        </section>
        <!-- /.content -->
    </div>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('admin.layout', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH D:\sohan_project\chawalah\resources\views/admin/extraoptions/index.blade.php ENDPATH**/ ?>