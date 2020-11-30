<?php $__env->startSection('content'); ?>
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <h1> Add Menuitems <small>Add Menuitems...</small> </h1>
        <ol class="breadcrumb">
            <li><a href="<?php echo e(URL::to('admin/dashboard')); ?>"><i class="fa fa-dashboard"></i> <?php echo e(trans('labels.breadcrumb_dashboard')); ?></a></li>
            <li><a href="<?php echo e(URL::to('admin/menuitems/display')); ?>"><i class="fa fa-database"></i> Listing all Menuitems</a></li>
            <li class="active">Add Menuitems</li>
        </ol>
    </section>

    <!-- Main content -->
    <section class="content">
        <div class="row">
            <div class="col-md-12">
                <div class="box">
                    <div class="box-header">
                        <h3 class="box-title">Add Menuitems </h3>
                    </div>

                    <!-- /.box-header -->
                    <div class="box-body">
                        <div class="row">
                            <div class="col-xs-12">
                                <div class="box box-info">
                                    <!-- form start -->
                                    <div class="box-body">
                                        <?php if( count($errors) > 0): ?>
                                        <?php $__currentLoopData = $errors->all(); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $error): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                        <div class="alert alert-danger" role="alert">
                                            <span class="glyphicon glyphicon-exclamation-sign" aria-hidden="true"></span>
                                            <span class="sr-only"><?php echo e(trans('labels.Error')); ?>:</span>
                                            <?php echo e($error); ?>

                                        </div>
                                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                        <?php endif; ?>

                                        <?php echo Form::open(array('url' =>'admin/menuitems/add', 'method'=>'post', 'class' => 'form-horizontal form-validate', 'enctype'=>'multipart/form-data')); ?>


                                        <div class="row">
                                            
                                               <div class="col-xs-12 col-md-6">
                                                    <div class="form-group">
                                                        <label for="name" class="col-sm-2 col-md-3 control-label">Category </label>
                                                        <div class="col-sm-10 col-md-8">
                                                            <select class="form-control" name="categories_id">
                                                                <option value="">Select Category</option>
                                                                <?php $__currentLoopData = $result['categories']; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $categories): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                                                <option value="<?php echo e($categories->categories_id); ?>"><?php echo e($categories->categories_slug); ?></option>
                                                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                                            </select><span class="help-block" style="font-weight: normal;font-size: 11px;margin-bottom: 0;">
                                                                Choose category at least one category.</span>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="col-xs-12 col-md-6">
                                                    <div class="form-group">
                                                        <label for="name" class="col-sm-2 col-md-3 control-label">Item Type<span style="color:red;">*</span></label>
                                                        <div class="col-sm-10 col-md-8">
                                                            <select class="form-control field-validate prodcust-type" name="item_type">
                                                                <option value=""><?php echo e(trans('labels.Choose Type')); ?></option>
                                                                <option value="0"><?php echo e(trans('labels.Simple')); ?></option>
                                                                <option value="1"><?php echo e(trans('labels.Variable')); ?></option>
                                                            </select><span class="help-block" style="font-weight: normal;font-size: 11px;margin-bottom: 0;">
                                                                Choose Variable for Add Addons with this Item otherwise chhose simple.</span>
                                                        </div>
                                                    </div>
                                                </div>

                                               
                                            </div>
                                           
                                        </div>
                                        <div class="row">
                                            <div class="col-xs-12 col-md-6">
                                                <div class="form-group">
                                                    <label for="name" class="col-sm-2 col-md-3 control-label">Item Name<span style="color:red;">*</span></label>
                                                    <div class="col-sm-10 col-md-8">
                                                        <?php echo Form::text('item_name', '', array('class'=>'form-control', 'id'=>'item_name')); ?>

                                                        <span class="help-block" style="font-weight: normal;font-size: 11px;margin-bottom: 0;">
                                                            <?php echo e(trans('labels.ProductPriceText')); ?>

                                                        </span>
                                                        <span class="help-block hidden">Enter Item Name In English</span>
                                                    </div>
                                                </div>
                                            </div>

                                            <div class="col-xs-12 col-md-6">
                                                <div class="form-group">
                                                    <label for="name" class="col-sm-2 col-md-3 control-label">Item Price<span style="color:red;">*</span></label>
                                                    <div class="col-sm-10 col-md-8">
                                                        <?php echo Form::text('item_price', '', array('class'=>'form-control number-validate', 'id'=>'item_price')); ?>

                                                        <span class="help-block" style="font-weight: normal;font-size: 11px;margin-bottom: 0;">
                                                            <?php echo e(trans('labels.ProductPriceText')); ?>

                                                        </span>
                                                        <span class="help-block hidden">Please enter only numreic value.</span>
                                                    </div>
                                                </div>
                                            </div>
                                            
                                        </div>
                                        

                                        <div class="row">
                                            <div class="col-xs-12 col-md-6 ">
                                                <div class="form-group">
                                                    <label for="name" class="col-sm-2 col-md-3 control-label"><?php echo e(trans('labels.Image')); ?><span style="color:red;">*</span></label>
                                                    <div class="col-sm-10 col-md-8">
                                                        <!-- Modal -->
                                                        <div class="modal fade" id="Modalmanufactured" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
                                                            <div class="modal-dialog" role="document">
                                                                <div class="modal-content">
                                                                    <div class="modal-header">
                                                                        <button type="button" class="close" data-dismiss="modal" id="closemodal" aria-label="Close"><span aria-hidden="true">×</span></button>
                                                                        <h3 class="modal-title text-primary" id="myModalLabel"><?php echo e(trans('labels.Choose Image')); ?></h3>
                                                                    </div>
                                                                    <div class="modal-body manufacturer-image-embed">
                                                                        <?php if(isset($allimage)): ?>
                                                                        <select class="image-picker show-html " name="image_id" id="select_img">
                                                                            <option value=""></option>
                                                                            <?php $__currentLoopData = $allimage; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key=>$image): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                                                            <option data-img-src="<?php echo e(asset($image->path)); ?>" class="imagedetail" data-img-alt="<?php echo e($key); ?>" value="<?php echo e($image->id); ?>"> <?php echo e($image->id); ?> </option>
                                                                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                                                        </select>
                                                                        <?php endif; ?>
                                                                    </div>
                                                                    <div class="modal-footer">

                                                                        <a href="<?php echo e(url('admin/media/add')); ?>" target="_blank" class="btn btn-primary pull-left"><?php echo e(trans('labels.Add Image')); ?></a>
                                                                        <button type="button" class="btn btn-default refresh-image"><i class="fa fa-refresh"></i></button>
                                                                        <button type="button" class="btn btn-primary" id="selected" data-dismiss="modal">Done</button>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>


                                                        <div id="imageselected">
                                                          <?php echo Form::button( trans('labels.Add Image'), array('id'=>'newImage','class'=>"btn btn-primary field-validate", 'data-toggle'=>"modal", 'data-target'=>"#Modalmanufactured" )); ?>

                                                          <br>
                                                          <div id="selectedthumbnail" class="selectedthumbnail col-md-5"> </div>
                                                          <div class="closimage">
                                                              <button type="button" class="close pull-left image-close " id="image-close"
                                                                style="display: none; position: absolute;left: 105px; top: 54px; background-color: black; color: white; opacity: 2.2; " aria-label="Close">
                                                                  <span aria-hidden="true">&times;</span>
                                                              </button>
                                                          </div>
                                                        </div>
                                                        <span class="help-block" style="font-weight: normal;font-size: 11px;margin-bottom: 0;"><?php echo e(trans('labels.UploadProductImageText')); ?></span>

                                                    </div>
                                                </div>
                                            </div>

                                            <div class="col-xs-12 col-md-6">
                                                <div class="form-group">
                                                    <label for="name" class="col-sm-2 col-md-3 control-label"><?php echo e(trans('labels.Status')); ?> </label>
                                                    <div class="col-sm-10 col-md-8">
                                                        <select class="form-control" name="item_status" required>
                                                            <option value="1"><?php echo e(trans('labels.Active')); ?></option>
                                                            <option value="0"><?php echo e(trans('labels.Inactive')); ?></option>
                                                        </select>
                                                        <span class="help-block" style="font-weight: normal;font-size: 11px;margin-bottom: 0;">
                                                            <?php echo e(trans('labels.SelectStatus')); ?></span>
                                                    </div>
                                                </div>
                                            </div>

                                        </div>
                                        <div class="row " style="margin-top: 20px;">
                                            <div class="col-xs-12 col-md-6">
                                                <div class="form-group">
                                                    <label for="name" class="col-sm-2 col-md-3 control-label">Is New?<span style="color:red;">*</span></label>
                                                    <div class="col-sm-10 col-md-8">
                                                        <select class="form-control field-validate prodcust-type" name="is_new">
                                                            <option value="">Choose</option>
                                                            <option value="1">Yes</option>
                                                            <option value="0">No</option>
                                                        </select><span class="help-block" style="font-weight: normal;font-size: 11px;margin-bottom: 0;">
                                                            Please choose 'yes' to set new with this item..</span>
                                                    </div>
                                                </div>
                                                </div>
                                            

                                        </div>
                                        <hr>

                                        <div class="row">
                                            <div class="col-xs-12">
                                                <div class="tabbable tabs-left">
                                                    <ul class="nav nav-tabs">
                                                        <li class="active"><a href="#product" data-toggle="tab">English<span style="color:red;">*</span></a></li>
                                                        
                                                    </ul>
                                                    <div class="tab-content">

                                                        <div style="margin-top: 15px;" class="tab-pane active" id="product_1">
                                                            <div class="">

                                                                <div class="form-group">
                                                                    <label for="name" class="col-sm-2 col-md-3 control-label"><?php echo e(trans('labels.Description')); ?><span style="color:red;">*</span> (English)</label>
                                                                    <div class="col-sm-10 col-md-8">
                                                                        <textarea id="editor" name="item_description" class="form-control" rows="5"></textarea>
                                                                        <span class="help-block" style="font-weight: normal;font-size: 11px;margin-bottom: 0;">
                                                                            Enter Item description in English</span>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>

                                                    </div>
                                                </div>
                                            </div>
                                        </div>

                                        <!-- /.box-body -->
                                        <div class="box-footer text-center">
                                            <button type="submit" class="btn btn-primary ">
                                                <span>Save</span>
                                            </button>
                                            <a href="<?php echo e(URL::to('admin/menuitems/display')); ?>" type="button" class="btn btn-default"><?php echo e(trans('labels.back')); ?></a>
                                        </div>

                                        <!-- /.box-footer -->
                                        <?php echo Form::close(); ?>

                                    </div>
                                </div>
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

        <!-- Main row -->

        <!-- /.row -->
    </section>
    <!-- /.content -->
</div>
<script src="<?php echo asset('admin/plugins/jQuery/jQuery-2.2.0.min.js'); ?>"></script>
<script type="text/javascript">
    $(function() {

        //bootstrap WYSIHTML5 - text editor
        CKEDITOR.replace('editor');
        $(".textarea").wysihtml5();

    });
</script>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('admin.layout', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH D:\sohan_project\chawalah\resources\views/admin/menuitems/add.blade.php ENDPATH**/ ?>