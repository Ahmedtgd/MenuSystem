<?php $locale = App::getLocale(); 
?>


<!-- Start header -->
<header class="top-navbar " >
		<nav class="navbar navbar-expand-lg navbar-light bg-light ">
			<div class="container">
				<?php if($locale == 'en'): ?>
			<a class="navbar-brand" href="<?php echo e(route('home')); ?>">
					<img class="header-logo" src="<?php echo e(asset('theme/images/logo.png')); ?>" alt=""/>
				</a>
				<?php endif; ?>
				<button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbars-rs-food" aria-controls="navbars-rs-food" aria-expanded="false" aria-label="Toggle navigation">
				  <span class="navbar-toggler-icon"></span>
				</button>
				<div class="collapse navbar-collapse" id="navbars-rs-food">
					
					<ul class="navbar-nav <?php echo e($locale == 'en' ? 'ml-auto' : ''); ?>">
					<?php if($locale == 'en'): ?>	
					<li class="nav-item <?php echo e((!request()->is('about') && !request()->is('contact')) ? 'active' : ''); ?>"><a class="nav-link" href="<?php echo e(route('home')); ?>"><?php echo e(__('site.home')); ?></a></li>
						<li class="nav-item <?php echo e((request()->is('about')) ? 'active' : ''); ?>"><a class="nav-link" href="<?php echo e(route('about')); ?>"><?php echo e(__('site.about')); ?></a></li>
						<li class="nav-item <?php echo e((request()->is('contact')) ? 'active' : ''); ?>"><a class="nav-link" href="<?php echo e(route('contact')); ?>"><?php echo e(__('site.contact')); ?></a></li>
						<?php $locale = App::getLocale(); ?>
						<li class="nav-item dropdown">
							<a id="navbarDropdown" class="nav-link dropdown-toggle" href="#" role="button"
							data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
								<?php switch($locale):
									case ('en'): ?>
									<!-- <img src="<?php echo e(asset('images/flag/en.png')); ?>" width="25px">  -->
									<?php echo e(__('site.english')); ?>

									<?php break; ?>
									<?php case ('ar'): ?>
									<!-- <img src="<?php echo e(asset('images/flag/ar.png')); ?>" width="25px">  -->
									<?php echo e(__('site.arabic')); ?>

									<?php break; ?>
									<?php default: ?>
									<!-- <img src="<?php echo e(asset('images/flag/en.png')); ?>" width="25px">  -->
									<?php echo e(__('site.english')); ?>

								<?php endswitch; ?>
								<span class="caret"></span>
							</a>
							<div class="dropdown-menu dropdown-menu-right" aria-labelledby="navbarDropdown">
								<a class="dropdown-item" href="<?php echo e(route('switchLang', 'en')); ?>">
									<!-- <img src="<?php echo e(asset('images/flag/en.png')); ?>" width="25px">  -->
									<?php echo e(__('site.english')); ?></a>
								<a class="dropdown-item" href="<?php echo e(route('switchLang', 'ar')); ?>">
									<!-- <img src="<?php echo e(asset('images/flag/ar.png')); ?>" width="25px">  -->
									<?php echo e(__('site.arabic')); ?></a>
							</div>
						</li>
						<?php else: ?>
						<li class="nav-item dropdown">
							<a id="navbarDropdown2" class="nav-link dropdown-toggle" href="#" role="button"
							data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
								<?php switch($locale):
									case ('en'): ?>
									<!-- <img src="<?php echo e(asset('images/flag/en.png')); ?>" width="25px">  -->
									<?php echo e(__('site.english')); ?>

									<?php break; ?>
									<?php case ('ar'): ?>
									<!-- <img src="<?php echo e(asset('images/flag/ar.png')); ?>" width="25px">  -->
									<?php echo e(__('site.arabic')); ?>

									<?php break; ?>
									<?php default: ?>
									<!-- <img src="<?php echo e(asset('images/flag/en.png')); ?>" width="25px">  -->
									<?php echo e(__('site.english')); ?>

								<?php endswitch; ?>
								<span class="caret"></span>
							</a>
							<div class="dropdown-menu dropdown-menu-right" aria-labelledby="navbarDropdown2">
								<a class="dropdown-item" href="<?php echo e(route('switchLang', 'en')); ?>">
									<!-- <img src="<?php echo e(asset('images/flag/en.png')); ?>" width="25px">  -->
									<?php echo e(__('site.english')); ?></a>
								<a class="dropdown-item" href="<?php echo e(route('switchLang', 'ar')); ?>">
									<!-- <img src="<?php echo e(asset('images/flag/ar.png')); ?>" width="25px">  -->
									<?php echo e(__('site.arabic')); ?></a>
							</div>
						</li>
						<li class="nav-item <?php echo e((request()->is('contact')) ? 'active' : ''); ?>"><a class="nav-link" href="<?php echo e(route('contact')); ?>"><?php echo e(__('site.contact')); ?></a></li>
						<li class="nav-item <?php echo e((request()->is('about')) ? 'active' : ''); ?>"><a class="nav-link" href="<?php echo e(route('about')); ?>"><?php echo e(__('site.about')); ?></a></li>
						<li class="nav-item <?php echo e((!request()->is('about') && !request()->is('contact')) ? 'active' : ''); ?>"><a class="nav-link" href="<?php echo e(route('home')); ?>"><?php echo e(__('site.home')); ?></a></li>
						<?php endif; ?>
					</ul>
				</div>
				<?php if($locale == 'ar'): ?>
			<a class="form-inline" href="<?php echo e(route('home')); ?>">
					<img class="header-logo" src="<?php echo e(asset('theme/images/logo.png')); ?>" alt="" />
				</a>
				<?php endif; ?>
				
			</div>
		</nav>
	</header>
	<!-- End header --><?php /**PATH C:\Users\feso beso\Documents\berbene2\berbene\resources\views/frontend/layouts/menu_new.blade.php ENDPATH**/ ?>