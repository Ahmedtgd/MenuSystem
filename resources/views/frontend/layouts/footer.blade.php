<!-- Start Footer -->
@php $locale = App::getLocale(); 
$align_class = $locale == 'en' ? 'text-left' : 'text-right';
@endphp
<footer class="footer-area bg-f">
		<div class="container">
			<div class="row">
				<div class="col-lg-3 col-md-6">
					<h3 class="{{$align_class}}">{{__('site.about_us')}}</h3>
					<p class="{{$align_class}}">{{__('site.footer_about_us_text')}}.
						</p>
				</div>
				<div class="col-lg-3 col-md-6">
					<h3 class="{{$align_class}}">{{__('site.opening_hours')}}</h3>
					<p class="{{$align_class}}"><span class="text-color">{{__('site.opening_hours_text')}}</span></p>
					<!--<p><span class="text-color">Monday: </span>Closed</p>
					<p><span class="text-color">Tue-Wed :</span> 9:Am - 10PM</p>
					<p><span class="text-color">Thu-Fri :</span> 9:Am - 10PM</p>
					<p><span class="text-color">Sat-Sun :</span> 5:PM - 10PM</p>-->
				</div>
				<div class="col-lg-3 col-md-6">
					<h3 class="{{$align_class}}">{{__('site.contact_information')}}</h3>
					<p class="lead {{$align_class}}">{{__('site.address')}}</p>
					<p class="lead {{$align_class}}"><a href="#">+01 2000 800 9999</a></p>
					<p class="{{$align_class}}"><a href="#"> hello@menu.com</a></p>
				</div>
				<div class="col-lg-3 col-md-6">
					<!-- <h3>{{__('site.subscribe')}}</h3>
					<div class="subscribe_form">
						<form class="subscribe_form">
							<input name="EMAIL" id="subs-email" class="form_input" placeholder="{{__('site.email_address')}}" type="email">
							<button type="submit" class="submit">{{__('site.subscribe')}}</button>
							<div class="clearfix"></div>
						</form>
					</div> -->
					<ul class="list-inline f-social {{$align_class}}">
						<li class="list-inline-item"><a href="#"><i class="fa fa-facebook" aria-hidden="true"></i></a></li>
						<li class="list-inline-item"><a href="#"><i class="fa fa-twitter" aria-hidden="true"></i></a></li>
						<li class="list-inline-item"><a href="#"><i class="fa fa-linkedin" aria-hidden="true"></i></a></li>
						<li class="list-inline-item"><a href="#"><i class="fa fa-google-plus" aria-hidden="true"></i></a></li>
						<li class="list-inline-item"><a href="#"><i class="fa fa-instagram" aria-hidden="true"></i></a></li>
					</ul>
				</div>
			</div>
		</div>
		
		<div class="copyright">
			<div class="container">
				<div class="row">
					@if($locale == 'en')
					<div class="col-lg-12">
						<p class="company-name" style="color: lightgray;">All Rights Reserved. &copy; {{ now()->year }} <a style="color: lightgray;" href="#"> Restaurant menu</a> Design By : Shopini</p>
					</div>
					@else
					<div class="col-lg-12">
						<p class="company-name">Shopini : {{__('site.designed_by')}} <a href="#"> Restaurant menu</a> {{ now()->year }} &copy; {{__('site.all_rights_reserved')}}</p>
					</div>
					@endif
				</div>
			</div>
		</div>
		
	</footer>
	<!-- End Footer -->