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
                        <li class="breadcrumb-item">News</li>
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
                    Create News
                </h3>
            </div>
            <div class="block-content">
                <div class="row push">
                    <div class="col-lg-8">
                        <form>
                            <div class="mb-4">
                                <label class="form-label" for="example-text-input">News Title <span class="text-danger">*</span></label>
                                <input type="text" class="form-control" id="val-categoryName" name="news_title"  placeholder="Category Name">
                            </div>
                            <div class="mb-4">
                                <label class="form-label" for="example-text-input">Content </label>
                                <div id="js-ckeditor5-classic" name="content"></div>
                            </div>
                            <div class="mb-4">
                                <label class="form-label" for="author">Author</label>
                                <select class="form-select" id="example-select" name="author">
                                    @foreach($authors as $newAuthors)
                                        @if(isEmptyOrNullString($newAuthors))
                                            <option selected="">No any Data</option>
                                        @endif

                                        <option value="{{$newAuthors->user_id}}">{{$newAuthors->user_id}}</option>
                                    @endforeach

                                </select>
                            </div>
                            <div class="mb-4">
                                <label class="form-label" for="newsCategory">NewsCategory</label>
                                <select class="form-select" id="example-select" name="newsCategory">
                                    <option selected="">Open this select menu</option>
                                    <option value="1">Option #1</option>

                                </select>
                            </div>
                            <div class="mb-4">
                                <label class="form-label" for="example-file-input">Image</label>
                                <input class="form-control" type="file" id="example-file-input">
                            </div>
                            <div class="mb-4">
                                <label class="form-label" for="video_url">Video URL <span class="text-danger">*</span></label>
                                <input type="text" class="form-control" id="video_url" name="video_url"  placeholder="Category Name">
                            </div>
                            <div class="mb-4">
                                <label class="form-label">Status</label>
                                <div class="space-y-2">
                                    <div class="form-check">
                                        <input class="form-check-input" type="radio" id="example-radios-default1" name="example-radios-default" value="1" checked="">
                                        <label class="form-check-label" for="example-radios-default1">Active</label>
                                    </div>
                                    <div class="form-check">
                                        <input class="form-check-input" type="radio" id="example-radios-default2" name="example-radios-default" value="0">
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

