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
                <h1 class="flex-grow-1 fs-3 fw-semibold my-2 my-sm-3">Create News </h1>
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
                        <form action="{{route('news.store')}}" method="POST" enctype="multipart/form-data">
                            @csrf
                            @method('POST')
                            <div class="mb-4">
                                <label class="form-label" for="example-text-input">News Title <span class="text-danger">*</span></label>
                                <input type="text" class="form-control" id="val-categoryName" name="news_title"  placeholder=" News Title">
                                @error('news_title')
                                <div class="alert alert-danger">{{ $message }}</div>
                                @enderror
                            </div>
                            <div class="mb-4">
                                <label class="form-label" for="example-text-input">Content </label>
                                <textarea id="js-ckeditor5-classic" name="content"></textarea>
                                @error('content')
                                <div class="alert alert-danger">{{ $message }}</div>
                                @enderror
                            </div>
                            <div class="mb-4">
                                <label class="form-label" for="author">Author</label>
                                <select class="form-select" id="example-select" name="author_id">
                                    @foreach($authors as $newAuthors)
                                        @if ($authors->isEmpty())
                                            <option selected="">No data available</option>
                                        @else
                                                <option value="{{$newAuthors->id}}">{{$newAuthors->user->email}}</option>
                                        @endif
                                    @endforeach
                                </select>
                                @error('author_id')
                                <div class="alert alert-danger">{{ $message }}</div>
                                @enderror
                            </div>
                            <div class="mb-4">
                                <label class="form-label" for="newsCategory">NewsCategory</label>
                                <select class="form-select" id="example-select" name="news_category">
                                    @if($newsCategory->isEmpty())
                                        <option selected="">No data available</option>
                                    @else
                                    @foreach($newsCategory as $newNewsCategory )
                                            <option value="{{$newNewsCategory->id}}">{{$newNewsCategory->category_name}}</option>
                                        @endforeach
                                       @endif
                                </select>
                                @error('news_category')
                                <div class="alert alert-danger">{{ $message }}</div>
                                @enderror
                            </div>
                            <div class="mb-4">
                                <label class="form-label" for="example-file-input">Image</label>
                                <input class="form-control" type="file" id="example-file-input" name="image">
                                @error('news_category')
                                <div class="alert alert-danger">{{ $message }}</div>
                                @enderror
                            </div>
                            <div class="mb-4">
                                <label class="form-label" for="video_url">Video URL <span class="text-danger">*</span></label>
                                <input type="text" class="form-control" id="video_url" name="video_url"  placeholder="Video URL">
                            </div>
                            <div class="mb-4">
                                <label class="form-label">Is Trending</label>
                                <div class="space-y-2">
                                    <div class="form-check">
                                        <input class="form-check-input" type="radio" id="example-radios-default1" name="is_trending" value="1" checked="">
                                        <label class="form-check-label" for="example-radios-default1">Active</label>
                                    </div>
                                    <div class="form-check">
                                        <input class="form-check-input" type="radio" id="example-radios-default2" name="is_trending" value="0">
                                        <label class="form-check-label" for="example-radios-default2">Deactivated</label>
                                    </div>
                                </div>
                            </div>
                            <div class="mb-4">
                                <label class="form-label">Featured News</label>
                                <div class="space-y-2">
                                    <div class="form-check">
                                        <input class="form-check-input" type="radio" id="example-radios-default1" name="is_featured" value="1" checked="">
                                        <label class="form-check-label" for="example-radios-default1">Active</label>
                                    </div>
                                    <div class="form-check">
                                        <input class="form-check-input" type="radio" id="example-radios-default2" name="is_featured" value="0">
                                        <label class="form-check-label" for="example-radios-default2">Deactivated</label>
                                    </div>
                                </div>
                            </div>
                            <div class="mb-4">
                                <label class="form-label">Recommended News</label>
                                <div class="space-y-2">
                                    <div class="form-check">
                                        <input class="form-check-input" type="radio" id="example-radios-default1" name="is_recommended" value="1" checked="">
                                        <label class="form-check-label" for="example-radios-default1">Active</label>
                                    </div>
                                    <div class="form-check">
                                        <input class="form-check-input" type="radio" id="example-radios-default2" name="is_recommended" value="0">
                                        <label class="form-check-label" for="example-radios-default2">Deactivated</label>
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

