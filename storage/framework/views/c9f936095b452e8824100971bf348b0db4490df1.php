
<?php $__env->startSection('content'); ?>
    <!-- Start All Pages -->
	<div class="all-page-title page-breadcrumb">
		<div class="container text-center">
			<div class="row">
				<div class="col-lg-12">
					<h1><?php echo e(__('site.call_us')); ?></h1>
				</div>
				<!-- <div class="col-lg-12">
					<p style="color: silver;">
					Lorem ipsum dolor sit amet, consectetur adipiscing elit, 
					sed do eiusmod tempor incididunt ut labore et dolore magna aliqua.
					Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip 
					ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse 
					cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, 
					sunt in culpa qui officia deserunt mollit anim id est laborum.
					</p>
				</div> -->
			</div>
		</div>
	</div>
	<!-- End All Pages -->
	
	<!-- Start Contact -->
	<!-- <div class="map-full"></div> -->
	<!-- <div class="contact-box">
		<div class="container">
			<div class="row">
				<div class="col-lg-12">
					<div class="heading-title text-center">
						<h2><?php echo e(__('site.contact')); ?></h2>
						<p><?php echo e(__('site.contact_form_text')); ?></p>
					</div>
				</div>
			</div>
			<div class="row">
				<div class="col-lg-12">
					<form id="contactForm">
						<div class="row">
							<div class="col-md-12">
								<div class="form-group">
									<input type="text" class="form-control" id="name" name="name" placeholder="<?php echo e(__('site.your_name')); ?>" required data-error="<?php echo e(__('site.enter_name')); ?>">
									<div class="help-block with-errors"></div>
								</div>                                 
							</div>
							<div class="col-md-12">
								<div class="form-group">
									<input type="text" placeholder="<?php echo e(__('site.your_email')); ?>" id="email" class="form-control" name="name" required data-error="<?php echo e(__('site.enter_email')); ?>">
									<div class="help-block with-errors"></div>
								</div> 
							</div>
							<div class="col-md-12">
								<div class="form-group">
									<select class="custom-select d-block form-control" id="guest" required data-error="<?php echo e(__('site.select_person')); ?>">
									  <option disabled selected><?php echo e(__('site.select_person')); ?>*</option>
									  <option value="1">1</option>
									  <option value="2">2</option>
									  <option value="3">3</option>
									  <option value="4">4</option>
									  <option value="5">5</option>
									</select>
									<div class="help-block with-errors"></div>
								</div> 
							</div>
							<div class="col-md-12">
								<div class="form-group"> 
									<textarea class="form-control" id="message" placeholder="<?php echo e(__('site.your_message')); ?>" rows="4" data-error="<?php echo e(__('site.write_your_message')); ?>" required></textarea>
									<div class="help-block with-errors"></div>
								</div>
								<div class="submit-button text-center">
									<button class="btn btn-common" id="submit" type="submit"><?php echo e(__('site.send_message')); ?></button>
									<div id="msgSubmit" class="h3 text-center hidden"></div> 
									<div class="clearfix"></div> 
								</div>
							</div>
						</div>            
					</form>
				</div>
			</div>
		</div>
	</div> -->
	<!-- End Contact -->
	
	<!-- Start Contact info -->
	<!-- <div class="contact-imfo-box">
		<div class="container">
			<div class="row">
				<div class="col-md-4">
					<i class="fa fa-volume-control-phone"></i>
					<div class="overflow-hidden">
						<h4><?php echo e(__('site.phone')); ?></h4>
						<p class="lead">
							+01 123-456-4590
						</p>
					</div>
				</div>
				<div class="col-md-4">
					<i class="fa fa-envelope"></i>
					<div class="overflow-hidden">
						<h4><?php echo e(__('site.email')); ?></h4>
						<p class="lead">
							yourmail@gmail.com
						</p>
					</div>
				</div>
				<div class="col-md-4">
					<i class="fa fa-map-marker"></i>
					<div class="overflow-hidden">
						<h4><?php echo e(__('site.location')); ?></h4>
						<p class="lead">
							<?php echo e(__('site.address')); ?>

						</p>
					</div>
				</div>
			</div>
		</div>
	</div> -->
    <?php $__env->stopSection(); ?>
	<!-- End Contact info -->
    <script>
		// $('.map-full').mapify({
		// 	points: [
		// 		{
		// 			lat: 40.7143528,
		// 			lng: -74.0059731,
		// 			marker: true,
		// 			title: 'Marker title',
		// 			infoWindow: 'Berbene Restaurant'
		// 		}
		// 	]
		// });	
	</script>
    
<?php echo $__env->make('frontend.layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\Users\feso beso\Documents\berbene2\berbene\resources\views/frontend/contact.blade.php ENDPATH**/ ?>