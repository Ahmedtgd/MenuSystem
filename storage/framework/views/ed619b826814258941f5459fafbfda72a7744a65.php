
<?php $__env->startSection('content'); ?>
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
.preview {
overflow: hidden;
width: 150px !important; 
height: 100px !important;
margin: 50px;
border: 1px solid red;
}
.container {
  box-shadow: 5px 5px 5px 0px rgba(0, 0, 0, 0.5);
  border-radius: 10px;
}
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
                        <li class="breadcrumb-item active">Edit Product</li>
                    </ol>
                </div><!-- /.col -->
            </div><!-- /.row -->
        </div><!-- /.container-fluid -->
    </div>
    <h3 class="m-0 text-center">Edit Product</h3>

    <section class="content" style="padding:20px 1%;">
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
                    
                    </div>
                   
                    <form role="form" action="<?php echo e(route('updateProduct')); ?>" method="post" enctype="multipart/form-data">
                        <?php echo e(csrf_field()); ?>

                        <input type="hidden" name="id" value="<?php echo e($product->id); ?>">
                        <div class="box-body">
                            <?php if(count($tags)): ?>
                            <?php
                            $tag_ids = [];
                            if(count($product->tags))
                            {
                                foreach($product->tags as $ptag)
                                {
                                    $tag_ids[] = $ptag->id;
                                }
                            }
                            ?>
                            <div class="row">
                                <div class="col-sm-12">
                                    <label>Tags for Product</label>
                                </div>
                                <?php $__currentLoopData = $tags; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $tag): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                    <div class="col-sm-2">
                                        <label><?php echo e($tag->title); ?></label>
                                        <input type="checkbox" value="<?php echo e($tag->id); ?>" <?php echo e(in_array($tag->id, $tag_ids) ? 'checked' : ''); ?> name="tags[]" />
                                    </div>
                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                            </div>
                            <?php endif; ?>
                            <div class="row">
                                <div class="col-sm-6">
                                    <div class="form-group">
                                        <label>Today's special?</label>
                                        <input name="isFeatured" value="1" id="isFeatured" onclick="setValue()" type="checkbox"  <?php echo e($product->isFeatured==1?"checked":""); ?> />
                                    </div>
                                </div>
                               
                                <div class="col-sm-6">
                                    <div class="form-group">
                                    <label>Status</label>
                                        <select type="text" name="is_active" class="form-control">
                                            <option value="1" <?php echo e($product->is_active ? 'selected' : ''); ?>>Active</option>
                                            <option value="0" <?php echo e(!$product->is_active ? 'selected' : ''); ?>>Inactive</option>
                                        </select>
                                    </div>
                                </div>
                                <div class="col-sm-6">
                                    <div class="form-group">
                                        <label>Select category*</label>
                                        <select type="text" name="categoryId" class="form-control">
                                            <option value="">None</option>
                                            <?php if($categories): ?>
                                            <?php $__currentLoopData = $categories; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $category): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                            <?php $dash = ''; ?>
                                            <?php if(count($category->subcategory) < 1): ?>
                                            <option value="<?php echo e($category->id); ?>" <?php echo e($category->id==$product->categoryId?'selected':""); ?>><?php echo e($category->title); ?></option>
                                            <?php else: ?>
                                            <?php if(count($category->subcategory) >= 1): ?>
                                            <?php echo $__env->make('sub-category-list-option-for-update',['subcategories' => $category->subcategory, 'product' => $product], \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
                                            <?php endif; ?>
                                            <?php endif; ?>
                                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                            <?php endif; ?>
                                        </select>
                                    </div>
                                </div>
                                <div class="col-sm-6">
                                    <div class="form-group">
                                        <label>Product Price (Max 10 Million)*</label>
                                        <input type="number" min="1" max="100000000" name="price" class="form-control" placeholder="Product price" value="<?php echo e($product->price); ?>" required />
                                    </div>
                                </div>
                                <div class="col-sm-6">
                                    <div class="form-group">
                                        <label>Product title*</label>
                                        <input  type="text" name="title" class="form-control" placeholder="Product name" value="<?php echo e($product->title); ?>" required />
                                    </div>
                                </div>
                                <div class="col-sm-6">
                                    <div class="form-group">
                                        <label>Arabic title*</label>
                                        <input  type="text" name="title_ar" class="form-control" placeholder="Arabic name" value="<?php echo e($product->title_ar); ?>" required />
                                    </div>
                                </div>
                                <div class="col-sm-6">
                                    <div class="form-group">
                                        <label>Product Description*</label>
                                        <textarea class="ckeditor form-control" name="nutritionInfo"><?php echo e($product->nutritionInfo); ?></textarea>
                                    </div>
                                </div>
                                <div class="col-sm-6">
                                    <div class="form-group">
                                        <label>Arabic Description*</label>
                                        <textarea id="nutrition" class="form-control" name="nutritionInfo_ar"><?php echo e($product->nutritionInfo_ar); ?></textarea>
                                    </div>
                                </div>
                                <div class="col-sm-6">
                                    <div class="form-group">
                                        <label>Product Ingredients*</label>
                                        <textarea class="ckeditor form-control" name="ingredients"><?php echo e($product->ingredients); ?></textarea>
                                    </div>
                                </div>
                                <div class="col-sm-6">
                                    <div class="form-group">
                                        <label>Arabic Ingredients*</label>
                                        <textarea id="ingredients" class="form-control" name="ingredients_ar"><?php echo e($product->ingredients_ar); ?></textarea>
                                    </div>
                                </div>
                                <div class="col-sm-12">
                                    <div class="row">
                                        <div class="col-sm-5 mb-2">
                                            <label>Cover Image</label>
                                            <br>
                                            <img class="product-image" style="width: 240px;height: 120px;border: 1px solid silver;border-radius: 8px;" src="<?php echo e(asset('uploads/product/'.$product->thumbnail)); ?>"/>
                                        </div>
                                    </div>
                                    <br>
                                    <div class="row">
                                        <div class="col-sm12">
                                            <input type="file" name="thumbnail" class="form-control" accept="image/*"/>
                                            <span> (300px X 150px)</span>
                                            <br>
                                            <br>
                                        </div>
                                    </div>
                                </div>
                                

                                <div class="col-sm-12">
                                    <div class="form-group">
                                        <label>Images*</label>
                                        <br>
                                        <?php if(count($product->images)): ?>
                                        <div class="row">
                                        <?php $__currentLoopData = $product->images; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $img): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                        <?php if($img->cover == 1 && count($product->images) > 1): ?>
                                        <?php else: ?>
                                        <div class="col-sm-3">
                                        <img class="product-image" style="display:block;width: 240px;height: 120px;border: 1px solid silver;border-radius: 8px;" src="<?php echo e(asset('uploads/product/'.$img->url)); ?>">
                                        <?php if(count($product->images) > 1): ?>
                                        <a class="product-delete btn btn-sm btn-danger" style="font-size: 10px;" href="<?php echo e(Route('deleteProductImage', $img->id)); ?>">
                                        Delete
                                        </a>
                                        <?php endif; ?>
                                        <!-- <a class="product-delete btn btn-sm btn-info" style="font-size: 10px;" href="<?php echo e(Route('coverProductImage', [$img->id, $product->translationId])); ?>">
                                        Make cover
                                        </a> -->
                                        </div>
                                        <?php endif; ?>
                                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                        </div>
                                        <?php endif; ?>
                                        <br><br>
                            <input multiple type="file" name="image[]" max="5" class="form-control">
                            <span>1908px X 1101px</span>
                                    </div>
                                </div>

                            </div>
                        </div>
                        <div class="box-footer">
                            <button type="submit" class="btn btn-primary">Save</button>

                        </div>
                    </form>

                   
                </div>
            </div>
        </div>
    </section>
</div>
</div>

<script src="//cdn.ckeditor.com/4.14.1/standard/ckeditor.js"></script>
<script type="text/javascript">

    function setValue(){

      var checkbox=document.getElementById('isFeatured');
        if (checkbox.checked) {
            checkbox.value=1;
        } else {
             checkbox.value=0;
        }

        
    }
</script>
<script src="<?php echo e(asset('js/jquery.min.js')); ?>"></script>
<script src="<?php echo e(asset('js/ckeditor.js')); ?>"></script>
<script src="<?php echo e(asset('js/ar.js')); ?>"></script>
<script type="text/javascript">
    $(document).ready(function () {
        ClassicEditor
    .create( document.querySelector( '#nutrition' ), {
        language: {
            ui: 'ar',
            content: 'ar'
        }
    } )
    .then( editor => {
        window.editor = editor;
    } )
    .catch( err => {
        console.error( err.stack );
    } );
    ClassicEditor
    .create( document.querySelector( '#ingredients' ), {
        language: {
            ui: 'ar',
            content: 'ar'
        }
    } )
    .then( editor => {
        window.editor = editor;
    } )
    .catch( err => {
        console.error( err.stack );
    } );
    });
    </script>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\Users\feso beso\Documents\berbene2\berbene\resources\views/edit-product.blade.php ENDPATH**/ ?>