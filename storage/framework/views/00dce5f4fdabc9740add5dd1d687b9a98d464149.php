<aside class="main-sidebar sidebar-dark-primary elevation-4" style="background-color: #05353b;">
    <a href="<?php echo e(route('admin')); ?>" class="brand-link">
        <?php if(!env('IS_DEMO')): ?>
        <img src="<?php echo e(asset('theme/images/logo.png')); ?>"
             alt="AdminLTE Logo"
             class="brand-image img-circle elevation-3">
             <?php endif; ?>
        <span style="font-size: 17px;" class="brand-text font-weight-light"><?php echo e(env('IS_DEMO') ? 'AUR Restaurant' : 'menu'); ?></span>
    </a>

    <div class="sidebar">
        <nav class="mt-2">
            <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
                <?php echo $__env->make('layouts.menu', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
            </ul>
        </nav>
    </div>

</aside>


<?php /**PATH C:\Users\feso beso\Documents\berbene2\berbene\resources\views/layouts/sidebar.blade.php ENDPATH**/ ?>