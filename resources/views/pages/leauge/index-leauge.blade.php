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
                <h1 class="flex-grow-1 fs-3 fw-semibold my-2 my-sm-3"> View League</h1>
                <nav class="flex-shrink-0 my-2 my-sm-0 ms-sm-3" aria-label="breadcrumb">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"> View</li>
                        <li class="breadcrumb-item active" aria-current="page">League</li>
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
                <h3 class="block-title">View League
            </div>
            <div class="block-content block-content-full">
                @if(session()->has('errors'))
                    <div class="alert alert-danger">
                        {{ session('errors') }}
                    </div>
                @endif
                <!-- DataTables init on table by adding .js-dataTable-full class, functionality is initialized in js/pages/tables_datatables.js -->
                <table class="table table-bordered table-striped table-vcenter js-dataTable-full">
                    <thead>
                    <tr>
                        <th class="text-center" style="width: 80px;">#</th>
                        <th>League Name</th>
                        <th class="d-none d-sm-table-cell" style="width: 30%;">Country</th>
                        <th class="d-none d-sm-table-cell" style="width: 30%;">Start Year</th>
                        <th class="d-none d-sm-table-cell" style="width: 30%;">End Year</th>
                        <th>Format</th>
                        <th>Logo</th>
                        <th>Status</th>
                        <th>Action</th>
                    </tr>
                    </thead>
                    <tbody>
                    @foreach($league as $newLeague)
                        <tr>
                            <td class="text-center">{{$newLeague->id}}</td>
                            <td class="fw-semibold">
                                <a href="javascript:void(0)">{{$newLeague->name}}</a>
                            </td>
                            <td class="fw-semibold">
                                <a href="javascript:void(0)">{{$newLeague->country}}</a>
                            </td>
                            <td class="fw-semibold">
                                <a href="javascript:void(0)">{{$newLeague->start_year}}</a>
                            </td>
                            <td class="fw-semibold">
                                <a href="javascript:void(0)">{{$newLeague->year_ending}}</a>
                            </td>
                            <td class="fw-semibold">
                                <a href="javascript:void(0)">{{$newLeague->format}}</a>
                            </td>
                            <td>
                                <img src="{{ asset($newLeague->logo) }}" class="img-thumbnail">
                            </td>
                            <td class="fw-semibold">
                                @if($newLeague->status == 1)
                                    <span class="badge badge-primary">Active</span>
                                @else
                                    <span class="badge badge-primary">Deactivated</span>
                                @endif

                            </td>

                            <td class="text-muted">
                                <a href="{{route('leauge.edit',$newLeague->id)}}" class="btn btn-primary">Edit </a>
                                <form action="{{route('leauge.destroy',$newLeague->id)}}" method="DELETE">
                                    @method('DELETE')
                                    <button class="btn btn-danger">Delete</button>
                                </form>
                            </td>
                        </tr>
                    @endforeach
                    </tbody>
                </table>
            </div>
        </div>
        <!-- END Dynamic Table Full -->

    </div>
    <!-- END Page Content -->
@endsection
