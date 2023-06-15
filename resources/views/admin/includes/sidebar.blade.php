<!-- Header -->
<!-- Spinner Start -->

<!-- Spinner End -->


<!-- Sidebar Start -->
<div class="sidebar pe-4 pb-3">
    <nav class="navbar bg-light navbar-light">
        <a href="/wp-admin" class="navbar-brand mx-4 mb-3">
            <h3 class="text-primary"><i class="fa fa-hashtag me-2"></i>DASHMIN</h3>
        </a>
        <div class="d-flex align-items-center ms-4 mb-4">
            <div class="position-relative">
                <img class="rounded-circle" src={{url("admin/img/user.jpg")}} alt="" style="width: 40px; height: 40px;">
                <div class="bg-success rounded-circle border border-2 border-white position-absolute end-0 bottom-0 p-1"></div>
            </div>
            <div class="ms-3">
                <h6 class="mb-0">{{ Auth::user()->name }}</h6>
                <span>Admin</span>
            </div>
        </div>
        <div class="navbar-nav w-100">
            <a href="{{ url('/wp-admin') }}" class="nav-item nav-link{{ Request::url() == url('/wp-admin') ? ' active' : '' }}"><i class="fas fa-chart-line"></i>Dashboard</a>
            <a href="{{ url('/wp-admin/product') }}" class="nav-item nav-link{{ Request::url() == url('/wp-admin/product') ? ' active' : '' }}"><i class="fab fa-product-hunt"></i>Product</a>
            <a href="{{ url('/wp-admin/category') }}" class="nav-item nav-link{{ Request::url() == url('/wp-admin/category') ? ' active' : '' }}"><i class="fas fa-layer-group"></i>Category</a>
            <a href="{{ url('/wp-admin/slideshow') }}" class="nav-item nav-link{{ Request::url() == url('/wp-admin/slideshow') ? ' active' : '' }}"><i class="fab fa-slideshare"></i>Slideshow</a>
            <a href="{{ url('/wp-admin/page') }}" class="nav-item nav-link{{ Request::url() == url('/wp-admin/page') ? ' active' : '' }}"><i class="fas fa-book-open"></i>Page</a>
            <a href="{{ url('/wp-admin/user') }}" class="nav-item nav-link{{ Request::url() == url('/wp-admin/user') ? ' active' : '' }}"><i class="fas fa-users"></i>User</a>
            <a href="{{ url('/wp-admin/config') }}" class="nav-item nav-link{{ Request::url() == url('/wp-admin/config') ? ' active' : '' }}"><i class="fas fa-users-cog"></i>Configuration</a>
        </div>
    </nav>
</div>
<!-- Sidebar End -->
<!--Header-->