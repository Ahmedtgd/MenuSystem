<?php
$locale = App::getLocale();
$align_class = $locale == 'en' ? 'text-left' : 'text-right';
$float_class = $locale == 'en' ? 'float-right' : 'float-left';
$rtl = false;
if($locale == 'en')
{
    $rtl = 'rtl: false,';
}
if($locale == 'ar')
{
    $rtl = 'rtl: true,';
}
?>
<style>
    #accordion .card{
        border: none;
    }
    #accordion .card-header{
        border-top: 1px solid lightgray;
    border-right: 1px solid lightgray;
    border-left: 1px solid lightgray;
    padding: 5px 0px 5px 0px;
    }
    .card-header.collapse-card-header{
        padding: 0;
        display: block;
    }
    .float-left{
        float: left;
    }
    .float-right{
        float: right;
    }
    .down-arrow{
        /* float: right; */
    }
    .collapse-button{
        display: block;
        width: 100%;
        /* text-align: left; */
        color: rgb(230, 3, 75);
        font-weight: bold;
    }
    .product-item{
        padding: 0px;
    }
    .product-image{
        height: 220px;
    }
    .product-detail{
        padding: 14px;
    }
    .product-item .product-image{
        border-radius: 0px;
    }
    @media  screen and (max-width: 575px) {
        .product-image{
            height: 100%;
        }
        .product-item{
            min-height: 97px;
        }
    }
</style>
<div class="row">
    <div class="col-md-12">
        <div class="products-listing-home">
            <h3 class="current-category-title text-center"><?php echo e($locale == 'en' ? ucwords($category->title) : $category->title_ar); ?></h3>
                <!-- <h5 class="current-category-desc text-center">(All prices are inclusive of 5% VAT)</h5> -->
        </div>    
    </div>
</div>
<div id="accordion">
  <?php $__currentLoopData = $category->subcategory; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $subcat): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
  <div class="card">
    <div class="card-header collapse-card-header mb-2" id="heading-<?php echo e($subcat->id); ?>">
      <h5 class="mb-0 pb-0">
        <button class="btn btn-link collapse-button <?php echo e($align_class); ?>" data-toggle="collapse" data-target="#collapse-<?php echo e($subcat->id); ?>" aria-expanded="true" aria-controls="collapseOne">
          <?php echo e($locale == 'en' ? ucwords($subcat->title) : $subcat->title_ar); ?>

          <i class="fa fa-chevron-down down-arrow <?php echo e($float_class); ?>"></i>
        </button>
        
      </h5>
    </div>

    <div id="collapse-<?php echo e($subcat->id); ?>" class="collapse" aria-labelledby="headingOne" data-parent="#accordion">
      <div class="card-body">
      <?php if(count($subcat->products)): ?>
<?php $__currentLoopData = $subcat->products; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $product): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
    <div class="row mt-4">
        <div class="col-md-12">
            <a class="product-link" href="<?php echo e(route('productDetail', $product->translationId)); ?>">
                <div class="product-item">
                    <div class="row">
                        <div class="col-md-7 col-lg-8 col-7 <?= $locale == 'ar' ? 'order-3' : ''?> <?php echo e($align_class); ?>">
                            <div class="product-detail">
                                <h4 class="product-title"><?php echo e($locale == 'en' ? ucwords($product->title) : $product->title_ar); ?></h4>
                                <!-- <p class="prodcut-desc"><?php echo e($locale == 'en' ? ($product->nutritionInfo != "" ? \Illuminate\Support\Str::limit(strip_tags(html_entity_decode($product->nutritionInfo)), 200) : "") : ($product->nutritionInfo_ar != "" ? \Illuminate\Support\Str::limit(strip_tags(html_entity_decode($product->nutritionInfo_ar)), 200) : "")); ?></p> -->
                                <p class="product-price"><?php echo e(number_format($product->price)); ?> IQD</p>
                            </div>
                        </div>
                        <div class="col-md-5 col-lg-4 col-5">
                            <?php
                            $url = asset('uploads/product/'.$product->thumbnail);
                            ?>
                            <div class="product-image" style="background-image: url('<?php echo e($url); ?>'); background-repeat: no-repeat; background-position: center; background-size: cover;"></div>
                        </div>
                    </div>
                </div>
            </a>
        </div>
    </div>
    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
<?php else: ?>
<h3 class="text-center"><?php echo e(__('site.no_products_found')); ?> <?php echo e($locale == 'en' ? ucwords($subcat->title) : $subcat->title_ar); ?></h3>
<?php endif; ?>
      </div>
    </div>
  </div>
  <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
</div><?php /**PATH C:\Users\feso beso\Documents\berbene2\berbene\resources\views/frontend/subcategoriesAjax.blade.php ENDPATH**/ ?>