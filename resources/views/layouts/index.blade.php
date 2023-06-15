<!DOCTYPE html>
<html lang="en">
@include("includes.head")

<body>
    <!-- Header -->
    @include("includes.header")
    <!-- Close Header -->
    <!-- Start Banner Hero -->
    @include("includes.slideshow")
    <!-- End Banner Hero -->
    @yield("content")
    <!-- End Featured Product -->
    @include("includes.footer")
</body>

</html>