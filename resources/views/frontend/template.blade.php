@extends('frontend.layouts.app')
@section('content')
@php $locale = App::getLocale(); 
$align_class = $locale == 'en' ? 'text-left' : 'text-right';
@endphp
@if(count($sliders))
<!-- Start slides -->
<div id="slides" class="cover-slides">
		<ul class="slides-container">
			@foreach($sliders as $slider)
			<li class="text-center">
				<img src="{{ asset('uploads/slider/'.$slider->web_image) }}">
				<div class="container">
					<div class="row">
						<div class="col-md-12">
							<h1 class="m-b-20"><strong>{{$slider->title}}</strong></h1>
							<p class="m-b-40">{{$slider->description}}</p>
							<!-- <p><a class="btn btn-lg btn-circle btn-outline-new-white" href="#">{{__('site.reservation')}}</a></p> -->
						</div>
					</div>
				</div>
			</li>
			@endforeach
		</ul>
		<div class="slides-navigation">
			<a href="#" class="next"><i class="fa fa-angle-right" aria-hidden="true"></i></a>
			<a href="#" class="prev"><i class="fa fa-angle-left" aria-hidden="true"></i></a>
		</div>
	</div>
	@endif
	<!-- End slides -->
		<!-- Start Menu -->
		<div class="menu-box">
		<div class="container">
			<div class="row">
				<div class="col-lg-12">
					<div class="heading-title text-center">
						<h2>{{__('site.special_menu_title')}}</h2>
						<!-- <p>{{__('site.special_menu_description')}}</p> -->
					</div>
				</div>
			</div>
			
			
			<div class="row special-list">
					@if(count($products))
						@foreach($products as $product)
							<div class="col-lg-4 col-md-6 col-6 special-grid">
								<div class="gallery-single fix">
									<a href="product-detail/{{$product->translationId}}">
								@foreach($product->images as $image)
								<img src="{{ $image->url }}" class="img-fluid" alt="Image">
								@endforeach
									<div class="why-text">
										<h4 class="{{$align_class}}">{{$product->title}}</h4>
										<p class="{{$align_class}}">{{strip_tags($product->nutritionInfo)}}</p>
										<h5 class="{{$align_class}}"> {{$product->price}} IQD</h5>
									</div>
								</a>
								</div>
							</div>
						@endforeach
					@else
						<h3 class="text-center w-100">Nothing Found</h3>
					@endif
			</div>
		</div>
	</div>
	<!-- End Menu -->	
	<!-- Start QT -->
	<!-- <div class="qt-box qt-background">
		<div class="container">
			<div class="row">
				<div class="col-md-8 ml-auto mr-auto text-left">
					<p class="lead ">
						" {{__('site.home_quote')}} "
					</p>
					<span class="lead">{{__('site.home_quote_name')}}</span>
				</div>
			</div>
		</div>
	</div> -->
	<!-- End QT -->

	<!-- Start Contact info -->
	<!-- <div class="contact-imfo-box">
		<div class="container">
			<div class="row">
				<div class="col-md-4">
					<i class="fa fa-volume-control-phone" <?= $align_class == 'text-right' ? 'style="float: right;margin-right: 0; margin-left: 20px;"' : ''?>></i>
					<div class="overflow-hidden">
						<h4 class="{{$align_class}}">{{__('site.phone')}}</h4>
						<p class="lead {{$align_class}}">
							+01 123-456-4590
						</p>
					</div>
				</div>
				<div class="col-md-4">
					<i class="fa fa-envelope" <?= $align_class == 'text-right' ? 'style="float: right;margin-right: 0; margin-left: 20px;"' : ''?>></i>
					<div class="overflow-hidden">
						<h4 class="{{$align_class}}">{{__('site.email')}}</h4>
						<p class="lead {{$align_class}}">
						hello@menu.com
						</p>
					</div>
				</div>
				<div class="col-md-4">
					<i class="fa fa-map-marker" <?= $align_class == 'text-right' ? 'style="float: right;margin-right: 0; margin-left: 20px;"' : ''?>></i>
					<div class="overflow-hidden">
						<h4 class="{{$align_class}}">{{__('site.location')}}</h4>
						<p class="lead {{$align_class}}">
						{{__('site.address')}}
						</p>
					</div>
				</div>
			</div>
		</div>
	</div> -->
	<!-- End Contact info -->
	@endsection