<?php
use Spatie\Emoji\Emoji;
$smiley = ['1' => Emoji::angryFace(), '2' => Emoji::confusedFace(), '3' => Emoji::expressionlessFace(), '4' => Emoji::slightlySmilingFace(), '5' => Emoji::smilingFaceWithHeartEyes()];
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
                        <li class="breadcrumb-item active">devices</li>
                    </ol>
                </div><!-- /.col -->
            </div><!-- /.row -->
        </div><!-- /.container-fluid -->
    </div>
    <h3 class="m-0 text-center">All devices</h3>
    </br>
    <section class="content">
        <div class="row">
            <div class="col-md-12">
                <div class="box box-primary">
                    <div class="box-body">
                        <table class="table table-bordered table-striped" id="dataTable-length">
                            <thead>
                                <tr>
                                    <th>S.No.</th>
                                    <th>Device Id</th>
                                    <th>Installed at</th>
                                    <th>Data Sync at</th>
                                    <th>Feedbacks Sync at</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php if(isset($devices)): ?>
                                <?php $_SESSION['i'] = 0; ?>
                                <?php $__currentLoopData = $devices; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $device): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                <?php $_SESSION['i'] = $_SESSION['i'] + 1; ?>
                                <tr>
                                    <?php $dash = ''; ?>
                                    <td><?php echo e($_SESSION['i']); ?></td>
                                    <td><?php echo e($device->device); ?></td>
                                    <td><?php echo e(!is_null($device->apk_time) ? date('d-m-Y h:i:s',strtotime($device->updated_at)) : '-'); ?></td>
                                    <td><?php echo e(!is_null($device->data_time) ? date('d-m-Y h:i:s',strtotime($device->data_time)) : '-'); ?></td>
                                    <td><?php echo e(!is_null($device->feedback_time) ? date('d-m-Y h:i:s',strtotime($device->feedback_time)) : '-'); ?></td>
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

<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\Users\feso beso\Documents\berbene2\berbene\resources\views/all-devices.blade.php ENDPATH**/ ?>