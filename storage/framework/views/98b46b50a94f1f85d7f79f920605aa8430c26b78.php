<?php
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
                        <li class="breadcrumb-item active">Products</li>
                    </ol>
                </div><!-- /.col -->
            </div><!-- /.row -->
        </div><!-- /.container-fluid -->
    </div>
    <h3 class="m-0 text-center">All Products</h3>

    <section class="content">
        <div class="row">
            <div class="col-md-12">
                <div class="box box-primary">
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
                    <div class="box-header with-border">
                        <a class="add-new" href="<?php echo e(Route('createProduct')); ?>">
                            <button class="btn btn-primary btn-xs">Add New Product</button>
                        </a>
                    </div>
                    <div class="box-body">
                        <table id="dataTable" class="table table-bordered">
                            <thead>
                                <tr>
                                    <!-- <th>Update Ordering</th> -->
                                    <th>Ordering</th>
                                    <th>Status</th>
                                    <th>Product Title</th>
                                    <th>Arabic Title</th>
                                    <th>Product Thumbnail</th>
                                    <th>Product Price</th>
                                    <th>Today's special</th>
                                    <th>Category</th>
                                    <th>Created at</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php if(isset($products)): ?>
                                <?php $_SESSION['i'] = 0;?>
                                <?php $__currentLoopData = $products; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $product): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                <?php $_SESSION['i'] = $_SESSION['i'] + 1; 
                                ?>
                                <tr>
                                    <?php $dash = ''; ?>
                                    <!-- <td>
                                    <form action="<?php echo e(Route('updateProductOrder')); ?>" type="POST">
                                    <div class="row">
                                        <div class="col-md-12">
                                            <div class="row">
                                                <div class="col-md-6 pr-0">
                                                    <input type="hidden" name="id" value="<?php echo e($product->id); ?>"/>
                                                    <input class="form-control" placeholder="Order" style="font-size: 12px;" type="number" min="1" max="<?php echo e($max); ?>" name="order"/>
                                                </div>
                                                <div class="col-md-6">
                                                    <button type="submit" class="btn btn-sm btn-success" style="min-height: 38px;font-size: 12px;">Update</button>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    </form>
                                    </td> -->
                                    <td><?php echo e($product->order); ?></td>
                                    <td><label class="badge <?php echo e($product->is_active ? 'badge-success' : 'badge-info'); ?>"><?php echo e($product->is_active ? 'Active' : 'Inactive'); ?></label></td>
                                    <td><a href="<?php echo e(Route('viewProduct', $product->id)); ?>"><?php echo e($product->title); ?></a></td>
                                    <td><?php echo e($product->title_ar); ?></td>
                                    <td>
                                        <?php if($product->thumbnail): ?>
                                        <a href="<?php echo e(asset('uploads/product/'.$product->thumbnail)); ?>" data-lightbox="myImg<?php echo $product->id;?>" data-title="<?php echo e($product->title); ?>">
                                        <img src="<?php echo e(asset('uploads/product/'.$product->thumbnail)); ?>" width="240" height="120" style="border-radius: 10px;" data-lightbox="myImg<?php echo $product->id;?>"/>
                                        </a>
                                        <?php else: ?>
                                        <h6>-</h6>
                                        <?php endif; ?>
                                    <!-- </div> -->
                                        
                                        
                                    </td>
                                    <td><?php echo e($product->price); ?></td>
                                    <td><?php echo e($product->isFeatured == 0 ? '-' : 'YES'); ?></td>
                                    <td><?php echo e(isset($product->category->title) ? $product->category->title : 'n/a'); ?></td>
                                    <td><?php echo e(date('d-m-Y', strtotime($product->created_at))); ?></td>
                                    <td>
                                        <a href="<?php echo e(Route('activeInactiveProduct', $product->id)); ?>">
                                            <button class="btn btn-sm btn-success">Change status</button>
                                        </a>
                                        </br></br>
                                        <a href="<?php echo e(Route('editProduct', $product->id)); ?>">
                                            <button class="btn btn-sm btn-info">Edit</button>
                                        </a>
                                        </br></br>
                                        <a href="#"  onclick="deleteProduct(<?php echo e($product->id); ?>)">
                                            <button  class="btn btn-sm btn-danger">Delete</button>
                                        </a>
                                    </td>
                                </tr>
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

<script type="text/javascript">
    function deleteProduct(id) {
        if(confirm('Are you sure?')){
          window.location.href="<?php echo e(url('product/delete')); ?>"+'/'+id;
        }
    }
</script>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\Users\feso beso\Documents\berbene2\berbene\resources\views/all-product.blade.php ENDPATH**/ ?>