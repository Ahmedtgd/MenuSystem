
<?php $__env->startSection('content'); ?>
<div class="content-wrapper" style="min-height: 375px;">
    <!-- Content Header (Page header) -->
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 class="m-0">Update Apk Password</h1>
                </div><!-- /.col -->
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="#">Home</a></li>
                        <li class="breadcrumb-item active">Update Apk Password</li>
                    </ol>
                </div><!-- /.col -->
            </div><!-- /.row -->
        </div><!-- /.container-fluid -->
    </div>
    <section class="content" style="padding:10px 20%;">
        <div class="row">
            <div class="col-md-12">
                <div class="box box-primary">
                    <div class="box-header with-border">
                        <!-- <h3 class="box-title">Update APK Password</h3> -->
                    </div>
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
                    <h5 style="text-align: center;
    background: gold;
    color: white;
    font-family: monospace;padding: 10px;border-radius: 7px;">
                    Note: In case of changing password to new, all devices having Brbebe App installed will ask for New Password otherwise will stop working in 24 hours after connecting with the Internet.
                    </h5>
                    <form role="form" method="post" enctype="multipart/form-data">
                        <?php echo e(csrf_field()); ?>

                        <div class="box-body">
                            <div class="row">
                                <div class="col-sm-12">
                                    <div class="form-group">
                                        <label style="background-color: darkgoldenrod;color: white;font-size: 18px;padding: 10px;border-radius: 5px;">Old Password is <?php echo e(is_null($old_password->old_password) ? 'Not Set for now' : $old_password->old_password); ?></label>
                                    </div>
                                </div>
                                <div class="col-sm-12">
                                    <div class="form-group">
                                        <label>New Password*</label>
                                        <input type="password" name="new_password" class="form-control" placeholder="New Password" value="<?php echo e(old('new_password')); ?>" required />
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="box-footer">
                            <button type="submit" class="btn btn-primary">Update</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </section>
</div>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\Users\feso beso\Documents\berbene2\berbene\resources\views/update-apk-password.blade.php ENDPATH**/ ?>