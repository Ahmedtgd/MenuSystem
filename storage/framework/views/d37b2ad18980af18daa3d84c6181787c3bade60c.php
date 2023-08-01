
<?php $__env->startSection('content'); ?>
<style>
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
<div class="container" >
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
                        <li class="breadcrumb-item active">Update Tag</li>
                    </ol>
                </div><!-- /.col -->
            </div><!-- /.row -->
        </div><!-- /.container-fluid -->
    </div>
    <h3 class="m-0 text-center">Update Tag</h3>

    <section class="content" style="padding:20px 30%;">
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
        <div class="row">
            <div class="col-md-12">
                <div class="box box-primary">
                    <div class="box-header with-border">
                        
                    </div>

                    <form role="form" action="<?php echo e(route('tags.update', ['tag' => $tag])); ?>" method="post" enctype="multipart/form-data">
                        <?php echo csrf_field(); ?>
                        <?php echo method_field('PUT'); ?>
                        <div class="box-body">
                            <div class="row">
                                <div class="col-sm-12">
                                    <div class="form-group">
                                        <label>Tag title*</label>
                                        <input type="text" name="title" class="form-control" placeholder="Tag name" value="<?php echo e($tag->title); ?>" required />
                                    </div>
                                </div>
                                <div class="col-sm-12">
                                    <div class="form-group">
                                        <label>Tag title (Arabic)*</label>
                                        <input type="text" name="title_ar" class="form-control" placeholder="Tag name (Arabic)" value="<?php echo e($tag->title_ar); ?>" required />
                                    </div>
                                </div>
                                <div class="col-sm-12">
                                    <div class="form-group">
                                    <img src="<?php echo e(asset('images/'.$tag->tab_icon)); ?>" style="width: 30px;"/>
                                        <label>Tab Icon (30 x 25)</label>
                                        <input id="tab_icon" type="file" name="tab_icon" class="input is-large image" style="height: 60px !important;margin-bottom:13px">
                                    </div>
                                </div>
                                <div class="col-sm-12">
                                    <div class="form-group">
                                    <img src="<?php echo e(asset('images/'.$tag->web_icon)); ?>" style="width: 30px;" />
                                        <label>Web Icon (30 x 25)</label>
                                        <input id="web_icon" type="file" name="web_icon" class="input is-large image" style="height: 60px !important;margin-bottom:13px">
                                    </div>
                                </div>
                                <div class="col-sm-12">
                                    <div class="form-group">
                                        <label>Default Option</label>
                                        <input id="default" <?php echo e($tag->default ? 'checked' : ''); ?> type="checkbox" name="default">
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="box-footer">
                            <button type="submit" class="btn btn-primary">Create</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </section>
</div>
</div>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\Users\feso beso\Documents\berbene2\berbene\resources\views/tags/edit.blade.php ENDPATH**/ ?>