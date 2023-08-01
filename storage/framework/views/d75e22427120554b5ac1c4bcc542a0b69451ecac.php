<!-- Start Footer -->
<?php $locale = App::getLocale(); 
$align_class = $locale == 'en' ? 'text-left' : 'text-right';
?>

<footer class="footer-area">
		<div class="copyright">
			<div class="container">
				<div class="row">
					<?php if($locale == 'en'): ?>
					<div class="col-lg-12">
						<p class="company-name" style="color: lightgray;">All Rights Reserved. <a href="#"> Restaurant menue Restaurant</a></p>
					</div>
					<?php else: ?>
					<div class="col-lg-12">
						<p class="company-name"><a style="color: lightgray; font-weight: normal;" href="#">Restaurant menue </a> <?php echo e(__('site.all_rights_reserved')); ?></p>
					</div>
					<?php endif; ?>
				</div>
			</div>
		</div>
		
	</footer>
	<!-- End Footer --><?php /**PATH C:\Users\feso beso\Documents\berbene2\berbene\resources\views/frontend/layouts/footer_new.blade.php ENDPATH**/ ?>