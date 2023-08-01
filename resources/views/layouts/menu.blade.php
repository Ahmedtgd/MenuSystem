<li class="nav-item ">
    <a href="{{ route('allSliders') }}" class="nav-link {{ (request()->is('sliders')) ? 'active' : '' }}">
    <i class="nav-icon fas fa-sliders-h"></i>
        <p>Sliders</p>
    </a>
</li>
<li class="nav-item">
    <a href="{{ route('allCategories') }}" class="nav-link  {{ (request()->is('categories')) ? 'active' : '' }}">
        <i class="nav-icon fas fa-list-alt"></i>
        <p>Categories</p>
    </a>
</li>
<li class="nav-item">
    <a href="{{ route('tags.index') }}" class="nav-link  {{ (request()->is('tags.index')) ? 'active' : '' }}">
        <i class="nav-icon fas fa-list-alt"></i>
        <p>Tags</p>
    </a>
</li>
<li class="nav-item">
            <a href="#" class="nav-link {{ (request()->is('products')) ? 'active' : '' }}">
            <i class="nav-icon fab fa-product-hunt"></i>
              <p>
                Products
                <i class="fas fa-angle-left right"></i>
              </p>
            </a>
            <ul class="nav nav-treeview" style="display: none;">
              <li class="nav-item">
                <a href="{{ route('allProducts') }}" class="nav-link">
                  <i class="fa fa-list nav-icon"></i>
                  <p>All products</p>
                </a>
              </li>
              <li class="nav-item">
                <a href="{{ route('orderedProducts') }}" class="nav-link">
                  <i class="fa fa-sort nav-icon"></i>
                  <p>Ordering</p>
                </a>
              </li>
            </ul>
          </li>
<li class="nav-item ">
    <a href="{{ route('allFeedbacks') }}" class="nav-link {{ (request()->is('feedbacks')) ? 'active' : '' }}">
        <i class="nav-icon fa fa-star"></i>
        <p>Feedback</p>
    </a>
    
</li>
<li class="nav-item ">
    <a href="{{ route('allDevices') }}" class="nav-link {{ (request()->is('devices')) ? 'active' : '' }}">
        <i class="nav-icon fa fa-mobile"></i>
        <p>Devices</p>
    </a>
    
</li>

<li class="nav-item ">
    <a href="{{ route('updateApkPassword') }}" class="nav-link {{ (request()->is('apk-password')) ? 'active' : '' }}">
        <i class="nav-icon fa fa-key"></i>
        <p>Update APK Password</p>
    </a>
    
</li>
