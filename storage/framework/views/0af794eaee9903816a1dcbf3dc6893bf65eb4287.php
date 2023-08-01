<?php
use Spatie\Emoji\Emoji;
$smiley = ['1' => Emoji::angryFace(), '2' => Emoji::confusedFace(), '3' => Emoji::expressionlessFace(), '4' => Emoji::slightlySmilingFace(), '5' => Emoji::smilingFaceWithHeartEyes()];
$percentage = ['1' => '20', '2' => '40', '3' => '60', '4' => '80', '5' => '100'];
?>


<?php $__env->startSection('content'); ?>
<div class="content-wrapper" style="min-height: 375px;">
    <!-- Content Header (Page header) -->
    <div class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1 class="m-0">Dashboard</h1>
          </div><!-- /.col -->
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="#">Home</a></li>
              <li class="breadcrumb-item active">Dashboard</li>
            </ol>
          </div><!-- /.col -->
        </div><!-- /.row -->
      </div><!-- /.container-fluid -->
    </div>
    <!-- /.content-header -->

    <!-- Main content -->
    <section class="content">
      <div class="container-fluid">
        <!-- Small boxes (Stat box) -->
        <div class="row">
          <div class="col-lg-12 col-12">
            <!-- small box -->
            <div class="small-box bg-info">
              <div class="inner">
                <h3><?php echo e($smiley[$avg_count]); ?> <b><?php echo e($percentage[$avg_count]); ?></b></h3>

                <p>Average feedback</p>
              </div>
              <div class="icon">
                <i class="ion ion-bag"></i>
              </div>
              <!-- <a href="<?php echo e(route('allCategories')); ?>" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a> -->
            </div>
          </div>
          
        </div>
        <div class="row">
          <!-- ./col -->
          <div class="col-lg-4 col-6">
            <!-- small box -->
            <div class="small-box bg-success">
              <div class="inner">
                <h3><?php echo e($smiley[$food_count]); ?> <b><?php echo e($percentage[$food_count]); ?></b></h3>

                <p>Food level feedback</p>
              </div>
              <div class="icon">
                <i class="ion ion-stats-bars"></i>
              </div>
              <!-- <a href="<?php echo e(route('allProducts')); ?>" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a> -->
            </div>
          </div>
          <!-- ./col -->
          <!-- ./col -->
          <div class="col-lg-4 col-6">
            <!-- small box -->
            <div class="small-box bg-danger">
              <div class="inner">
                <h3><?php echo e($smiley[$service_count]); ?> <b><?php echo e($percentage[$service_count]); ?></b></h3>

                <p>Level of service feedback</p>
              </div>
              <div class="icon">
                <i class="ion ion-person-add"></i>
              </div>
              <!-- <a href="<?php echo e(route('allSliders')); ?>" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a> -->
            </div>
          </div>
          <!-- ./col -->
          <!-- ./col -->
          <div class="col-lg-4 col-6">
            <!-- small box -->
            <div class="small-box bg-info" style="background-color: #8d5c61 !important;">
              <div class="inner">
                <h3><?php echo e($smiley[$environment_count]); ?> <b><?php echo e($percentage[$environment_count]); ?></b></h3>

                <p>Level of cleanliness feedback</p>
              </div>
              <div class="icon">
                <i class="ion ion-person-add"></i>
              </div>
              <!-- <a href="<?php echo e(route('allSliders')); ?>" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a> -->
            </div>
          </div>
          <!-- ./col -->
          <!-- ./col -->
          <div class="col-lg-4 col-6">
            <!-- small box -->
            <div class="small-box bg-secondary" style="background-color: #6f42c1 !important;">
              <div class="inner">
                <h3><?php echo e($smiley[$behaviour_count]); ?> <b><?php echo e($percentage[$behaviour_count]); ?></b></h3>

                <p>Staff behaviour feedback</p>
              </div>
              <div class="icon">
                <i class="ion ion-person-add"></i>
              </div>
              <!-- <a href="<?php echo e(route('allSliders')); ?>" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a> -->
            </div>
          </div>
          <!-- ./col -->
        </div>
        <!-- /.row -->
      </div><!-- /.container-fluid -->
    </section>
    <!-- /.content -->
  </div>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\Users\feso beso\Documents\berbene2\berbene\resources\views/home.blade.php ENDPATH**/ ?>