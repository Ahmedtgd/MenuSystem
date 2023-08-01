<?php
use Spatie\Emoji\Emoji;
$smiley = ['1' => Emoji::angryFace(), '2' => Emoji::confusedFace(), '3' => Emoji::expressionlessFace(), '4' => Emoji::slightlySmilingFace(), '5' => Emoji::smilingFaceWithHeartEyes()];
$percentage = ['1' => '20', '2' => '40', '3' => '60', '4' => '80', '5' => '100'];
?>

<title><?php echo e('Customer Feedback - '); ?></title>
<?php $__env->startSection('content'); ?>
<style>
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
<div class=" content-wrapper" style="min-height: 375px;">
    <!-- Content Header (Page header) -->
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    
                </div><!-- /.col -->
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="#">Home</a></li>
                        <li class="breadcrumb-item active">feedbacks</li>
                    </ol>
                </div><!-- /.col -->
            </div><!-- /.row -->
        </div><!-- /.container-fluid -->
    </div>
    <h3 class="m-0 text-center">Customers Feedback</h3>

    <section class="content">
        <div class="row">
            <div class="col-md-12">
                <div class="box box-primary">
                    <div class="box-body">
                        <form id="filters-form" name="form-filter" method="post" action="<?php echo e(route('allFeedbacks')); ?>">
                            <?php echo csrf_field(); ?>
                            <div class="row">
                                <div class="col-md-12">
                                <?php if($errors->any()): ?>
                                    <div>
                                        <?php $__currentLoopData = $errors->all(); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $error): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                        <li class="alert alert-danger"><?php echo e($error); ?></li>
                                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                    </div>
                                <?php endif; ?>
                                </div>
                                <div class="col-md-12 mt-3">
                                    <h5 class="filters-heading">Date Filter</h5>
                                    <div class="row">
                                        <div class="col-md-6">
                                            <label>Date From</label>
                                            <input max="<?php echo date("Y-m-d"); ?>" class="form-control custom-form-control date-inputs" type="date" name="datefrom" placeholder="Date from" value="<?php echo e(isset($datefrom) ? $datefrom : ''); ?>"/>
                                        </div>
                                        <div class="col-md-6">
                                            <label>Date To</label>
                                            <input max="<?php echo date("Y-m-d"); ?>" class="form-control custom-form-control date-inputs" type="date" name="dateto" placeholder="Date to" value="<?php echo e(isset($dateto) ? $dateto : ''); ?>"/>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-3 mt-3">
                                    <h5 class="filters-heading">Food Taste Filter</h5>
                                    <div class="row">
                                        <div class="col-md-6">
                                            <select class="form-control custom-form-control" name="food[operator]">
                                                <option <?php echo e(isset($food) && $food['operator'] == '' ? 'selected' : ''); ?> value="">Operator</option>
                                                <option <?php echo e(isset($food) && $food['operator'] == '>=' ? 'selected' : ''); ?> value=">=">>=</option>
                                                <option <?php echo e(isset($food) && $food['operator'] == '<=' ? 'selected' : ''); ?> value="<="><=</option>
                                                <option <?php echo e(isset($food) && $food['operator'] == '=' ? 'selected' : ''); ?> value="=">=</option>
                                            </select>
                                        </div>
                                        <div class="col-md-6">
                                            
                                            <select class="form-control custom-form-control" name="food[value]">
                                                <option <?php echo e(isset($food) && $food['value'] == '' ? 'selected' : ''); ?> value="">Value</option>
                                                <option <?php echo e(isset($food) && $food['value'] == '1' ? 'selected' : ''); ?> value="1">20</option>
                                                <option <?php echo e(isset($food) && $food['value'] == '2' ? 'selected' : ''); ?> value="2">40</option>
                                                <option <?php echo e(isset($food) && $food['value'] == '3' ? 'selected' : ''); ?> value="3">60</option>
                                                <option <?php echo e(isset($food) && $food['value'] == '4' ? 'selected' : ''); ?> value="4">80</option>
                                                <option <?php echo e(isset($food) && $food['value'] == '5' ? 'selected' : ''); ?> value="5">100</option>
                                            </select>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-3 mt-3">
                                    <h5 class="filters-heading">Cleanliness Filter</h5>
                                    <div class="row">
                                        <div class="col-md-6">
                                            
                                            <select class="form-control custom-form-control" name="clean[operator]">
                                                <option <?php echo e(isset($clean) && $clean['operator'] == '' ? 'selected' : ''); ?> value="">Operator</option>
                                                <option <?php echo e(isset($clean) && $clean['operator'] == '>=' ? 'selected' : ''); ?> value=">=">>=</option>
                                                <option <?php echo e(isset($clean) && $clean['operator'] == '<=' ? 'selected' : ''); ?> value="<="><=</option>
                                                <option <?php echo e(isset($clean) && $clean['operator'] == '=' ? 'selected' : ''); ?> value="=">=</option>
                                            </select>
                                        </div>
                                        <div class="col-md-6">
                                            
                                            <select class="form-control custom-form-control" name="clean[value]">
                                                <option <?php echo e(isset($clean) && $clean['value'] == '' ? 'selected' : ''); ?> value="">Value</option>
                                                <option <?php echo e(isset($clean) && $clean['value'] == '1' ? 'selected' : ''); ?> value="1">20</option>
                                                <option <?php echo e(isset($clean) && $clean['value'] == '2' ? 'selected' : ''); ?> value="2">40</option>
                                                <option <?php echo e(isset($clean) && $clean['value'] == '3' ? 'selected' : ''); ?> value="3">60</option>
                                                <option <?php echo e(isset($clean) && $clean['value'] == '4' ? 'selected' : ''); ?> value="4">80</option>
                                                <option <?php echo e(isset($clean) && $clean['value'] == '5' ? 'selected' : ''); ?> value="5">100</option>
                                            </select>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-3 mt-3">
                                    <h5 class="filters-heading">Service Filter</h5>
                                    <div class="row">
                                        <div class="col-md-6">
                                            
                                            <select class="form-control custom-form-control" name="service[operator]">
                                                <option <?php echo e(isset($service) && $service['operator'] == '' ? 'selected' : ''); ?> value="">Operator</option>
                                                <option <?php echo e(isset($service) && $service['operator'] == '>=' ? 'selected' : ''); ?> value=">=">>=</option>
                                                <option <?php echo e(isset($service) && $service['operator'] == '<=' ? 'selected' : ''); ?> value="<="><=</option>
                                                <option <?php echo e(isset($service) && $service['operator'] == '=' ? 'selected' : ''); ?> value="=">=</option>
                                            </select>
                                        </div>
                                        <div class="col-md-6">
                                            
                                            <select class="form-control custom-form-control" name="service[value]">
                                                <option <?php echo e(isset($service) && $service['value'] == '' ? 'selected' : ''); ?> value="">Value</option>
                                                <option <?php echo e(isset($service) && $service['value'] == '1' ? 'selected' : ''); ?> value="1">20</option>
                                                <option <?php echo e(isset($service) && $service['value'] == '2' ? 'selected' : ''); ?> value="2">40</option>
                                                <option <?php echo e(isset($service) && $service['value'] == '3' ? 'selected' : ''); ?> value="3">60</option>
                                                <option <?php echo e(isset($service) && $service['value'] == '4' ? 'selected' : ''); ?> value="4">80</option>
                                                <option <?php echo e(isset($service) && $service['value'] == '5' ? 'selected' : ''); ?> value="5">100</option>
                                            </select>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-3 mt-3">
                                    <h5 class="filters-heading">Staff Filter</h5>
                                    <div class="row">
                                        <div class="col-md-6">
                                            
                                            <select class="form-control custom-form-control" name="staff[operator]">
                                                <option <?php echo e(isset($staff) && $staff['operator'] == '' ? 'selected' : ''); ?> value="">Operator</option>
                                                <option <?php echo e(isset($staff) && $staff['operator'] == '>=' ? 'selected' : ''); ?> value=">=">>=</option>
                                                <option <?php echo e(isset($staff) && $staff['operator'] == '<=' ? 'selected' : ''); ?> value="<="><=</option>
                                                <option <?php echo e(isset($staff) && $staff['operator'] == '=' ? 'selected' : ''); ?> value="=">=</option>
                                            </select>
                                        </div>
                                        <div class="col-md-6">
                                            
                                            <select class="form-control custom-form-control" name="staff[value]">
                                                <option <?php echo e(isset($staff) && $staff['value'] == '' ? 'selected' : ''); ?> value="">Value</option>
                                                <option <?php echo e(isset($staff) && $staff['value'] == '1' ? 'selected' : ''); ?> value="1">20</option>
                                                <option <?php echo e(isset($staff) && $staff['value'] == '2' ? 'selected' : ''); ?> value="2">40</option>
                                                <option <?php echo e(isset($staff) && $staff['value'] == '3' ? 'selected' : ''); ?> value="3">60</option>
                                                <option <?php echo e(isset($staff) && $staff['value'] == '4' ? 'selected' : ''); ?> value="4">80</option>
                                                <option <?php echo e(isset($staff) && $staff['value'] == '5' ? 'selected' : ''); ?> value="5">100</option>
                                            </select>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-6 mt-3">
                                    <h5 class="filters-heading">Average Rating Filter</h5>
                                    <div class="row">
                                        <div class="col-md-6">
                                            <select class="form-control custom-form-control" name="average[operator]">
                                                <option <?php echo e(isset($average) && $average['operator'] == '' ? 'selected' : ''); ?> value="">Operator</option>
                                                <option <?php echo e(isset($average) && $average['operator'] == '>=' ? 'selected' : ''); ?> value=">=">>=</option>
                                                <option <?php echo e(isset($average) && $average['operator'] == '<=' ? 'selected' : ''); ?> value="<="><=</option>
                                                <option <?php echo e(isset($average) && $average['operator'] == '=' ? 'selected' : ''); ?> value="=">=</option>
                                            </select>
                                        </div>
                                        <div class="col-md-6">
                                            <select class="form-control custom-form-control" name="average[value]">
                                                <option <?php echo e(isset($average) && $average['value'] == '' ? 'selected' : ''); ?> value="">Value</option>
                                                <option <?php echo e(isset($average) && $average['value'] == '1' ? 'selected' : ''); ?> value="1">20</option>
                                                <option <?php echo e(isset($average) && $average['value'] == '2' ? 'selected' : ''); ?> value="2">40</option>
                                                <option <?php echo e(isset($average) && $average['value'] == '3' ? 'selected' : ''); ?> value="3">60</option>
                                                <option <?php echo e(isset($average) && $average['value'] == '4' ? 'selected' : ''); ?> value="4">80</option>
                                                <option <?php echo e(isset($average) && $average['value'] == '5' ? 'selected' : ''); ?> value="5">100</option>
                                            </select>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-6" style="margin-top: 48px;">
                                    <input type="submit" class="w-100 btn btn-info" name="submit-filters" value="Filter"/>
                                </div>
                            </div>
                        </form>
                        <a class="btn btn-primary" href="<?php echo e(route('feedbacks.export', ['post' => json_encode(request()->post())])); ?>">Export Excel (Format 1)</a>
                        <a class="btn btn-warning" href="<?php echo e(route('feedbacks.export', ['format' => true, 'post' => json_encode(request()->post())])); ?>">Export Excel (Format 2)</a>
                        <!-- <a href="<?php echo e(route('exportFeedback2')); ?>" class="btn btn-warning">Export in Excel format 2</a> -->
                        <table class="table table-bordered table-striped mt-5">
                            <thead>
                                <tr>
                                    <th>Sr.</th>
                                    <th>Date</th>
                                    <th>Order code</th>
                                    <th>Device</th>
                                    <th>Qr code</th>
                                    <th>Food</th>
                                    <th>Cleanliness</th>
                                    <th>Service</th>
                                    <th>Staff</th>
                                    <th>Comments</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php if(isset($feedbacks)): ?>
                                <?php $_SESSION['i'] = 0; ?>
                                <?php $__currentLoopData = $feedbacks; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $feedback): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                <?php $_SESSION['i'] = $_SESSION['i'] + 1; ?>
                                <tr>
                                    <?php $dash = ''; ?>
                                    <td><?php echo e($_SESSION['i']); ?></td>
                                    <td><?php echo e(date('d-m-Y',strtotime($feedback->created_at))); ?></td>
                                    <td><?php echo e(ltrim($feedback->order_code, 'T')); ?></td>
                                    <td><?php echo e($feedback->device); ?></td>
                                    <td>
                                    <a href="<?php echo e(asset('uploads/qrcodes/feedbacks/'.$feedback->qr_code)); ?>" data-lightbox="myImg<?php echo $feedback->id;?>" data-title="<?php echo e($feedback->order_code); ?>">
                                        <img src="<?php echo e(asset('uploads/qrcodes/feedbacks/'.$feedback->qr_code)); ?>" width="80" data-lightbox="myImg<?php echo $feedback->id;?>"/>
                                        </a> 
                                    </td>
                                    <td style="font-size: 24px;">
                                    <!-- <?php echo e($smiley[$feedback->food_taste]); ?>  -->
                                    <span style="font-size: 1rem;"><?php echo e($percentage[$feedback->food_taste]); ?></span></td>
                                    <td style="font-size: 24px;">
                                    <!-- <?php echo e($smiley[$feedback->environment]); ?>  -->
                                    <span style="font-size: 1rem;"><?php echo e($percentage[$feedback->environment]); ?></span></td>
                                    <td style="font-size: 24px;">
                                    <!-- <?php echo e($smiley[$feedback->service]); ?> -->
                                     <span style="font-size: 1rem;"><?php echo e($percentage[$feedback->service]); ?></span></td>
                                    <td style="font-size: 24px;">
                                    <!-- <?php echo e($smiley[$feedback->staff_behaviour]); ?> -->
                                     <span style="font-size: 1rem;"><?php echo e($percentage[$feedback->staff_behaviour]); ?></span></td>
                                    <td><?php echo e($feedback->comment != "" ? $feedback->comment : '-'); ?></td>
                                    <!-- <td><?php echo e(date('d-m-Y',strtotime($feedback->created_at))); ?></td> -->
                                </tr>

                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                <?php unset($_SESSION['i']); ?>
                                <?php endif; ?>
                            </tbody>
                        </table>
                        <?php echo $feedbacks->appends(request()->input())->links(); ?>

                    </div>
                </div>
            </div>
        </div>
    </section>
</div>
</div>

<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\Users\feso beso\Documents\berbene2\berbene\resources\views/all-feedbacks.blade.php ENDPATH**/ ?>