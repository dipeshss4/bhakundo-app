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
                <h1 class="flex-grow-1 fs-3 fw-semibold my-2 my-sm-3">Edit News Category</h1>
                <nav class="flex-shrink-0 my-2 my-sm-0 ms-sm-3" aria-label="breadcrumb">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item">Edit</li>
                        <li class="breadcrumb-item active" aria-current="page">Edit News Category</li>
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
                        <form action="{{route('news-category.update',$editedCategory->id)}}" method = "POST" enctype="multipart/form-data">
                            @csrf

                            <div class="mb-4">
                                <label class="form-label" for="example-text-input">Category Name <span class="text-danger">*</span></label>
                                <input type="text" class="form-control" value="{{$editedCategory->category_name}}" id="val-categoryName" name="category_name" placeholder="Category Name">
                                @error('category_name')
                                <div class="alert alert-danger">{{ $message }}</div>
                                @enderror
                            </div>
                            <div class="mb-4">
                                <label class="form-label" for="example-text-input">Description </label>
                                <textarea name="description" id="js-ckeditor5-classic">{{$editedCategory->description}}</textarea>

                            </div>
                            <div class="mb-4">
                                <label class="form-label" for="example-file-input">category Image</label>
                                <input class="form-control" type="file" id="example-file-input" name="image">
                            </div>
                            <div class="mb-4">
                                <label class="form-label">Status</label>
                                <div class="space-y-2">
                                    @if($editedCategory->status == 1)
                                        <div class="form-check">
                                            <input class="form-check-input" type="radio" id="example-radios-default1" name="status" value="1" checked>
                                            <label class="form-check-label" for="example-radios-default1">Active</label>
                                        </div>
                                        <div class="form-check">
                                            <input class="form-check-input" type="radio" id="example-radios-default2" name="status" value="0">
                                            <label class="form-check-label" for="example-radios-default2">Deactivated</label>
                                        </div>
                                    @else
                                        <div class="form-check">
                                            <input class="form-check-input" type="radio" id="example-radios-default1" name="status" value="1" >
                                            <label class="form-check-label" for="example-radios-default1">Active</label>
                                        </div>
                                        <div class="form-check">
                                            <input class="form-check-input" type="radio" id="example-radios-default2" name="status" value="0" checked>
                                            <label class="form-check-label" for="example-radios-default2">Deactivated</label>
                                        </div>
                                    @endif

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

