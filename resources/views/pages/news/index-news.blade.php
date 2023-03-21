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
    @vite(['resources/js/pages/viewNews.js'])
    @vite(['resources/js/pages/datatables.js'])
@endsection

@section('content')
    <!-- Hero -->
    <div class="bg-body-light">
        <div class="content content-full">
            <div class="d-flex flex-column flex-sm-row justify-content-sm-between align-items-sm-center">
                <h1 class="flex-grow-1 fs-3 fw-semibold my-2 my-sm-3">News  </h1>
                <nav class="flex-shrink-0 my-2 my-sm-0 ms-sm-3" aria-label="breadcrumb">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item">View News </li>
                        <li class="breadcrumb-item active" aria-current="page">News </li>
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
                <h3 class="block-title">View All News
            </div>
            <div class="block-content block-content-full">
                <!-- DataTables init on table by adding .js-dataTable-full class, functionality is initialized in js/pages/tables_datatables.js -->
                <table class="table table-bordered table-striped table-vcenter js-dataTable-full">
                    <thead>
                    <tr>
                        <th class="text-center" style="width: 80px;">#</th>
                        <th> News Title</th>
                        <th class="d-none d-sm-table-cell" style="width: 30%;">Content</th>
                        <th>Image</th>
                        <th>Video</th>
                        <th>Author Name</th>
                        <th>News Category</th>
                        <th style="width: 15%;">Status</th>
                        <th>Action</th>
                    </tr>
                    </thead>
                    <tbody>
                    @foreach($news as $newNews)
                        <tr>
                            <td class="text-center">{{$newNews->id}}</td>
                            <td class="fw-semibold">
                                <a href="javascript:void(0)">{{$newNews->title}}</a>
                            </td>
                            <td class="d-none d-sm-table-cell">
                                <a href="#" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#newsModal{{ $newNews->id }}">View</a>
                            </td>
                            <td class="d-none d-sm-table-cell">

                            </td>
                            <td class="d-none d-sm-table-cell">
                                {{$newNews->video_url}}
                            </td>
                            <td class="d-none d-sm-table-cell">
                                {{$newNews->author->user->first_name}}
                            </td>
                            <td class="d-none d-sm-table-cell">
                                {{$newNews->category->category_name}}
                            </td>
                            <td class="text-muted">
                                @if($newNews->status  == 1)
                                    <span class="btn-alt-primary">Active</span>
                                @else
                                    <span class="text-bg-danger">Deactivated</span>
                                @endif
                            </td>
                            <td class="text-muted">
                                <a href="{{route('news.edit',$newNews->id)}}" class="btn btn-primary">Edit </a>
                                <form action="{{route('news.destroy',$newNews->id)}}" method="DELETE">
                                    @method('DELETE')
                                    <button class="btn btn-danger">Delete</button>
                                </form>
                            </td>
                        </tr>
                        <div class="modal fade" id="newsModal{{ $newNews->id }}" tabindex="-1" aria-labelledby="newsModalLabel" aria-hidden="true">
                            <div class="modal-dialog modal-lg">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h5 class="modal-title" id="newsModalLabel">{{ $newNews->title }}</h5>
                                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                    </div>
                                    <div class="modal-body">
                                        <p>{{ $newNews->content }}</p>
                                    </div>
                                    <div class="modal-footer">
                                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                                    </div>
                                </div>
                            </div>
                        </div>
                    @endforeach
                    </tbody>
                </table>

        <!-- END Dynamic Table Full -->

    </div>

    <!-- END Page Content -->
@endsection
@section('js')
    <script>
        $(function() {
            $('table tbody').on('click', 'tr', function() {
                $('#exampleModalLabel').text($(this).find('td:first').text());
                $('#modal-content').text($(this).data('content'));
                $('#modal-image').attr('src', $(this).data('image'));
            });
        });

    </script>
@endsection
