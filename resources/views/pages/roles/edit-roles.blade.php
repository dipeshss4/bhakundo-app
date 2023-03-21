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
                <h1 class="flex-grow-1 fs-3 fw-semibold my-2 my-sm-3">Edit Roles</h1>
                <nav class="flex-shrink-0 my-2 my-sm-0 ms-sm-3" aria-label="breadcrumb">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item">Edit</li>
                        <li class="breadcrumb-item active" aria-current="page">Roles</li>
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
                    Edit Role
                </h3>
            </div>
            <div class="block-content">
                <div class="row push">
                    <div class="col-lg-8">

                        <form action="{{route('roles.update',$roles_id->id)}}" method = "POST" enctype="multipart/form-data">
                            @method('PUT')
                            @csrf

                            <div class="mb-4">
                                <label class="form-label" for="val-role_name">Create Role <span class="text-danger">*</span></label>
                                <input type="text" class="form-control" id="val-role_name" value="{{$roles_id->name}}" name="role_name" placeholder="Role">
                                @error('role_name')
                                <div class="alert alert-danger">{{ $message }}</div>
                                @enderror
                            </div>

                            <div class="mb-4">
                                <label class="form-label" for="val-guard_name">Guard Name <span class="text-danger">*</span></label>
                                <input type="text" class="form-control" id="val-guard_name"  value="{{$roles_id->guard_name}}" name="guard_name" placeholder="Guard name ">
                                @error('guard_name')
                                <div class="alert alert-danger">{{ $message }}</div>
                                @enderror
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

