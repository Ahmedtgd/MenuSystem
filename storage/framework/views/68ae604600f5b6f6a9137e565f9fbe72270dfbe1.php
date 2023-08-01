<?php
use App\Models\Product;
use App\Models\Category;
$dash .= '-- ';?>
<?php $__currentLoopData = $subcategories; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $subcategory): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
<?php $_SESSION['i'] = $_SESSION['i'] + 1; 
    $prod_count = Product::where('categoryId', $subcategory->translationId)->where('language', $subcategory->language)->count();
    $count = Category::where('translationId', $subcategory->translationId)->count();
?>
                                <tr class="row1 group" data-id="<?php echo e($subcategory->id); ?>">
    <td></td>
    <td>
    <a href="<?php echo e(asset('uploads/category/'.$subcategory->image)); ?>" data-lightbox="myImg<?php echo $subcategory->id;?>" data-title="<?php echo e($subcategory->title); ?>">
                                        <img src="<?php echo e(asset('uploads/category/'.$subcategory->thumbnail)); ?>" width="150" data-lightbox="myImg<?php echo $subcategory->id;?>"/>
                                        </a>    
</td>
    <td><?php echo e($dash); ?><?php echo e($subcategory->title); ?></td>
    <td><?php echo e($dash); ?><?php echo e($subcategory->title_ar); ?></td>
    
    <td><?php echo e($subcategory->parent->title); ?></td>
    <td><?php echo e($prod_count); ?></td>
    <td>
        <a href="<?php echo e(Route('editCategory', $subcategory->id)); ?>">
            <button class="btn btn-sm btn-info">Edit</button>
        </a>
        <a href="<?php echo e(Route('deleteCategory', $subcategory->id)); ?>">
            <button class="btn btn-sm btn-danger">Delete</button>
        </a>
    </td>
</tr>
<?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?><?php /**PATH C:\Users\feso beso\Documents\berbene2\berbene\resources\views/sub-category-list.blade.php ENDPATH**/ ?>