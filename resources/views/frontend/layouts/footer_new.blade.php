<!-- Start Footer -->
@php $locale = App::getLocale(); 
$align_class = $locale == 'en' ? 'text-left' : 'text-right';
@endphp

<footer class="footer-area">
		<div class="copyright">
			<div class="container">
				<div class="row">
					@if($locale == 'en')
					<div class="col-lg-12">
						<p class="company-name" style="color: lightgray;">All Rights Reserved. <a href="#"> Restaurant menue Restaurant</a></p>
					</div>
					@else
					<div class="col-lg-12">
						<p class="company-name"><a style="color: lightgray; font-weight: normal;" href="#">Restaurant menue </a> {{__('site.all_rights_reserved')}}</p>
					</div>
					@endif
				</div>
			</div>
		</div>
		
	</footer>
	<!-- End Footer -->