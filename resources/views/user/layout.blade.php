<!DOCTYPE html>
<html lang="en">
<!-- Basic -->
<head>
    @include('user.header.header')
</head>

<body>
    <!-- Start Main Top -->
    @include('user.header.main_top')
    <!-- End Top Search -->
    @yield("content")
    <!-- Start Footer  -->
    @include('user.footer.footer')

    <!-- ALL JS FILES -->
    @include('user.footer.scripts')
</body>
</html>