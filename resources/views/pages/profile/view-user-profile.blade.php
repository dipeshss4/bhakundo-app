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
    <div class="content content-full content-boxed">
        <!-- Hero -->
        <div class="rounded border overflow-hidden push">
            <div class="bg-image pt-9" style="background-color: #0a53be"></div>
            <div class="px-4 py-3 bg-body-extra-light d-flex flex-column flex-md-row align-items-center">
                <a class="d-block img-link mt-n5" href="be_pages_generic_profile_v2.html">
                    <img class="img-avatar img-avatar128 img-avatar-thumb" src="assets/media/avatars/avatar13.jpg" alt="">
                </a>
                <div class="ms-3 flex-grow-1 text-center text-md-start my-3 my-md-0">
                    <h1 class="fs-4 fw-bold mb-1">{{auth()->user()->first_name,' ',auth()->user()->last_name}}</h1>

                </div>
                <div class="space-x-1">
                    <a href="{{route('editProfile',Auth::user()->id)}}" class="btn btn-sm btn-alt-secondary space-x-1">
                        <i class="fa fa-pencil-alt opacity-50"></i>
                        <span>Edit Profile</span>
                    </a>
                </div>
            </div>
        </div>
        <!-- END Hero -->

        <div class="content content-full content-boxed">
            <h2 class="content-heading">
                <i class="si si-note me-1"></i> Latest Posts
            </h2>
            @foreach($article as $newArticle)
            <a class="block block-rounded block-link-shadow mb-3" href="{{route('news.edit',$newArticle->id)}}">
                <div class="block-content block-content-full d-flex align-items-center justify-content-between">
                    <h4 class="fs-base text-primary mb-0">
                        <i class="fa fa-newspaper text-muted me-1"></i> {{$newArticle->title}}
                    </h4>
                    <p class="fs-sm text-muted mb-0 ms-2 text-end">
                        {{$newArticle->created_at->diffInHours(\Carbon\Carbon::now())}}
                    </p>
                </div>
            </a>
            @endforeach
            <div class="text-end">
                <button type="button" class="btn btn-alt-primary">
                    Check out more <i class="fa fa-arrow-right ms-1"></i>
                </button>
            </div>
            <!-- END Latest Posts -->
        </div>
    </div>
    <!-- END Page Content -->
@endsection
