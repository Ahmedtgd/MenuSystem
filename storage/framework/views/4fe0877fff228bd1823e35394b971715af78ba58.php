<?php
use App\Models\Product;
?>

<?php $__env->startSection('content'); ?>
<style>
    .content-wrapper{
        background-color: white;
    }
    .filters-heading
    {
        color: cadetblue;
    }
    .custom-form-control{
        font-size: 15px;
    }
    .pagination{
        float: right;
    }
    <style>
    .ck-editor__editable {
    min-height: 265px;
}

    .preview {
overflow: hidden;
width: 234px !important; 
height: 121px !important;
margin: 10px;
border: 1px solid red;
}
.container {
  box-shadow: 5px 5px 5px 0px rgba(0, 0, 0, 0.5);
  border-radius: 10px;
}

</style>
<div class="container">
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
    <h3 class="m-0 text-center">Ordered Products</h3>
    </br>
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
                        <form action="<?php echo e(route('orderedProducts')); ?>" name="ordered-products" method="post">
                            <?php echo csrf_field(); ?>
                        <label>Select Category to load Products</label>
                        <select class="form-control" name="category" id="parent">
                            <option value="">---Select one---</option>
                            <?php $__currentLoopData = $categories; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $category): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                            <option value="<?php echo e($category->id); ?>" <?php echo e($category->id == $cat ? 'selected' : ''); ?>><?php echo e($category->title); ?></option>
                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                        </select>
                        <br>
                        <label>Select sub category</label>
                        <select class="form-control" name="subcategory" id="subcategory">
                            <option value="">---Select one---</option>
                        </select>
                        <br>
                        <button type="submit" class="btn btn-success">Search</button>
                        <br>
                    </div>
                    <div class="box-body mt-4">
                    <table id="dataTable" class="table table-bordered">
                            <thead>
                                <tr>
                                    <!-- <th>Update Ordering</th> -->
                                    <th>#</th>
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
                            <tbody id="tablecontents">
                            <?php if(isset($products) && count($products)): ?>
                                <?php $_SESSION['i'] = 0;?>
                                <?php $__currentLoopData = $products; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $product): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                <?php $_SESSION['i'] = $_SESSION['i'] + 1; 
                                ?>
                                <tr class="row1" data-id="<?php echo e($product->id); ?>">
                                    <?php $dash = ''; ?>
                                    <td><i class="fa fa-sort"></i></td>
                                    <td><a href="<?php echo e(Route('viewProduct', $product->id)); ?>"><?php echo e($product->title); ?></a></td>
                                    <td><?php echo e($product->title_ar); ?></td>
                                    <td>
                                        <?php if($product->thumbnail): ?>
                                        <a href="<?php echo e(asset('uploads/product/'.$product->thumbnail)); ?>"  style="border-radius: 10px;" data-lightbox="myImg<?php echo $product->id;?>" data-title="<?php echo e($product->title); ?>">
                                        <img src="<?php echo e(asset('uploads/product/'.$product->thumbnail)); ?>"  style="border-radius: 10px;" width="240" height="120" data-lightbox="myImg<?php echo $product->id;?>"/>
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
                                        <a href="<?php echo e(Route('editProduct', $product->id)); ?>">
                                            <button class="btn btn-sm btn-info">Edit</button>
                                        </a>
                                        <a href="#"  onclick="deleteProduct(<?php echo e($product->id); ?>)">
                                            <button  class="btn btn-sm btn-danger">Delete</button>
                                        </a>
                                    </td>
                                </tr>
                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                <?php unset($_SESSION['i']); ?>
                                <?php else: ?>
                                <td valign="top" colspan="9" class="dataTables_empty">No data available in table</td>
                                <?php endif; ?>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </section>
</div>
</div>
<?php $__env->startSection('ordering_script'); ?>
<script>
     function sendOrderToServer() {
         var cat_id = '';
         if($('#subcategory').val() != "")
         {
             cat_id = $('#subcategory').val();
         }
         else{
             cat_id = $('#parent').val();
         }
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
            url: "/products/update-order",
                data: {
              order: order,
              cat_id: cat_id,
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
    function deleteProduct(id) {
        if(confirm('Are you sure?')){
          window.location.href="<?php echo e(url('product/delete')); ?>"+'/'+id;
        }
    }
</script>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\Users\feso beso\Documents\berbene2\berbene\resources\views/ordered-products.blade.php ENDPATH**/ ?>