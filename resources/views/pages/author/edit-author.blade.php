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
                <h1 class="flex-grow-1 fs-3 fw-semibold my-2 my-sm-3">Create Author</h1>
                <nav class="flex-shrink-0 my-2 my-sm-0 ms-sm-3" aria-label="breadcrumb">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item">Author</li>
                        <li class="breadcrumb-item active" aria-current="page">Edit</li>
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
                    Author
                </h3>
            </div>
            <div class="block-content">
                <div class="row push">
                    <div class="col-lg-8">
                        <form action="{{route('author.update',$author->id)}}" method = "POST" enctype="multipart/form-data">
                            @method('PUT')
                            @csrf
                            <div class="mb-4">
                                <label class="form-label" for="author">Users</label>
                                <select class="form-select" id="example-select" name="author_id">
                                    @foreach($users as $newUsers)
                                        @if($newUsers->id == $author->user_id)
                                            <option checked="" value="{{$newUsers->id}}">{{$newUsers->email}}</option>
                                        @else
                                            <option  value="{{$newUsers->id}}">{{$newUsers->email}}</option>
                                        @endif
                                    @endforeach
                                </select>
                            </div>
                            <div class="mb-4">
                                <label class="form-label">Status</label>
                                @if($author->status == 1)
                                    <div class="space-y-2">
                                        <div class="form-check">
                                            <input class="form-check-input" type="radio" id="example-radios-default1" name="status" value="1" checked>
                                            <label class="form-check-label" for="example-radios-default1">Active</label>
                                        </div>
                                        <div class="form-check">
                                            <input class="form-check-input" type="radio" id="example-radios-default2" name="status" value="0">
                                            <label class="form-check-label" for="example-radios-default2">Deactivated</label>
                                        </div>
                                    </div>
                                @else
                                    <div class="space-y-2">
                                        <div class="form-check">
                                            <input class="form-check-input" type="radio" id="example-radios-default1" name="status" value="1" >
                                            <label class="form-check-label" for="example-radios-default1">Active</label>
                                        </div>
                                        <div class="form-check">
                                            <input class="form-check-input" type="radio" id="example-radios-default2" name="status" value="0" checked>
                                            <label class="form-check-label" for="example-radios-default2">Deactivated</label>
                                        </div>
                                    </div>
                                @endif

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

