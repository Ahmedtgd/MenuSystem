
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
                        <li class="breadcrumb-item active">Tags</li>
                    </ol>
                </div><!-- /.col -->
            </div><!-- /.row -->
        </div><!-- /.container-fluid -->
    </div>
    <h3 class="m-0 text-center">All Tags</h3>

    <section class="content">
        <div class="row">
            <div class="col-md-12  table-responsive">
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
                        <a class="add-new" href="<?php echo e(Route('tags.create')); ?>">
                            <button class="btn btn-primary btn-xs">Add New Tag</button>
                        </a>
                    </div>
                    <div class="box-body ">
                        <table class="table table-bordered table-striped" id="dataTable">
                            <thead>
                                <tr>
                                    <th>Sr. No.</th>
                                    <th>Tag Title</th>
                                    <th>Tag Title (Arabic)</th>
                                    <th>Slider App Icon</th>
                                    <th>Slider Web Icon</th>
                                    <!-- <th>Status</th> -->
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php $__currentLoopData = $tags; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $tag): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                <tr>
                                    <td><?php echo e($loop->iteration); ?></td>
                                    <td><?php echo e($tag->title); ?></td>
                                    <td><?php echo e($tag->title_ar); ?></td>
                                    <td>
                                    <a href="<?php echo e(asset('images/'.$tag->tab_icon)); ?>"  data-lightbox="myImg<?php echo $tag->id;?>" data-title="<?php echo e($tag->title); ?>">
                                        <img src="<?php echo e(asset('images/'.$tag->tab_icon)); ?>"  style="border-radius: 10px;" width="240" height="120" data-lightbox="myImg<?php echo $tag->id;?>"/>
                                        </a> 
                                    </td>
                                    <td>
                                    <a href="<?php echo e(asset('images/'.$tag->web_icon)); ?>"       data-lightbox="myImg<?php echo $tag->id;?>" data-title="<?php echo e($tag->title); ?>">
                                        <img src="<?php echo e(asset('images/'.$tag->web_icon)); ?>"  style="border-radius: 10px;"        width="240" height="120"  data-lightbox="myImg<?php echo $tag->id;?>"/>
                                        </a> 
                                    </td>
                                    
                                    <td>                  
                                        <a href="<?php echo e(Route('tags.edit', ['tag' => $tag])); ?>">
                                            <button class="btn btn-sm btn-info">Edit</button>
                                        </a>
                                        
                                    </td> 
                                </tr>

                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </section>
</div>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\Users\feso beso\Documents\berbene2\berbene\resources\views/tags/index.blade.php ENDPATH**/ ?>