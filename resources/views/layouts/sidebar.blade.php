<aside class="main-sidebar sidebar-dark-primary elevation-4" style="background-color: #05353b;">
    <a href="{{ route('admin') }}" class="brand-link">
        @if(!env('IS_DEMO'))
        <img src="{{asset('theme/images/logo.png')}}"
             alt="AdminLTE Logo"
             class="brand-image img-circle elevation-3">
             @endif
        <span style="font-size: 17px;" class="brand-text font-weight-light">{{env('IS_DEMO') ? 'AUR Restaurant' : 'menu'}}</span>
    </a>

    <div class="sidebar">
        <nav class="mt-2">
            <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
                @include('layouts.menu')
            </ul>
        </nav>
    </div>

</aside>


