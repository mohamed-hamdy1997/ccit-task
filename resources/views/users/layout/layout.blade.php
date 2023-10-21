<!DOCTYPE html>
<html lang="en">

@include('users.layout.head')

<body class="skin-megna fixed-layout">
<!-- ============================================================== -->
<!-- Preloader - style you can find in spinners.css -->
<!-- ============================================================== -->
{{--<div class="preloader">--}}
{{--    <div class="loader">--}}
{{--        <div class="loader__figure"></div>--}}
{{--        <p class="loader__label">CCIT</p>--}}
{{--    </div>--}}
{{--</div>--}}
<!-- ============================================================== -->
<!-- Main wrapper - style you can find in pages.scss -->
<!-- ============================================================== -->
<div id="main-wrapper">
    <!-- ============================================================== -->
    <!-- Topbar header - style you can find in pages.scss -->
    <!-- ============================================================== -->
    @include('users.layout.navbar')
    <!-- ============================================================== -->
    <!-- End Topbar header -->
    <!-- ============================================================== -->
    <!-- ============================================================== -->
    <!-- Left Sidebar - style you can find in sidebar.scss  -->
    <!-- ============================================================== -->

    @include('users.layout.left_side')

    <!-- ============================================================== -->
    <!-- End Left Sidebar - style you can find in sidebar.scss  -->
    <!-- ============================================================== -->
    <!-- ============================================================== -->
    <!-- Page wrapper  -->
    <!-- ============================================================== -->
    <div class="page-wrapper">
        <!-- ============================================================== -->
        <!-- Container fluid  -->
        <!-- ============================================================== -->
        <div class="container-fluid">
            <!-- ============================================================== -->
            <!-- Bread crumb and right sidebar toggle -->
            <!-- ============================================================== -->
            <div class="row page-titles">
                <div class="col-md-5 align-self-center">
                    <h4 class="text-themecolor">@yield('breadcrump-header')</h4>
                </div>
                <div class="col-md-7 align-self-center text-right">
                    <div class="d-flex justify-content-end align-items-center">
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item"><a href="javascript:void(0)">Home</a></li>
                            <li class="breadcrumb-item active">
                                @yield('breadcrump-header')
                            </li>
                        </ol>
                        {{--                                        <button type="button" class="btn btn-info d-none d-lg-block m-l-15"><i--}}
                        {{--                                                class="fa fa-plus-circle"></i> Create New</button>--}}
                    </div>
                </div>
            </div>
            @if ($errors->any())
                <div class="alert alert-danger" id="alertError">
                    <span class="float-right pointer" onclick="$('#alertError').hide()">X</span>
                    <ul>
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @elseif(session()->has('error'))
                <div class="alert alert-danger" id="alertError2">
                    <span class="float-right pointer" onclick="$('#alertError2').hide()">X</span>

                    <ul>
                        <li> {{ session()->get('error') }}</li>
                    </ul>

                </div>
            @endif
            @if (session('success'))
                <div class="alert alert-success" role="alert" id="alertSuccess">
                    {{ session('success') }}
                    <span class="float-right pointer" onclick="$('#alertSuccess').hide()">X</span>
                </div>
            @endif
            @yield('content')


            @include('users.layout.right_side')
            <!-- ============================================================== -->
            <!-- End Right sidebar -->
            <!-- ============================================================== -->
        </div>
        <!-- ============================================================== -->
        <!-- End Container fluid  -->
        <!-- ============================================================== -->
    </div>
    <!-- ============================================================== -->
    <!-- End Page wrapper  -->
    <!-- ============================================================== -->
    <!-- ============================================================== -->
    <!-- footer -->
    <!-- ============================================================== -->
    <footer class="footer">
        CCIT © {{now()->year}}
    </footer>
    <!-- ============================================================== -->
    <!-- End footer -->
    <!-- ============================================================== -->
</div>
@include('users.layout.footer_scripts')
</body>

</html>
