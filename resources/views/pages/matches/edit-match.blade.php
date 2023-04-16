@extends('layouts.backend')
@section('js')
    <script src="{{asset("js/lib/jquery.min.js")}}"></script>
    <script src="{{asset("js/plugins/ckeditor5-classic/build/ckeditor.js")}}"></script>
    <script src="{{asset("js/plugins/jquery-validation/jquery.validate.min.js")}}"></script>
    <script src="{{asset("js/plugins/jquery-validation/additional-methods.js")}}"></script>

    @vite(['resources/js/pages/ckEditor.js'])
    @vite(['resources/js/pages/Validation.js'])
@endsection
@section('content')
    <!-- Hero -->
    <div class="bg-body-light">
        <div class="content content-full">
            <div class="d-flex flex-column flex-sm-row justify-content-sm-between align-items-sm-center">
                <h1 class="flex-grow-1 fs-3 fw-semibold my-2 my-sm-3">Update Match </h1>
                <nav class="flex-shrink-0 my-2 my-sm-0 ms-sm-3" aria-label="breadcrumb">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item">Match</li>
                        <li class="breadcrumb-item active" aria-current="page">Update</li>
                    </ol>
                </nav>
            </div>
        </div>
    </div>
    <!-- END Hero -->

    <!-- Page Content -->
    <div class="content">
        <!-- Your Block -->
        <div class="block block-rounded">
            <div class="block-header block-header-default">
                <h3 class="block-title">
                    Update Match
                </h3>
                <a href="#" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#newsModal{{ $MatchEdit->id }}">Update Match Stats</a>
            </div>
            <div class="block-content">
                <div class="row push">
                    <div class="col-lg-8">
                        <form action="{{route('match.update',$MatchEdit->id)}}" method="POST" enctype="multipart/form-data">
                            @csrf
                            @method('PUT')
                            <div class="mb-4">
                                <label class="form-label" for="author">Home Team</label>
                                <select class="form-select" id="example-select" name="home_team_id">
                                    @foreach($teams as $newTeams)
                                        @if($newTeams->id == $MatchEdit->home_team_id)
                                            <option checked="" value="{{$newTeams->id}}">{{$newTeams->name}}</option>
                                            else
                                            <option  value="{{$newTeams->id}}">{{$newTeams->name}}</option>
                                        @endif

                                    @endforeach
                                </select>
                                @error('home_team_id')
                                <div class="alert alert-danger">{{ $message }}</div>
                                @enderror
                            </div>
                            <div class="mb-4">
                                <label class="form-label" for="author">Away Team</label>
                                <select class="form-select" id="example-select" name="away_team_id">
                                    @foreach($teams as $newTeams)
                                        @if($newTeams->id ==  $MatchEdit->away_team_id)
                                            <option checked="" value="{{$newTeams->id}}">{{$newTeams->name}}</option>
                                        @else
                                            <option value="{{$newTeams->id}}">{{$newTeams->name}}</option>
                                        @endif
                                    @endforeach
                                </select>
                                @error('away_team_id')
                                <div class="alert alert-danger">{{ $message }}</div>
                                @enderror
                            </div>
                            <div class="mb-4">
                                <label class="form-label" for="val-date">Home Team Score <span class="text-danger">*</span></label>
                                <input type="number" class="form-control" id="val-date" value="{{$MatchEdit->home_team_score}}" name="home_team_score"  placeholder="Home Team Score">
                                @error('')
                                <div class="alert alert-danger">{{ $message }}</div>
                                @enderror
                            </div>
                            <div class="mb-4">
                                <label class="form-label" for="val-date">Away Team Score <span class="text-danger">*</span></label>
                                <input type="number" class="form-control" id="val-date" value="{{$MatchEdit->away_team_score}}" name="away_team_score"  placeholder="Away Team Score">
                                @error('away_team_core')
                                <div class="alert alert-danger">{{ $message }}</div>
                                @enderror
                            </div>

                            <div class="mb-4">
                                <label class="form-label" for="val-date">Location <span class="text-danger">*</span></label>
                                <input type="text" class="form-control" id="val-date" value="{{$MatchEdit->location}}" name="location"  placeholder="location">
                                @error('location')
                                <div class="alert alert-danger">{{ $message }}</div>
                                @enderror
                            </div>
                            <div class="mb-4">
                                <label class="form-label" for="val-date">Stadium <span class="text-danger">*</span></label>
                                <input type="text" class="form-control" id="val-date" value="{{$MatchEdit->stadium_name}}" name="stadium_name"  placeholder="stadium_name">
                                @error('stadium_name')
                                <div class="alert alert-danger">{{ $message }}</div>
                                @enderror
                            </div>
                            <div class="mb-4">
                                <label class="form-label" for="val-date">Match Date Time<span class="text-danger">*</span></label>
                                <input type="datetime-local" class="form-control" value="{{$MatchEdit->match_date}}" id="val-date" name="match_date"  placeholder="">
                                @error('match_date')
                                <div class="alert alert-danger">{{ $message }}</div>
                                @enderror
                            </div>

                            <div class="mb-4">
                                <label class="form-label">Status</label>
                                <div class="space-y-2">

                                    <div class="form-check">
                                        <input class="form-check-input" type="radio" id="example-radios-default1" name="status" value="1" checked="">
                                        <label class="form-check-label" for="example-radios-default1">Active</label>
                                    </div>
                                    <div class="form-check">
                                        <input class="form-check-input" type="radio" id="example-radios-default2" name="status" value="0">
                                        <label class="form-check-label" for="example-radios-default2">Deactivated</label>
                                    </div>
                                </div>
                            </div>
                            <button type="submit" class="btn btn-primary">Submit</button>
                        </form>
                        <div class="modal fade" id="newsModal{{ $MatchEdit->id }}" tabindex="-1" aria-labelledby="newsModalLabel" aria-hidden="true">
                            <div class="modal-dialog modal-lg">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h5 class="modal-title" id="newsModalLabel">Update Match Statics</h5>
                                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                    </div>
                                    <div class="modal-body">
                                        <form action="{{route('match.update',$MatchEdit->id)}}" method="POST" enctype="multipart/form-data">
                                            @csrf
                                            @method('PUT')
                                            <div class="mb-4">
                                                <label class="form-label" for="author">Player Name</label>
                                                <select class="form-select" id="example-select" name="home_team_id">
                                                    @foreach($players as $newPlayers)
                                                        @if($newTeams->id == $MatchEdit->home_team_id)
                                                            <option checked="" value="{{$newTeams->id}}">{{$newTeams->name}}</option>
                                                            else
                                                            <option  value="{{$newTeams->id}}">{{$newTeams->name}}</option>
                                                        @endif

                                                    @endforeach
                                                </select>
                                                @error('home_team_id')
                                                <div class="alert alert-danger">{{ $message }}</div>
                                                @enderror
                                            </div>
                                            <div class="mb-4">
                                                <label class="form-label" for="author">Away Team</label>
                                                <select class="form-select" id="example-select" name="away_team_id">
                                                    @foreach($teams as $newTeams)
                                                        @if($newTeams->id ==  $MatchEdit->away_team_id)
                                                            <option checked="" value="{{$newTeams->id}}">{{$newTeams->name}}</option>
                                                        @else
                                                            <option value="{{$newTeams->id}}">{{$newTeams->name}}</option>
                                                        @endif
                                                    @endforeach
                                                </select>
                                                @error('away_team_id')
                                                <div class="alert alert-danger">{{ $message }}</div>
                                                @enderror
                                            </div>
                                            <div class="mb-4">
                                                <label class="form-label" for="val-date">Home Team Score <span class="text-danger">*</span></label>
                                                <input type="number" class="form-control" id="val-date" value="{{$MatchEdit->home_team_score}}" name="home_team_score"  placeholder="Home Team Score">
                                                @error('')
                                                <div class="alert alert-danger">{{ $message }}</div>
                                                @enderror
                                            </div>
                                            <div class="mb-4">
                                                <label class="form-label" for="val-date">Away Team Score <span class="text-danger">*</span></label>
                                                <input type="number" class="form-control" id="val-date" value="{{$MatchEdit->away_team_score}}" name="away_team_score"  placeholder="Away Team Score">
                                                @error('away_team_core')
                                                <div class="alert alert-danger">{{ $message }}</div>
                                                @enderror
                                            </div>

                                            <div class="mb-4">
                                                <label class="form-label" for="val-date">Location <span class="text-danger">*</span></label>
                                                <input type="text" class="form-control" id="val-date" value="{{$MatchEdit->location}}" name="location"  placeholder="location">
                                                @error('location')
                                                <div class="alert alert-danger">{{ $message }}</div>
                                                @enderror
                                            </div>
                                            <div class="mb-4">
                                                <label class="form-label" for="val-date">Stadium <span class="text-danger">*</span></label>
                                                <input type="text" class="form-control" id="val-date" value="{{$MatchEdit->stadium_name}}" name="stadium_name"  placeholder="stadium_name">
                                                @error('stadium_name')
                                                <div class="alert alert-danger">{{ $message }}</div>
                                                @enderror
                                            </div>
                                            <div class="mb-4">
                                                <label class="form-label" for="val-date">Match Date Time<span class="text-danger">*</span></label>
                                                <input type="datetime-local" class="form-control" value="{{$MatchEdit->match_date}}" id="val-date" name="match_date"  placeholder="">
                                                @error('match_date')
                                                <div class="alert alert-danger">{{ $message }}</div>
                                                @enderror
                                            </div>

                                            <div class="mb-4">
                                                <label class="form-label">Status</label>
                                                <div class="space-y-2">

                                                    <div class="form-check">
                                                        <input class="form-check-input" type="radio" id="example-radios-default1" name="status" value="1" checked="">
                                                        <label class="form-check-label" for="example-radios-default1">Active</label>
                                                    </div>
                                                    <div class="form-check">
                                                        <input class="form-check-input" type="radio" id="example-radios-default2" name="status" value="0">
                                                        <label class="form-check-label" for="example-radios-default2">Deactivated</label>
                                                    </div>
                                                </div>
                                            </div>
                                            <button type="submit" class="btn btn-primary">Submit</button>
                                    </div>
                                    <div class="modal-footer">
                                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- END Your Block -->
    </div>
    <!-- END Page Content -->


@endsection

