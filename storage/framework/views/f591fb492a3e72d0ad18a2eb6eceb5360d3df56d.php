<?php $__env->startSection('contents'); ?>
  
<div class="container">
<a href="<?php echo e(url('menulist')); ?>">
  <div class="row justify-content-md-center">
  <img src="<?php echo e(asset('web/images/home.png')); ?>" class="img-fluid" />
  </div>
</a>
</div>

<?php $__env->stopSection(); ?>

<?php echo $__env->make('web.layouts.master', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH D:\sohan_project\chawalah\resources\views/web/index.blade.php ENDPATH**/ ?>