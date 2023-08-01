
<?php $__env->startSection('content'); ?>

<div class="content-wrapper" style="min-height: 375px;">
    <!-- Content Header (Page header) -->
    
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                
                <div class="col-sm-6">
                                </div>
                
                <!-- /.col -->
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="#">Home</a></li>
                        <li class="breadcrumb-item active">Sliders</li>
                    </ol>
                </div><!-- /.col -->
            </div><!-- /.row -->
        </div><!-- /.container-fluid -->
    </div>
    <h3 class="m-0 text-center">All Sliders</h3>

    <section class="content">
        <div class="row table-responsive "     style="border-radius: 10px;">
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
                        <a class="add-new" href="<?php echo e(Route('createSlider')); ?>">
                            <button class="btn btn-primary btn-xs">Add New Slider</button>
                        </a>
                    </div>
                    <div class="box-body">
                        <table class="table table-bordered table-striped" style="border-radius: 10px;" id="dataTable">
                            <thead>
                                <tr>
                                    <th>S.No.</th>
                                    <!-- <th>Language</th> -->
                                    <th>Slider Title</th>
                                    <!-- <th>Slider Description</th> -->
                                    <th>Slider App Image</th>
                                    <!-- <th>Slider Website Image</th> -->
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php if(isset($sliders)): ?>
                                <?php $_SESSION['i'] = 0; ?>
                                <?php $__currentLoopData = $sliders; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $slider): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                <?php $_SESSION['i'] = $_SESSION['i'] + 1; ?>
                                <tr>
                                    <?php $dash = ''; ?>
                                    <td><?php echo e($_SESSION['i']); ?></td>
                                    <!-- <td><?php echo e($slider->language); ?></td> -->
                                    <td><?php echo e($slider->title); ?></td>
                                    <!-- <td><?php echo e($slider->description != "" ? $slider->description : 'N/A'); ?></td> -->
                                    <td>
                                    <a href="<?php echo e(asset('uploads/slider/'.$slider->image)); ?>" data-lightbox="myImg<?php echo $slider->id;?>" data-title="<?php echo e($slider->title); ?>">
                                        <img src="<?php echo e(asset('uploads/slider/'.$slider->image)); ?>" width="150"  style="border-radius: 10px;"  data-lightbox="myImg<?php echo $slider->id;?>"/>
                                        </a> 
                                    </td>
                                    <!-- <td>
                                    <a href="<?php echo e(asset('uploads/slider/'.$slider->web_image)); ?>" data-lightbox="myImg<?php echo $slider->id+1;?>" data-title="<?php echo e($slider->title); ?>">
                                        <img src="<?php echo e(asset('uploads/slider/'.$slider->web_image)); ?>" width="50" data-lightbox="myImg<?php echo $slider->id+1;?>"/>
                                        </a> 
                                    </td> -->
                                    <td>                  
                                        <!-- <?php if($slider->language == 'EN'): ?>                 -->
                                        <a href="<?php echo e(Route('editSlider', $slider->id)); ?>">
                                            <button class="btn btn-sm btn-info">Edit</button>
                                        </a>
                                        &nbsp;
                                        &nbsp;
                                        <!-- <?php else: ?>
                                        <a href="<?php echo e(Route('editTranslatedSlider', $slider->id)); ?>">
                                            <button class="btn btn-sm btn-info">Edit</button>
                                        </a>
                                        <?php endif; ?> -->
                                        <!-- <?php if($slider->language == 'EN'): ?> -->
                                        <a onclick="deleteSlider(<?php echo e($slider->id); ?>)" href="#">
                                            <button class="btn btn-sm btn-danger">Delete</button>
                                        </a>
                                        <!-- <?php endif; ?> -->
                                        <!-- <?php if($slider->duplicate == false): ?>
                                        <a href="<?php echo e(Route('addTranslatedSlider', $slider->id)); ?>">
                                            <button class="btn btn-sm btn-warning">Add Translation</button>
                                        </a>
                                        <?php endif; ?> -->
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

    function deleteSlider(id) {

        if(confirm('Are you sure?')){
            window.location.href="<?php echo e(url('slider/delete')); ?>"+'/'+id;
        }

    }

</script>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\Users\feso beso\Documents\berbene2\berbene\resources\views/all-slider.blade.php ENDPATH**/ ?>