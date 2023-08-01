@php $locale = App::getLocale(); 
@endphp
<!-- Start header -->
<header class="top-navbar" >
		<nav class="navbar navbar-expand-lg navbar-light bg-light"   >
			<div class="container" >
				@if($locale == 'en')
			<a class="navbar-brand" href="{{ route('home') }}">
					<img src="{{asset('theme/images/logo.png')}}" alt="" width="250" height="120"/>
				</a>
				@endif
				<button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbars-rs-food" aria-controls="navbars-rs-food" aria-expanded="false" aria-label="Toggle navigation">
				  <span class="navbar-toggler-icon"></span>
				</button>
				<div class="collapse navbar-collapse" id="navbars-rs-food"  >
					
					<ul class="navbar-nav {{$locale == 'en' ? 'ml-auto' : ''}}">
					@if($locale == 'en')	
					<li class="nav-item {{ (!request()->is('about') && !request()->is('contact')) ? 'active' : '' }}"><a class="nav-link" href="{{ route('home') }}">{{__('site.home')}}</a></li>
						<li class="nav-item {{ (request()->is('about')) ? 'active' : '' }}"><a class="nav-link" href="{{ route('about') }}">{{__('site.about')}}</a></li>
						<li class="nav-item {{ (request()->is('contact')) ? 'active' : '' }}"><a class="nav-link" href="{{ route('contact') }}">{{__('site.contact')}}</a></li>
						@php $locale = App::getLocale(); @endphp
						<li class="nav-item dropdown">
							<a id="navbarDropdown" class="nav-link dropdown-toggle" href="#" role="button"
							data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
								@switch($locale)
									@case('en')
									<!-- <img src="{{asset('images/flag/en.png')}}" width="25px">  -->
									{{__('site.english')}}
									@break
									@case('ar')
									<!-- <img src="{{asset('images/flag/ar.png')}}" width="25px">  -->
									{{__('site.arabic')}}
									@break
									@default
									<!-- <img src="{{asset('images/flag/en.png')}}" width="25px">  -->
									{{__('site.english')}}
								@endswitch
								<span class="caret"></span>
							</a>
							<div class="dropdown-menu dropdown-menu-right" aria-labelledby="navbarDropdown">
								<a class="dropdown-item" href="{{ route('switchLang', 'en') }}">
									<!-- <img src="{{asset('images/flag/en.png')}}" width="25px">  -->
									{{__('site.english')}}</a>
								<a class="dropdown-item" href="{{ route('switchLang', 'ar') }}">
									<!-- <img src="{{asset('images/flag/ar.png')}}" width="25px">  -->
									{{__('site.arabic')}}</a>
							</div>
						</li>
						@else
						<li class="nav-item dropdown">
							<a id="navbarDropdown2" class="nav-link dropdown-toggle" href="#" role="button"
							data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
								@switch($locale)
									@case('en')
									<!-- <img src="{{asset('images/flag/en.png')}}" width="25px">  -->
									{{__('site.english')}}
									@break
									@case('ar')
									<!-- <img src="{{asset('images/flag/ar.png')}}" width="25px">  -->
									{{__('site.arabic')}}
									@break
									@default
									<!-- <img src="{{asset('images/flag/en.png')}}" width="25px">  -->
									{{__('site.english')}}
								@endswitch
								<span class="caret"></span>
							</a>
							<div class="dropdown-menu dropdown-menu-right" aria-labelledby="navbarDropdown2">
								<a class="dropdown-item" href="{{ route('switchLang', 'en') }}">
									<!-- <img src="{{asset('images/flag/en.png')}}" width="25px">  -->
									{{__('site.english')}}</a>
								<a class="dropdown-item" href="{{ route('switchLang', 'ar') }}">
									<!-- <img src="{{asset('images/flag/ar.png')}}" width="25px">  -->
									{{__('site.arabic')}}</a>
							</div>
						</li>
						<li class="nav-item {{ (request()->is('contact')) ? 'active' : '' }}"><a class="nav-link" href="{{ route('contact') }}">{{__('site.contact')}}</a></li>
						<li class="nav-item {{ (request()->is('about')) ? 'active' : '' }}"><a class="nav-link" href="{{ route('about') }}">{{__('site.about')}}</a></li>
						<li class="nav-item {{ (!request()->is('about') && !request()->is('contact')) ? 'active' : '' }}"><a class="nav-link" href="{{ route('home') }}">{{__('site.home')}}</a></li>
						@endif
					</ul>
				</div>
				@if($locale == 'ar')
			<a class="form-inline" href="{{ route('home') }}">
					<img src="{{asset('theme/images/logo.png')}}" alt="" width="250" height="120"/>
				</a>
				@endif
				
			</div>
		</nav>
	</header>
	<!-- End header -->