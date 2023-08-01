<li class="nav-item ">
    <a href="<?php echo e(route('allSliders')); ?>" class="nav-link <?php echo e((request()->is('sliders')) ? 'active' : ''); ?>">
    <i class="nav-icon fas fa-sliders-h"></i>
        <p>Sliders</p>
    </a>
</li>
<li class="nav-item">
    <a href="<?php echo e(route('allCategories')); ?>" class="nav-link  <?php echo e((request()->is('categories')) ? 'active' : ''); ?>">
        <i class="nav-icon fas fa-list-alt"></i>
        <p>Categories</p>
    </a>
</li>
<li class="nav-item">
    <a href="<?php echo e(route('tags.index')); ?>" class="nav-link  <?php echo e((request()->is('tags.index')) ? 'active' : ''); ?>">
        <i class="nav-icon fas fa-list-alt"></i>
        <p>Tags</p>
    </a>
</li>
<li class="nav-item">
            <a href="#" class="nav-link <?php echo e((request()->is('products')) ? 'active' : ''); ?>">
            <i class="nav-icon fab fa-product-hunt"></i>
              <p>
                Products
                <i class="fas fa-angle-left right"></i>
              </p>
            </a>
            <ul class="nav nav-treeview" style="display: none;">
              <li class="nav-item">
                <a href="<?php echo e(route('allProducts')); ?>" class="nav-link">
                  <i class="fa fa-list nav-icon"></i>
                  <p>All products</p>
                </a>
              </li>
              <li class="nav-item">
                <a href="<?php echo e(route('orderedProducts')); ?>" class="nav-link">
                  <i class="fa fa-sort nav-icon"></i>
                  <p>Ordering</p>
                </a>
              </li>
            </ul>
          </li>
<li class="nav-item ">
    <a href="<?php echo e(route('allFeedbacks')); ?>" class="nav-link <?php echo e((request()->is('feedbacks')) ? 'active' : ''); ?>">
        <i class="nav-icon fa fa-star"></i>
        <p>Feedback</p>
    </a>
    
</li>
<li class="nav-item ">
    <a href="<?php echo e(route('allDevices')); ?>" class="nav-link <?php echo e((request()->is('devices')) ? 'active' : ''); ?>">
        <i class="nav-icon fa fa-mobile"></i>
        <p>Devices</p>
    </a>
    
</li>

<li class="nav-item ">
    <a href="<?php echo e(route('updateApkPassword')); ?>" class="nav-link <?php echo e((request()->is('apk-password')) ? 'active' : ''); ?>">
        <i class="nav-icon fa fa-key"></i>
        <p>Update APK Password</p>
    </a>
    
</li>
<?php /**PATH C:\Users\feso beso\Documents\berbene2\berbene\resources\views/layouts/menu.blade.php ENDPATH**/ ?>