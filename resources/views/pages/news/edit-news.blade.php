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
                        <form action="{{route('news.update',$newsEdit->id)}}" method="POST" enctype="multipart/form-data">
                            @csrf
                            @method('PUT')
                            <div class="mb-4">
                                <label class="form-label" for="example-text-input">News Title <span class="text-danger">*</span></label>
                                <input type="text" class="form-control" id="val-categoryName"  value="{{$newsEdit->title}}" name="news_title"  placeholder=" News Title">
                                @error('news_title')
                                <div class="alert alert-danger">{{ $message }}</div>
                                @enderror
                            </div>
                            <div class="mb-4">
                                <label class="form-label" for="example-text-input">Content </label>
                                <textarea id="js-ckeditor5-classic"  name="content">{{$newsEdit->content}}</textarea>
                                @error('content')
                                <div class="alert alert-danger">{{ $message }}</div>
                                @enderror
                            </div>
                            <div class="mb-4">
                                <label class="form-label" for="example-text-input">Meta Description </label>
                                <textarea class="form-control" name="meta_description">{{$newsEdit->meta_description}}</textarea>
                                @error('meta_description')
                                <div class="alert alert-danger">{{ $message }}</div>
                                @enderror
                            </div>
                            <div class="mb-4">
                                <label class="form-label" for="author">Author</label>
                                <select class="form-select" id="example-select" name="author_id">
                                    @foreach($authors as $newAuthors)
                                        @if ($newAuthors->id == $newsEdit->author_id)
                                            <option selected=""value="{{$newAuthors->id}}">{{$newAuthors->user->email}}</option>
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
                                    @foreach($newsCategory as $newNewsCategory )
                                    @if($newNewsCategory->id == $newsEdit->news_category_id)
                                        <option selected value="{{$newNewsCategory->id}}">{{$newNewsCategory->category_name}}</option>
                                    @else
                                            <option value="{{$newNewsCategory->id}}">{{$newNewsCategory->category_name}}</option>
                                    @endif
                                    @endforeach
                                </select>
                                @error('news_category')
                                <div class="alert alert-danger">{{ $message }}</div>
                                @enderror
                            </div>
                            <div class="mb-4">
                                <label class="form-label" for="example-file-input">Image</label>
                                <div>
                                    <img src="{{ $newsEdit->image_url }}" alt="Old Image" style="max-width: 200px; max-height: 200px;">
                                </div>
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
                                @if($newsEdit->is_trending == 1)
                                    <div class="space-y-2">
                                        <div class="form-check">
                                            <input class="form-check-input" type="radio" id="is_trending" name="is_trending" value="1" checked>
                                            <label class="form-check-label" for="is_trending">Active</label>
                                        </div>
                                        <div class="form-check">
                                            <input class="form-check-input" type="radio" id="is_trending" name="is_trending" value="0">
                                            <label class="form-check-label" for="is_trending">Deactivated</label>
                                        </div>
                                    </div>
                                @else
                                    <div class="space-y-2">
                                        <div class="form-check">
                                            <input class="form-check-input" type="radio" id="is_trending" name="is_trending" value="1" >
                                            <label class="form-check-label" for="is_trending">Active</label>
                                        </div>
                                        <div class="form-check">
                                            <input class="form-check-input" type="radio" id="is_trending" name="is_trending" value="0" checked>
                                            <label class="form-check-label" for="is_trending">Deactivated</label>
                                        </div>
                                    </div>
                                @endif

                            </div>
                            <div class="mb-4">
                                <label class="form-label">Featured News</label>
                                @if($newsEdit->featured == 1)
                                    <div class="space-y-2">
                                        <div class="form-check">
                                            <input class="form-check-input" type="radio" id="is_featured" name="is_featured" value="1" checked>
                                            <label class="form-check-label" for="is_featured">Active</label>
                                        </div>
                                        <div class="form-check">
                                            <input class="form-check-input" type="radio" id="is_featured" name="is_featured" value="0">
                                            <label class="form-check-label" for="is_featured">Deactivated</label>
                                        </div>
                                    </div>
                                @else

                                    <div class="space-y-2">
                                        <div class="form-check">
                                            <input class="form-check-input" type="radio" id="is_featured" name="is_featured" value="1" >
                                            <label class="form-check-label" for="is_featured">Active</label>
                                        </div>
                                        <div class="form-check">
                                            <input class="form-check-input" type="radio" id="is_featured" name="is_featured" value="0" checked>
                                            <label class="form-check-label" for="is_featured">Deactivated</label>
                                        </div>
                                    </div>
                                @endif

                            </div>
                            <div class="mb-4">
                                <label class="form-label">Recommended News</label>
                                @if($newsEdit->recommended)
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
                                @else
                                    <div class="space-y-2">
                                        <div class="form-check">
                                            <input class="form-check-input" type="radio" id="example-radios-default1" name="is_recommended" value="1" >
                                            <label class="form-check-label" for="example-radios-default1">Active</label>
                                        </div>
                                        <div class="form-check">
                                            <input class="form-check-input" type="radio" id="example-radios-default2" name="is_recommended" value="0" checked="">
                                            <label class="form-check-label" for="example-radios-default2">Deactivated</label>
                                        </div>
                                    </div>
                                @endif

                            </div>
                            <div class="mb-4">
                                <label class="form-label">Status</label>
                                 @if($newsEdit->status == 1)
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
                                        @else
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

