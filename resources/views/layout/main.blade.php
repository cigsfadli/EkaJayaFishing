<html>
@include('layout.head')
<body class="animsition">
    <div class="page-wrapper">
        @include('layout.mobile-header')
        @include('layout.menu-sidebar')
        <!-- PAGE CONTAINER-->
        <div class="page-container">
            @include('layout.header-desktop')
            @include('layout.main-content')
        </div>
        <!-- END PAGE CONTAINER-->
    </div>
    @include('layout.javascript-plugin')
</body>
</html>
<!-- end document-->