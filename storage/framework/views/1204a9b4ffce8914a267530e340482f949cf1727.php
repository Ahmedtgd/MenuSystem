<?php $dash.='-- '; ?>
<?php $__currentLoopData = $subcategories; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $subcategory): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
    <option value="<?php echo e($subcategory->id); ?>"><?php echo e($subcategory->title); ?></option>
    <!-- <option value="<?php echo e($subcategory->id); ?>"><?php echo e($dash); ?><?php echo e($subcategory->title); ?></option> -->
    <!-- <?php if(count($subcategory->subcategory)): ?>
        <?php echo $__env->make('subCategoryList-option',['subcategories' => $subcategory->subcategory], \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
    <?php endif; ?> -->
<?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?><?php /**PATH C:\Users\feso beso\Documents\berbene2\berbene\resources\views/subcategoryList-option.blade.php ENDPATH**/ ?>