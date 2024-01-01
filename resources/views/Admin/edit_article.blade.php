@extends('layouts.app')

@section('libcdn')
    {{-- <script src="https://cdn.ckeditor.com/ckeditor5/40.0.0/classic/ckeditor.js"></script> --}}
    <script src="https://cdn.ckeditor.com/ckeditor5/40.0.0/classic/ckeditor.js"></script>

    <style>
        .ck-editor__editable[role="textbox"] {
            /* editing area */
            min-height: 200px;
        }

        .ck-content .image {
            /* block images */
            max-width: 80%;
            margin: 20px auto;
        }
    </style>
@endsection

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-8 offset-md-2">
                <h2>UPdate an Article</h2>
                <form method="POST" action="{{ route('admin.article.edit.update', $article[0]->id) }}"
                    enctype="multipart/form-data">
                    @csrf
                    {{-- @method('PUT') Use the HTTP method for updating, typically PUT or PATCH --}}

                    <div class="form-group">
                        <label for="title">Title</label>
                        <input type="text" class="form-control" id="title" name="title"
                            value="{{ old('title', $article[0]->title) }}" required>
                        @error('title')
                            <p class="text-danger">{{ $message }}</p>
                        @enderror
                    </div>

                    <div class="form-group">
                        <label for="next_link">Next link</label>
                        <input type="text" class="form-control" id="next_link" name="next_link"
                            value="{{ old('next_link', $article[0]->next_link !==null ? $article[0]->next_link: '') }}" >
                    </div>
                    <div class="form-group">
                        <label for="previous_link">Previous link</label>
                        <input type="text" class="form-control" id="previous_link" name="previous_link"
                            value="{{ old('next_link', $article[0]->previous_link !==null ? $article[0]->previous_link: '') }}">
                    </div>

                    <div class="form-group mt-3 col">
                        <label for="image">Article Image (click image to edit)</label>
                        <img src="{{ $article[0]->image }}" onclick="document.getElementById('image').click()"
                            alt="" style="width:100px">
                        <input type="file" class="form-control-file d-none" id="image" name="image"
                            accept="image/*">
                        @error('image')
                            <p class="text-danger">{{ $message }}</p>
                        @enderror
                    </div>

                    <div class="form-group mt-3">
                        <label for="body">Article Body</label>
                        <textarea name="body" id="body" class="form-control ckeditor">{{ old('body', $article[0]->body) }}</textarea>
                        @error('body')
                            <p class="text-danger">{{ $message }}</p>
                        @enderror
                    </div>

                    <button type="submit" class="btn btn-primary mt-3">Update Article</button>
                </form>
            </div>
        </div>
    </div>
    {{-- <div class="container-fluid">

        <div class="row justify-content-center">
            <div class="col-md-8">
                <form action="#">
                    @csrf
                    <div>
                        <label for="title">Article Title</label>
                        <input type="text" name="title" />
                    </div>
                    <div>
                        <label for="body">Article Body</label>
                        <textarea name="body" id="editor" cols="30" rows="10">

                        </textarea>
                    </div>
                    
                </form>
            </div>
        </div>

    </div> --}}
@endsection

@section('additionalscript')
    <script>
        ClassicEditor
            .create(document.querySelector('.ckeditor'), {
                ckfinder: {
                    uploadUrl: "{{ route('admin.upload.image', ['_token' => csrf_token()]) }}",
                },
            })
            .catch(error => {
                console.error(error.message);
            });
    </script>
@endsection
