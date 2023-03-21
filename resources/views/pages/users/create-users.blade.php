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
                <h1 class="flex-grow-1 fs-3 fw-semibold my-2 my-sm-3">Create News Category</h1>
                <nav class="flex-shrink-0 my-2 my-sm-0 ms-sm-3" aria-label="breadcrumb">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item">Examples</li>
                        <li class="breadcrumb-item active" aria-current="page">Blank</li>
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
                    News Category
                </h3>
            </div>
            <div class="block-content">
                <div class="row push">
                    <div class="col-lg-8">
                        <form action="{{route('news-category.store')}}" method = "POST" enctype="multipart/form-data">
                            @csrf

                            <div class="mb-4">
                                <label class="form-label" for="example-text-input">First Name <span class="text-danger">*</span></label>
                                <input type="text" class="form-control" id="val-first_name" name="first_name" placeholder="First Name">
                                @error('first_name')
                                <div class="alert alert-danger">{{ $message }}</div>
                                @enderror
                            </div>
                            <div class="mb-4">
                                <label class="form-label" for="example-text-input">Last Name <span class="text-danger">*</span></label>
                                <input type="text" class="form-control" id="val-first_name" name="last_name" placeholder="Last Name">
                                @error('last_name')
                                <div class="alert alert-danger">{{ $message }}</div>
                                @enderror
                            </div>
                            <div class="mb-4">
                                <label class="form-label" for="val-email">Email <span class="text-danger">*</span></label>
                                <input type="email" class="form-control" id="val-email" name="last_name" placeholder="Enter Email">
                                @error('email')
                                <div class="alert alert-danger">{{ $message }}</div>
                                @enderror
                            </div>
                            <div class="mb-4">
                                <label class="form-label" for="val-address">Address <span class="text-danger">*</span></label>
                                <input type="email" class="form-control" id="val-address" name="address" placeholder="Enter Address">
                                @error('address')
                                <div class="alert alert-danger">{{ $message }}</div>
                                @enderror
                            </div>
                            <div class="mb-4">
                                <label class="form-label" for="val-address">Country <span class="text-danger">*</span></label>
                                <input type="email" class="form-control" id="val-country" name="country" placeholder="Enter country">
                                @error('country')
                                <div class="alert alert-danger">{{ $message }}</div>
                                @enderror
                            </div>
                            <div class="mb-4">
                                <label class="form-label" for="example-text-input">Description </label>
                                <textarea name="description" id="js-ckeditor5-classic"></textarea>
                            </div>
                            <div class="mb-4">
                                <label class="form-label" for="example-file-input">category Image</label>
                                <input class="form-control" type="file" id="example-file-input" name="image">
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

