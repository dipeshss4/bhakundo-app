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
                <h1 class="flex-grow-1 fs-3 fw-semibold my-2 my-sm-3"> View Matches</h1>
                <nav class="flex-shrink-0 my-2 my-sm-0 ms-sm-3" aria-label="breadcrumb">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"> View</li>
                        <li class="breadcrumb-item active" aria-current="page">Matches</li>
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
                <h3 class="block-title">View Matches
            </div>
            <div class="block-content block-content-full">
                @if(session()->has('errors'))
                    <div class="alert alert-danger">
                        {{ session('errors') }}
                    </div>
                @endif
                    @if(session()->has('success'))
                        <div class="alert alert-danger">
                            {{ session('success') }}
                        </div>
                    @endif
                <!-- DataTables init on table by adding .js-dataTable-full class, functionality is initialized in js/pages/tables_datatables.js -->
                <table class="table table-bordered table-striped table-vcenter js-dataTable-full">
                    <thead>
                    <tr>
                        <th class="text-center" style="width: 80px;">#</th>
                        <th>Home Team Name</th>
                        <th class="d-none d-sm-table-cell" style="width: 30%;">Away Team Name</th>
                        <th class="d-none d-sm-table-cell" style="width: 30%;">Home Team Score</th>
                        <th class="d-none d-sm-table-cell" style="width: 30%;">Away Team Score</th>
                        <th class="d-none d-sm-table-cell" style="width: 30%;">Stadium Name</th>
                        <th>Location</th>
                        <th>Match Date</th>
                        <th>Status</th>
                        <th>Action</th>
                    </tr>
                    </thead>
                    <tbody>
                    @foreach($matches as $newMatches)
                        <tr>
                            <td class="text-center">{{$newMatches->id}}</td>
                            <td class="text-center">{{$newMatches->homeTeam->name}}</td>
                            <td class="fw-semibold">
                                <a href="javascript:void(0)">{{$newMatches->awayTeam->name}}</a>
                            </td>
                            <td class="fw-semibold">
                                <a href="javascript:void(0)">{{$newMatches->home_team_score}}</a>
                            </td>
                            <td class="fw-semibold">
                                <a href="javascript:void(0)">{{$newMatches->away_team_score}}</a>
                            </td>
                            <td class="fw-semibold">
                                <a href="javascript:void(0)">{{$newMatches->stadium}}</a>
                            </td>
                            <td class="fw-semibold">
                                <a href="javascript:void(0)">{{$newMatches->location}}</a>
                            </td>
                            <td class="fw-semibold">
                                <a href="javascript:void(0)">{{$newMatches->match_date_time}}</a>
                            </td>
                            <td class="fw-semibold">
                                @if($newMatches->status == 'pending')
                                    <span class="badge badge-primary">Pending</span>
                                @elseif($newTeams->status == 'completed')
                                    <span class="badge badge-primary">Completed</span>
                                @elseif($newTeams->status == 'cancelled')
                                    <span class="badge badge-primary">cancelled</span>
                                @endif

                            </td>

                            <td class="text-muted">
                                <a href="{{route('match.edit',$newMatches->id)}}" class="btn btn-primary">Edit </a>
                                <form action="{{route('match.destroy',$newMatches->id)}}" method="Post">
                                    @csrf
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
