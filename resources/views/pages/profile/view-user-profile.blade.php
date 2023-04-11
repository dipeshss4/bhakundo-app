@extends('layouts.backend')

@section('css')
    <!-- Page JS Plugins CSS -->
    <link rel="stylesheet" href="{{ asset('js/plugins/datatables-bs5/css/dataTables.bootstrap5.min.css') }}">
    <link rel="stylesheet" href="{{ asset('js/plugins/datatables-buttons-bs5/css/buttons.bootstrap5.min.css') }}">
@endsection

@section('js')
    <!-- jQuery (required for DataTables plugin) -->
    <script src="{{ asset('js/lib/jquery.min.js') }}"></script>

    <!-- Page JS Plugins -->
    <script src="{{ asset('js/plugins/datatables/jquery.dataTables.min.js') }}"></script>
    <script src="{{ asset('js/plugins/datatables-bs5/js/dataTables.bootstrap5.min.js') }}"></script>
    <script src="{{ asset('js/plugins/datatables-buttons/dataTables.buttons.min.js') }}"></script>
    <script src="{{ asset('js/plugins/datatables-buttons-bs5/js/buttons.bootstrap5.min.js') }}"></script>
    <script src="{{ asset('js/plugins/datatables-buttons-jszip/jszip.min.js') }}"></script>
    <script src="{{ asset('js/plugins/datatables-buttons-pdfmake/pdfmake.min.js') }}"></script>
    <script src="{{ asset('js/plugins/datatables-buttons-pdfmake/vfs_fonts.js') }}"></script>
    <script src="{{ asset('js/plugins/datatables-buttons/buttons.print.min.js') }}"></script>
    <script src="{{ asset('js/plugins/datatables-buttons/buttons.html5.min.js') }}"></script>

    <!-- Page JS Code -->
    @vite(['resources/js/pages/datatables.js'])
@endsection

@section('content')
    <!-- Hero -->
    <div class="bg-body-light">
        <div class="content content-full">
            <div class="d-flex flex-column flex-sm-row justify-content-sm-between align-items-sm-center">
                <h1 class="flex-grow-1 fs-3 fw-semibold my-2 my-sm-3">News Category </h1>
                <nav class="flex-shrink-0 my-2 my-sm-0 ms-sm-3" aria-label="breadcrumb">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item">View News Category</li>
                        <li class="breadcrumb-item active" aria-current="page">News Category</li>
                    </ol>
                </nav>
            </div>
        </div>
    </div>
    <!-- END Hero -->

    <!-- Page Content -->
    <div class="content">
        <!-- Dynamic Table Full -->
        <div class="block block-rounded">
            <div class="block-header block-header-default">
                <h3 class="block-title">View All News Category
            </div>
            <div class="block-content block-content-full">
                <div class="rounded border overflow-hidden push">
                    <div class="bg-image pt-9" style="background-image: url('assets/media/photos/photo19@2x.jpg');"></div>
                    <div class="px-4 py-3 bg-body-extra-light d-flex flex-column flex-md-row align-items-center">
                        <a class="d-block img-link mt-n5" href="be_pages_generic_profile_v2.html">
                            <img class="img-avatar img-avatar128 img-avatar-thumb" src="assets/media/avatars/avatar13.jpg" alt="">
                        </a>
                        <div class="ms-3 flex-grow-1 text-center text-md-start my-3 my-md-0">
                            <h1 class="fs-4 fw-bold mb-1">John Smith</h1>
                            <h2 class="fs-sm fw-medium text-muted mb-0">
                                Edit Account
                            </h2>
                        </div>
                        <div class="space-x-1">
                            <a href="be_pages_generic_profile_v2.html" class="btn btn-sm btn-alt-secondary space-x-1">
                                <i class="fa fa-arrow-left opacity-50"></i>
                                <span>Back to Profile</span>
                            </a>
                        </div>
                    </div>
                </div>

            </div>
        </div>
        <!-- END Dynamic Table Full -->

    </div>
    <!-- END Page Content -->
@endsection
