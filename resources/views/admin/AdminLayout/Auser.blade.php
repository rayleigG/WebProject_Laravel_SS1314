<!DOCTYPE html>
<html lang="en">
    @include("admin.includes.head")
<body>
    <div class="container-xxl position-relative bg-white d-flex p-0">
    @include("admin.includes.sidebar")
        <!-- Content Start -->
        <div class="content">
            <!-- Navbar Start -->
            @include("admin.includes.Header")
            <!-- Navbar End -->
            <!--HOME-->
            @yield("content")
            <!--HOME-->
            @include("admin.includes.credit")
        </div>
        <!-- Content End -->
        <!-- Back to Top -->
        <a href="#" class="btn btn-lg btn-primary btn-lg-square back-to-top"><i class="bi bi-arrow-up"></i></a>
    </div>
    @include("admin.includes.footer")
</body>
</html>