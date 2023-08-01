
<?php $__env->startSection('content'); ?>


	<!-- Start header -->
	

	<div class="all-page-title page-breadcrumb">
		<div class="container text-center">
			<div class="row">
				<div class="col-lg-12">
					<h1><?php echo e(__('site.about_us')); ?></h1>
				</div>
			</div>
		</div>
	</div>
	<!-- End header -->
<!-- Start About -->
<div class="slideshow">
<div class="about-section-box">
		<div class="container">
			<div class="row">
				<div class="col-lg-6 col-md-6">
				
					<img src="<?php echo e(asset('theme/images/about-img.jpg')); ?>" alt="Slideshow Image" class="img-fluid ">
				</div>

				<div class="col-lg-6 col-md-6 text-center">
					<div class="inner-column">
						<h1><?php echo e(__('site.welcome_to')); ?> <span><?php echo e(__('site.berbene_restaurant')); ?></span></h1>
						<br/>
						

						<p>تذوق طعم الجودة والفخامة مع بربين 
استمتع بتجربة فريدة عند زيارتك لمطعمنا واستمتع بالطعم الفريد لكل اطباقنا التي نقدمها.
اجود المكونات 
امهر الطهاة 
افضل خدمة لتقديم الطعام 
والنظافة على اعلى مستوياتها  </p>
<br/><br/>
						<p> The taste of quality and luxury with Berbens
Enjoy a unique experience when you visit our restaurant and enjoy the unique taste of all our dishes.
The finest ingredients
the best chefs
Best catering service
The highest level Hygiene  </p>
					</div>
				</div>
				<!--
				<div class="col-md-12">
					<div class="inner-pt">
						<p>Sed tincidunt, neque at egestas imperdiet, nulla sapien blandit nunc, sit amet pulvinar orci nibh ut massa. Proin nec lectus sed nunc placerat semper. Duis hendrerit elit nec sapien porttitor, ut pretium ipsum feugiat. Aenean volutpat porta nisi in gravida. Curabitur pulvinar ligula sed facilisis bibendum. Nullam vitae nulla elit. </p>
						<p>Integer purus velit, eleifend eu magna volutpat, porttitor blandit lectus. Aenean risus odio, efficitur quis erat eget, mattis tristique arcu. Fusce in ante enim. Integer consectetur elit nec laoreet rutrum. Mauris porta turpis nec tellus accumsan pellentesque. Morbi non quam tempus, convallis urna in, cursus mauris. </p>
					</div>
				</div>-->
			</div>
		</div>
	</div>
</div>
	<!-- End About -->
    <?php $__env->stopSection(); ?>

<?php echo $__env->make('frontend.layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\Users\feso beso\Documents\berbene2\berbene\resources\views/frontend/about.blade.php ENDPATH**/ ?>