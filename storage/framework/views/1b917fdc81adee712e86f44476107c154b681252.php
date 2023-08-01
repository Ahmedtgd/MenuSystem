<?php
use App\Models\Category;
use App\Models\Product;
?>

<?php $__env->startSection('content'); ?>


<div class="content-wrapper" style="min-height: 375px;">
    <!-- Content Header (Page header) -->
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    
                </div><!-- /.col -->
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="#">Home</a></li>
                        <li class="breadcrumb-item active">Categories</li>
                    </ol>
                </div><!-- /.col -->
            </div><!-- /.row -->
        </div><!-- /.container-fluid -->
    </div>
    <h3 class="m-0 text-center">All Categories</h3>

    <section class="content  table-responsive" style="border-radius: 10px;">
        <div  class="row">
            <div class="col-md-12">
                <div class="box box-primary" style="border-radius: 10px;">
                <?php if($errors->any()): ?>
                    <div>
                        <?php $__currentLoopData = $errors->all(); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $error): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                        <li class="alert alert-danger"><?php echo e($error); ?></li>
                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                    </div>
                    <?php endif; ?>
                    <?php if(\Session::has('error')): ?>
                    <div>
                        <li class="alert alert-danger"><?php echo \Session::get('error'); ?></li>
                    </div>
                    <?php endif; ?>
                    <?php if(\Session::has('success')): ?>
                    <div>
                        <li class="alert alert-success"><?php echo \Session::get('success'); ?></li>
                    </div>
                    <?php endif; ?>
                    <div class="box-header with-border" style="border-radius: 10px;">
                        <a class="add-new" href="<?php echo e(Route('createCategory')); ?>">
                            <button class="btn btn-primary btn-xs">Add New Category</button>
                        </a>
                    </div>
                    <div class="box-body" style="border-radius: 10px;">
                        <table class="table table-bordered  " style="border-radius: 10px;" id="dataTable">
                            <thead>
                                <tr>
                                    <!-- <th>Update Ordering</th> -->
                                    <th>#</th>
                                    <th>Category Image</th>
                                    <th>Category Name</th>
                                    <th>Arabic Name</th>
                                    <th>Parent Category</th>
                                    <th>Products Count</th>
                                    
                                    <!-- <th>Parent Category</th>  -->
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody id="tablecontents">
                                <?php if(isset($categories)): ?>
                                <?php $_SESSION['i'] = 0; $color_count = 0;?>
                                <?php $__currentLoopData = $categories; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $category): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                <?php $_SESSION['i'] = $_SESSION['i'] + 1;
                                $prod_count = Product::where('categoryId', $category->translationId)->where('language', $category->language)->count();
                                $count = Category::where('translationId', $category->translationId)->count();
                                ?>
                                <tr class="row1" data-id="<?php echo e($category->id); ?>">
                                    <?php $dash = ''; ?>
                                    <!-- <td>
                                    <form action="<?php echo e(Route('updateOrder')); ?>" type="POST">
                                    <div class="row">
                                        <div class="col-md-12">
                                            <div class="row">
                                                <div class="col-md-4">
                                                    <input type="hidden" name="id" value="<?php echo e($category->id); ?>"/>
                                                    <input class="form-control" placeholder="Order" style="font-size: 12px;" type="number" min="1" max="<?php echo e($max); ?>" name="order"/>
                                                </div>
                                                <div class="col-md-8">
                                                    <button type="submit" class="btn btn-sm btn-success" style="min-height: 38px;">Update Order</button>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    </form>  
                                    </td> -->
                                    <td><i class="fa fa-sort"></i></td>
                                    <!-- <td><?php echo e($category->order); ?></td> -->
                                    <td>
                                    <a href="<?php echo e(asset('uploads/category/'.$category->image)); ?>" data-lightbox="myImg<?php echo $category->id;?>" data-title="<?php echo e($category->title); ?>">
                                        <img src="<?php echo e(asset('uploads/category/'.$category->thumbnail)); ?>" width="150" style="border-radius: 10px;"  data-lightbox="myImg<?php echo $category->id;?>"/>
                                        </a>    
                                </td>
                                    <td><?php echo e($category->title); ?></td>
                                    <td><?php echo e($category->title_ar); ?></td>
                                    <td>
                                        <?php if(isset($category->parentId)): ?>
                                            <?php echo e(isset($category->parent->title) ? $category->parent->title : '-'); ?>

                                        <?php else: ?>
                                            None
                                        <?php endif; ?>
                                    </td>
                                    <td><?php echo e($prod_count); ?></td>
                                    <td>
                                        <a href="<?php echo e(Route('editCategory', $category->id)); ?>">
                                            <button class="btn btn-sm btn-info">Edit</button>
                                        </a>
                                        &nbsp;&nbsp;
                                        <a onclick="deleteCategory(<?php echo e($category->id); ?>)" href="#">
                                            <button class="btn btn-sm btn-danger">Delete</button>
                                        </a>
                                    </td>
                                </tr>
                                <?php if(count($category->subcategory)): ?>
                                     <?php echo $__env->make('sub-category-list',['subcategories' => $category->subcategory, 'color_count' => $color_count], \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
                                 <?php endif; ?>

                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                <?php unset($_SESSION['i']); ?>
                                <?php endif; ?>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </section>
</div>
<?php $__env->startSection('ordering_script'); ?>
<script>
     function sendOrderToServer() {
          var order = [];
          var token = $('meta[name="csrf-token"]').attr('content');
          $('tr.row1').each(function(index,element) {
            order.push({
              id: $(this).attr('data-id'),
              position: index+1
            });
          });

          $.ajax({
            type: "POST", 
            dataType: "json", 
            url: "/categories/update-order",
                data: {
              order: order,
              _token: token
            },
            success: function(response) {
                toastr.success(response.message);
                  console.log(response);
            }
          });
        }
</script>
<?php $__env->stopSection(); ?>
<script type="text/javascript">
    
    function deleteCategory(id) {

        if(confirm('Are you sure?'))
        {

           window.location.href="<?php echo e(url('category/delete')); ?>"+'/'+id;
        // body...
      }

    }

</script>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\Users\feso beso\Documents\berbene2\berbene\resources\views/all-category.blade.php ENDPATH**/ ?>