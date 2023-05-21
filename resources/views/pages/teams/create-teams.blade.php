@extends('layouts.backend')
@section('js')
    <script src="{{asset("js/lib/jquery.min.js")}}"></script>
    <script src="{{asset("js/plugins/ckeditor5-classic/build/ckeditor.js")}}"></script>
    <script src="{{asset("js/plugins/jquery-validation/jquery.validate.min.js")}}"></script>
    <script src="{{asset("js/plugins/jquery-validation/additional-methods.js")}}"></script>


    @vite(['resources/js/pages/ckEditor.js'])
    @vite(['resources/js/pages/Validation.js'])
    @vite(['resources/js/pages/ImagePreview.js'])
@endsection
@section('content')
    <!-- Hero -->
    <div class="bg-body-light">
        <div class="content content-full">
            <div class="d-flex flex-column flex-sm-row justify-content-sm-between align-items-sm-center">
                <h1 class="flex-grow-1 fs-3 fw-semibold my-2 my-sm-3">Create Teams </h1>
                <nav class="flex-shrink-0 my-2 my-sm-0 ms-sm-3" aria-label="breadcrumb">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item">Teams</li>
                        <li class="breadcrumb-item active" aria-current="page">Create</li>
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
                    Create Teams
                </h3>
            </div>
            <div class="block-content">
                <div class="row push">
                    <div class="col-lg-8">
                        <form action="{{route('teams.store')}}" method="POST" enctype="multipart/form-data">
                            @csrf
                            @method('POST')
                            <div class="mb-4">
                                <label class="form-label" for="example-text-input">Team Name <span class="text-danger">*</span></label>
                                <input type="text" class="form-control" id="val-name" name="name"  placeholder=" Team Name">
                                @error('name')
                                <div class="alert alert-danger">{{ $message }}</div>
                                @enderror
                            </div>
                            <div class="mb-4">
                                <label class="form-label" for="author">League</label>
                                <select class="form-select" id="example-select" name="league_id">
                                    @foreach($league as $newLeague)
                                        @if ($league->isEmpty())
                                            <option selected="">No data available</option>
                                        @else
                                            <option value="{{$newLeague->id}}">{{$newLeague->name}}</option>
                                        @endif
                                    @endforeach
                                </select>
                                @error('league_id')
                                <div class="alert alert-danger">{{ $message }}</div>
                                @enderror
                            </div>
                            <div class="mb-4">
                                <label class="form-label" for="example-text-input">Team Location <span class="text-danger">*</span></label>
                                <input type="text" class="form-control" id="val-name" name="location"  placeholder=" Team location">
                                @error('location')
                                <div class="alert alert-danger">{{ $message }}</div>
                                @enderror
                            </div>
                            <div class="mb-4">
                                <label class="form-label" for="example-text-input">Coach Name <span class="text-danger">*</span></label>
                                <input type="text" class="form-control" id="val-name" name="coach_name"  placeholder=" Team Coach Name">

                                @error('coach_name')
                                <div class="alert alert-danger">{{ $message }}</div>
                                @enderror
                            </div>
                            <div class="mb-4">
                                <label class="form-label" for="logo">Coach Image</label>
                                <input class="form-control" type="file" id="coach_image" name="coach_image">
                                <div class="card mt-3" style="max-width: 200px;">
                                    <img id="preview" class="card-img-top" src="#" alt="Preview" style="display: none;">
                                    <div class="card-body">
                                        <h5 class="card-title">Image Preview</h5>
                                    </div>
                                </div>
                                @error('coach_image')
                                <div class="alert alert-danger">{{ $message }}</div>
                                @enderror
                            </div>
                            <div class="mb-4">
                                <label class="form-label" for="logo">Logo</label>
                                <input class="form-control" type="file" id="logo" name="logo">
                                <div class="card mt-3" style="max-width: 200px;">
                                    <img id="preview-logo" class="card-img-top" src="#" alt="Preview" style="display: none;">
                                    <div class="card-body">
                                        <h5 class="card-title">Image Preview</h5>
                                    </div>
                                </div>
                                @error('logo')
                                <div class="alert alert-danger">{{ $message }}</div>
                                @enderror
                            </div>
                            <div class="mb-4">
                                <label class="form-label">Is Nation Teams</label>
                                <div class="space-y-2">
                                    <div class="form-check">
                                        <input class="form-check-input" type="radio" id="example-radios-default1" name="is_national" value="1" checked="">
                                        <label class="form-check-label" for="example-radios-default1">Yes</label>
                                    </div>
                                    <div class="form-check">
                                        <input class="form-check-input" type="radio" id="example-radios-default2" name="is_national" value="0">
                                        <label class="form-check-label" for="example-radios-default2">No</label>
                                    </div>
                                </div>
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
                    </div>
                </div>
            </div>
        </div>
        <!-- END Your Block -->
    </div>
    <!-- END Page Content -->


@endsection

