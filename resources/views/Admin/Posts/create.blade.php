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
                <h2>Create an Article</h2>
                <form method="POST" action="{{ route('admin.article.create.store', ['_token' => csrf_token()]) }}"
                    enctype="multipart/form-data">
                    @csrf

                    <div class="form-group">
                        <label for="title">Title</label>
                        <input type="text" class="form-control" id="title" name="title"
                            placeholder="Enter the title" required>
                        @error('title')
                            <p class="text-danger">{{ $message }}</p>
                        @enderror
                    </div>

                    <div class="form-group mt-3">
                        <label for="image">Article Image</label>
                        <input type="file" class="form-control-file" id="image" name="image" accept="image/*"
                            required>
                        @error('image')
                            <p class="text-danger">{{ $message }}</p>
                        @enderror
                    </div>

                    <div class="form-group mt-3">
                        <label for="body">Article Body</label>
                        <textarea name="body" id="body" class="form-control ckeditor"></textarea>
                        @error('body')
                            <p class="text-danger">{{ $message }}</p>
                        @enderror
                    </div>

                    <button type="submit" class="btn btn-primary mt-3">Create Article</button>
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
                    <div><label for=""></label></div>
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
