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
                <h1 class="flex-grow-1 fs-3 fw-semibold my-2 my-sm-3"> View Users</h1>
                <nav class="flex-shrink-0 my-2 my-sm-0 ms-sm-3" aria-label="breadcrumb">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"> Users</li>
                        <li class="breadcrumb-item active" aria-current="page">View</li>
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
                <h3 class="block-title">View Users
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
                        <th>First Name</th>
                        <th class="d-none d-sm-table-cell" style="width: 30%;">Last Name</th>
                        <th class="d-none d-sm-table-cell" style="width: 30%;">Email</th>
                        <th class="d-none d-sm-table-cell" style="width: 30%;">Address</th>
                        <th class="d-none d-sm-table-cell" style="width: 30%;">Country</th>
                        <th class="d-none d-sm-table-cell" style="width: 30%;">Image</th>
                        <th>Roles</th>
                        <th>Action</th>
                    </tr>
                    </thead>
                    <tbody>
                    @foreach($users as $newUsers)
                        <tr>
                            <td class="text-center">{{$newUsers->id}}</td>
                            <td class="fw-semibold">
                                <a href="javascript:void(0)">{{$newUsers->first_name}}</a>
                            </td>
                            <td class="fw-semibold">
                                <a href="javascript:void(0)">{{$newUsers->last_name}}</a>
                            </td>
                            <td class="fw-semibold">
                                <a href="javascript:void(0)">{{$newUsers->email}}</a>
                            </td>
                            <td class="fw-semibold">
                                <a href="javascript:void(0)">{{$newUsers->address}}</a>
                            </td>
                            <td class="fw-semibold">
                                <a href="javascript:void(0)">{{$newUsers->country}}</a>
                            </td>
                            <td class="fw-semibold">
                                <a href="javascript:void(0)">{{$newUsers->image}}</a>
                            </td>
                            <td class="fw-semibold">
                                @foreach($newUsers->roles as $newRoles)
                                    <a href="javascript:void(0)">{{$newRoles->name}}</a>
                                @endforeach
                            </td>


                            <td class="text-muted">
                                <a href="{{route('users.edit',$newUsers->id)}}" class="btn btn-primary">Edit </a>
                                <form action="{{route('users.destroy',$newUsers->id)}}" method="DELETE">
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
