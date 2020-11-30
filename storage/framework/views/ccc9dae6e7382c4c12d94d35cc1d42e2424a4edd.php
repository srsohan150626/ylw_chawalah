<?php $__env->startSection('content'); ?>
    <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <section class="content-header">
            <h1> Add Addons <small>Add Addons...</small> </h1>
            <ol class="breadcrumb">
                <li><a href="<?php echo e(URL::to('admin/dashboard')); ?>"><i class="fa fa-dashboard"></i> <?php echo e(trans('labels.breadcrumb_dashboard')); ?></a></li>
                <li><a href="<?php echo e(URL::to('admin/menuitems/display')); ?>">Listing all Menuitems</a></li>
                <li class="active">Add Addons</li>
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
                            <h3 class="box-title">Listing all Addonss </h3>
                            <div class="box-tools pull-right">
                                <button type="button" class="btn btn-block btn-primary" data-toggle="modal" data-target="#adddefaultattributesmodal">
                                   Add Addons
                                </button>
                            </div>
                        </div>

                        <!-- /.box-header -->
                        <div class="box-body">
                            <div class="row">
                                <div class="col-xs-12">

                                </div>
                            </div>
                            <div class="row">
                                <div class="col-xs-12">
                                    <table id="example1" class="table table-bordered table-striped">
                                        <thead>
                                        <tr>
                                            <th>SL No.</th>
                                            <th><?php echo e(trans('labels.OptionName')); ?></th>
                                            <th>Price</th>
                                            <th><?php echo e(trans('labels.Action')); ?></th>
                                        </tr>
                                        </thead>
                                        <tbody class="contentDefaultAttribute">

                                        <?php if(count($result['item_addons']) > 0): ?>
                                            <?php $__currentLoopData = $result['item_addons']; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key=>$item_addons): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                           
                                                    <tr>
                                                        <td><?php echo e(++$key); ?></td>
                                                        <td><?php echo e($item_addons->extra_options_name); ?></td>
                                                        <td><?php echo e($item_addons->extra_options_price); ?></td>
                                                        <td>
                                                            <a class="badge bg-light-blue editdefaultattributemodal" products_id = '<?php echo e($item_addons->item_id); ?>' products_attributes_id = "<?php echo e($item_addons->items_addons_id); ?>"  options_id = '<?php echo e($item_addons->extra_options_id); ?>' ><i class="fa fa-pencil-square-o" aria-hidden="true"></i></a>
                                                            <a products_id = '<?php echo e($item_addons->item_id); ?>' products_attributes_id = "<?php echo e($item_addons->items_addons_id); ?>" class="badge bg-red deletedefaultattributemodal"><i class="fa fa-trash " aria-hidden="true"></i></a></td>
                                                    </tr>
                                            
                                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                        <?php else: ?>
                                            <tr>
                                                <td colspan="5"><strong>
                                                        There is no addons added yet for this Menuitem</strong>
                                                </td>
                                            </tr>
                                        <?php endif; ?>
                                        </tbody>
                                    </table>

                                    <!-- adddefaultattributesmodal -->
                                    <div class="modal fade" id="adddefaultattributesmodal" tabindex="-1" role="dialog" aria-labelledby="addAttributeModalLabel">
                                        <div class="modal-dialog" role="document">
                                            <div class="modal-content">
                                                <div class="modal-header">
                                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                                                    <h4 class="modal-title" id="addAttributeModalLabel"><?php echo e(trans('labels.AddOptions')); ?></h4>
                                                </div>
                                                <?php echo Form::open(array('url' =>'admin/products/attach/addons/add', 'name'=>'addattributefrom', 'id'=>'adddefaultattributefrom', 'method'=>'post', 'class' => 'form-horizontal form-validate', 'enctype'=>'multipart/form-data')); ?>

                                                <?php echo Form::hidden('item_id',  $result['data']['item$item_id'], array('class'=>'form-control', 'id'=>'products_id')); ?>


                                                <div class="modal-body">

                                                    <div class="form-group">
                                                        <label for="name" class="col-sm-2 col-md-4 control-label">
                                                            <?php echo e(trans('labels.OptionName')); ?>

                                                        </label>
                                                        <div class="col-sm-10 col-md-8">
                                                            <select class="form-control default-option-id field-validate" name="extra_options_id">
                                                                <option value="" class="field-validate">Chose Addons</option>
                                                                <?php $__currentLoopData = $result['options']; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $option): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                                                    <option value="<?php echo e($option->extra_options_id); ?>"><?php echo e($option->extra_options_name); ?></option>
                                                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                                            </select><span class="help-block" style="font-weight: normal;font-size: 11px;margin-bottom: 0;">
                                                        please select items addons
                                                        </span>

                                                        </div>
                                                    </div>

                                                    <div class="form-group">
                                                        <label for="name" class="col-sm-2 col-md-4 control-label">Addons Price</label>
                                                        <div class="col-sm-10 col-md-8">
                                                            <?php echo Form::text('extra_options_price', '', array('class'=>'form-control', 'id'=>'extra_options_price')); ?>

                                                            <span class="help-block" style="font-weight: normal;font-size: 11px;margin-bottom: 0;">
                                                            Enter addons price</span>
                                                        </div>
                                                    </div>

                                                    <div class="alert alert-danger addDefaultError" style="display: none; margin-bottom: 0;" role="alert"><i class="icon fa fa-ban"></i><span></span> </div>
                                                </div>
                                                <div class="modal-footer">
                                                    <button type="button" class="btn btn-default" data-dismiss="modal"><?php echo e(trans('labels.Close')); ?></button>
                                                    <button type="button" class="btn btn-primary" id="addDefaultAttribute"><?php echo e(trans('labels.AddOption')); ?></button>
                                                </div>
                                                <?php echo Form::close(); ?>

                                            </div>
                                        </div>
                                    </div>

                                    <!-- editdefaultattributemodal -->
                                    <div class="modal fade" id="editdefaultattributemodal" tabindex="-1" role="dialog" aria-labelledby="editdefaultattributemodalLabel">
                                        <div class="modal-dialog" role="document">
                                            <div class="modal-content editDefaultContent">

                                            </div>
                                        </div>
                                    </div>

                                    <!-- deletedefaultattributemodal -->
                                    <div class="modal fade" id="deletedefaultattributemodal" tabindex="-1" role="dialog" aria-labelledby="deletedefaultattributemodalLabel">
                                        <div class="modal-dialog" role="document">
                                            <div class="modal-content deleteDefaultEmbed">

                                            </div>
                                        </div>


                                    </div>

                                </div>
                            </div>
                            <!-- /.box-body -->
                            <div class="box-footer text-center">
                                <a href="<?php echo e(URL::to("admin/menuitems/display")); ?>" class="btn btn-default pull-left"><i class="fa fa-angle-left"></i> Save & Complete </a>
                                
                            </div>

                        </div>
                        <!-- /.box -->
                    </div>
                    <!-- /.col -->
                </div>
                <!-- /.row -->

                <!-- Main row -->
            </div>

    <!-- /.row -->
    </section>
    <!-- /.content -->
    </div>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('admin.layout', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH D:\sohan_project\chawalah\resources\views/admin/menuitems/addons/add.blade.php ENDPATH**/ ?>