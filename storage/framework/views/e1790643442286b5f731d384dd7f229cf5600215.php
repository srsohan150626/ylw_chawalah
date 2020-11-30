<?php $__env->startPush('style'); ?>
<style>
    .btnbk {
  position: absolute;
  top: 5%;
  left: 10%;
  transform: translate(-50%, -50%);
  -ms-transform: translate(-50%, -50%);
  color: white;
  font-size: 16px;
  padding: 12px 24px;
  border: none;
  cursor: pointer;
  border-radius: 5px;
  text-align: left;
}

.btnbk:hover {
  background-color: black;
}}
</style>
<?php $__env->stopPush(); ?>
<?php $__env->startSection('contents'); ?>

<div class="container">
  <img src="<?php echo e(asset($menuitems[0]->imgpath)); ?>" class = "img-fluid" alt="Responsive image">
  <a href="javascript:history.back()" class="btn btn-danger btn-sm btnbk"><i class="fa fa-home" aria-hidden="true"></i></a>
  <div class="text-center mt-4">
      <?php if($menuitems[0]->is_new==1): ?>
      <small class="badge badge-pill badge-danger">New</small>
      <?php endif; ?>
        <h1><?php echo e($menuitems[0]->item_name); ?></h1> 
    <h1><?php echo e($menuitems[0]->item_price); ?></h1>
  </div>
  <div class="text-center mt-2"> 
    <span style="font-size: larger;"><?=stripslashes($menuitems[0]->item_description)?> </span>
  </div>

  <?php if(count($extras)>0): ?>
  <div class="text-left mt-2">
    <h3>EXTRAS</h3>
    <?php echo e($menuitems[0]->item_name); ?> ADD ONS

    <?php $__currentLoopData = $extras; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $item): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
    <div class="radio">
        <label><input type="radio" name="optradio"> <?php echo e($item->extra_options_name); ?></label>
        <span style="margin-left: 150px;">Tk. <?php echo e($item->extra_options_price); ?></span>
    </div>
    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
    

  </div>
  <?php endif; ?>
  

</div>

<?php $__env->startPush('scripts'); ?>

<?php $__env->stopPush(); ?>
  

<?php $__env->stopSection(); ?>
<?php echo $__env->make('web.layouts.master', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH D:\sohan_project\chawalah\resources\views/web/itemsdetails.blade.php ENDPATH**/ ?>