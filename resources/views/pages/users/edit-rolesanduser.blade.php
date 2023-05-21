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
                <h1 class="flex-grow-1 fs-3 fw-semibold my-2 my-sm-3">Create User Create</h1>
                <nav class="flex-shrink-0 my-2 my-sm-0 ms-sm-3" aria-label="breadcrumb">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item">Create</li>
                        <li class="breadcrumb-item active" aria-current="page">Users</li>
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
                    User Create
                </h3>
            </div>
            <div class="block-content">
                <div class="row push">
                    <div class="col-lg-8">
                        <form action="{{route('users.update',$users->id)}}" method = "POST" enctype="multipart/form-data">
                            @method('PUT')
                            @csrf

                            <div class="mb-4">
                                <label class="form-label" for="example-text-input">First Name <span class="text-danger">*</span></label>
                                <input type="text" class="form-control" id="val-first_name" value="{{$users->first_name}}" name="first_name" placeholder="First Name">
                                @error('first_name')
                                <div class="alert alert-danger">{{ $message }}</div>
                                @enderror
                            </div>
                            <div class="mb-4">
                                <label class="form-label" for="example-text-input">Last Name <span class="text-danger">*</span></label>
                                <input type="text" class="form-control" id="val-first_name" value="{{$users->last_name}}" name="last_name" placeholder="Last Name">
                                @error('last_name')
                                <div class="alert alert-danger">{{ $message }}</div>
                                @enderror
                            </div>
                            <div class="mb-4">
                                <label class="form-label" for="val-email">Email <span class="text-danger">*</span></label>
                                <input type="email" class="form-control" id="val-email"  value="{{$users->email}}" name="email" placeholder="Enter Email">
                                @error('email')
                                <div class="alert alert-danger">{{ $message }}</div>
                                @enderror
                            </div>
                            <div class="mb-4">
                                <label class="form-label" for="val-address">Address <span class="text-danger">*</span></label>
                                <input type="text" class="form-control" id="val-address" value="{{$users->address}}" name="address" placeholder="Enter Address">
                                @error('address')
                                <div class="alert alert-danger">{{ $message }}</div>
                                @enderror
                            </div>
                            <div class="mb-4">
                                <label class="form-label" for="val-address">Country <span class="text-danger">*</span></label>
                                <input type="text" class="form-control" id="val-country" name="country" value="{{$users->country}}" placeholder="Enter country">
                                @error('country')
                                <div class="alert alert-danger">{{ $message }}</div>
                                @enderror
                            </div>
                            <div class="mb-4">
                                <label class="form-label" for="val-address">Password <span class="text-danger">*</span></label>
                                <input type="password" class="form-control" id="val-country" name="password"  placeholder="Enter Password">
                                @error('password')
                                <div class="alert alert-danger">{{ $message }}</div>
                                @enderror
                            </div>
                            <div class="mb-4">
                                <label class="form-label" for="val-address">Confirm Password <span class="text-danger">*</span></label>
                                <input id="password"  class="form-control" type="password" name="password_confirmation"  placeholder="Re Enter Password" required>
                            </div>
                            <div class="mb-4">
                                <label class="form-label" for="author">Roles</label>
                                <select class="form-select" id="example-select" name="roles" multiple>
                                    @foreach($roles as $roleData)
                                        <option  value="{{$roleData->id}}">{{$roleData->name}}</option>
                                    @endforeach
                                </select>
                                @error('country')
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

