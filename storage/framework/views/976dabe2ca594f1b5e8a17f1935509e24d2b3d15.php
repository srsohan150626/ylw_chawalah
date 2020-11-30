<?php $__env->startPush('style'); ?>
<style type="text/css">

.circular-square {
  border-radius: 50%;
}
@media (max-width:767px) {
  .listitem img {
    max-width: 40%;
    max-height: 43%;
  }
  .itemdetails{
    margin-top: 45px;
    margin-left: 20px;
}
}

@media (min-width:768px) {
  .listitem img {
    max-width: 300px;
    max-height: 230px;
  }
  .itemdetails{
      margin-top: 45px;
      margin-left: 20px;
  }
}

@media (min-width:992px) {
  .listitem img {
    max-width: 300px;
    max-height: 200px;
  }
  .itemdetails{
    margin-top: 80px;
    margin-left: 30px;
    font-size: larger;
  }
}

@media (min-width:1200px) {
  .listitem img {
    max-width: 350px;
    max-height: 250px;
  }
  .itemdetails{
    margin-top: 80px;
    margin-left: 30px;
    font-size: larger;
  }
}

</style>
<style type="text/css">
    html, body {
      margin: 0;
      padding: 0;
    }

    * {
      box-sizing: border-box;
    }

    .slider {
        width: 100%;
        margin: 100px auto;
    }

    .slick-slide {
      margin: 0px 20px;
    }

    .slick-slide img {
      width: 100%;
      height: 130px;
      border-radius: 50%;
    }

    .slick-prev:before,
    .slick-next:before {
      color: black;
    }


    .slick-slide {
      transition: all ease-in-out .3s;
      opacity: .2;
    }
    
    .slick-active {
      opacity: .5;
    }

    .slick-current {
      opacity: 1;
    }

    .sticky {
      position: -webkit-sticky;
      position: sticky;
      top: 0;
      
      /* //width: 200px; */
    }
   
  </style>
  <style>
    <style> 
        #loader { 
            border: 12px solid #f3f3f3; 
            border-radius: 50%; 
            border-top: 12px solid #444444; 
            width: 70px; 
            height: 70px; 
            animation: spin 1s linear infinite; 
        } 
          
        @keyframes  spin { 
            100% { 
                transform: rotate(360deg); 
            } 
        } 
          
        .center { 
            position: absolute; 
            top: 0; 
            bottom: 0; 
            left: 0; 
            right: 0; 
            margin: auto; 
        } 
    </style> 
  </style>
<?php $__env->stopPush(); ?>
<?php $__env->startSection('contents'); ?>
<div id="loader" class="center"></div> 
  <div class="container my-4">
  <section class="regular slider sticky"  style="background-color: #F0EDE4;">
    
    <?php $__currentLoopData = $categories; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $item): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
  
      <div>
        <img src="<?php echo e(asset($item->imgpath)); ?>">
        <a href="#<?php echo e($item->categories_name); ?>" ><p class="text-center" style="color: black;"><?php echo e($item->categories_name); ?></p></a>
      </div>
    
      
    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
    
  </section>

<div class="container mt-4 ml-4 listitem" >    

  <?php
  $previous_category="";
  ?>

  <?php $__currentLoopData = $menuitems; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key=>$item): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
  <?php if($previous_category != $item->categories_name): ?>
  <div class="text-center mt-4">
    <h3 id="<?php echo e($item->categories_name); ?>" ><span class="badge badge-pill badge-warning"><?php echo e($item->categories_name); ?></span> </h3>
  </div>
  <?php endif; ?>
    <div class="row mt-1">
        <img src="<?php echo e(asset($item->imgpath)); ?>" class="circular-square" alt="Cinque Terre" > 
        <div class="itemdetails">
          <div class="row"> 
            <?php if($item->is_new==1): ?>
            <small class="badge badge-pill badge-danger">New</small>
            <a href="<?php echo e(URL::to('/menulist/'.$item->item_slug)); ?>"><strong><p style="color: black;margin-bottom: 0px; margin-left: 10px;" ><?php echo e($item->item_name); ?></p> </strong></a>
            <?php else: ?> 
            <a href="<?php echo e(URL::to('/menulist/'.$item->item_slug)); ?>"><strong><p style="color: black;margin-bottom: 0px;margin-left: 10px;" ><?php echo e($item->item_name); ?></p> </strong></a>
            <?php endif; ?>
          </div>
          <?php if($item->is_new==1): ?>
            <strong><p style="margin-left: 50px;">Tk. <?php echo e($item->item_price); ?></p> 
          <?php else: ?> 
            <strong><p style="margin-left: -3px;">Tk. <?php echo e($item->item_price); ?></p>
          <?php endif; ?>
        </div>
    </div>  
            <?php
              $previous_category = $item->categories_name;
            ?>
    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>    
         
  
</div>
  </div>

  <?php $__env->startPush('scripts'); ?>
  <script src="<?php echo e(asset('web/slick/slick.js')); ?>" type="text/javascript" charset="utf-8"></script>
  <script type="text/javascript">
    $(document).on('ready', function() {
        $('.regular').slick({
        dots: true,
        infinite: true,
        autoplay: true,
        speed: 3,
        slidesToShow: 5,
        slidesToScroll: 5,
        responsive: [
          {
            breakpoint: 1024,
            settings: {
              slidesToShow: 5,
              slidesToScroll: 5,
              infinite: true,
              dots: true
            }
          },
          {
            breakpoint: 600,
            settings: {
              slidesToShow: 2,
              slidesToScroll: 2
            }
          },
          {
            breakpoint: 480,
            settings: {
              slidesToShow: 2,
              slidesToScroll: 2
            }
          }
          // You can unslick at a given breakpoint now by adding:
          // settings: "unslick"
          // instead of a settings object
        ]
      });
     
    });
</script>
<script> 
  document.onreadystatechange = function() { 
      if (document.readyState !== "complete") { 
          document.querySelector("body").style.visibility = "hidden"; 
          document.querySelector("#loader").style.visibility = "visible"; 
      } else { 
          document.querySelector("#loader").style.display = "none"; 
          document.querySelector("body").style.visibility = "visible"; 
      } 
  }; 
</script> 
  <?php $__env->stopPush(); ?>
  

  <?php $__env->stopSection(); ?>
<?php echo $__env->make('web.layouts.master', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH D:\sohan_project\backup\New folder\fresh_chwla\resources\views/web/menuitems.blade.php ENDPATH**/ ?>