@extends('layouts.app')

@section('css')
    <style>
        #item {
            text-decoration: none;
            
        }
    </style>
@endsection

@section('content')
    <div class="container-fluid">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header d-flex justify-content-between align-items-center">
                        <div>
                            Your Posts
                        </div>
                        <a type="button" href="{{ route('admin.article.create.view') }}" class="btn btn-primary">
                            Create Post
                        </a>
                    </div>
                    <div class="card-body">
                        @if (count($articles) <= 0)
                            No Articles uploaded
                        @else
                            @foreach ($articles as $article)
                                <ul style="list-style-type: none;">
                                    <li>
                                        <a href="{{ url('/article/detail/' . $article->id) }}" id="item">
                                            <div class="row align-items-center">
                                                <div class="col-3">
                                                    <img src="{{ $article->image }}" alt="" style="width:100px">
                                                </div>
                                                <div class="col-6" style="max-height:120px !important;overflow: hidden; white-space: warp; text-overflow: ellipsis !important;">
                                                    <div class="row">
                                                        <h4>
                                                            {{ $article->title }}
                                                        </h4>
                                                    </div>
                                                    
                                                    <div class="row" style="overflow: hidden; text-overflow: ellipsis;">
                                                    <!-- {!! $article->body !!} -->
                                                        <!-- <div class="collapse" id="collapseExample">
                                                            <div class="card card-body"> -->
                                                                {!! $article->body !!}
                                                            <!-- </div>
                                                        </div> -->
                                                    </div>
                                                    ...
                                                </div>

                                            </div>
                                        </a>
                                        <div class="container-fluid">
                                            <div class="row justify-content-end">
                                                <div class="col-3 mt-3 d-flex justify-content-end">
                                                    <div><a href="{{ url('/admin/articles/edit/' . $article->id) }}"
                                                            id="item" type="button" class="btn btn-success"><i class='fas fa-marker'></i>Edit</a>
                                                            <!-- <button type="button" value="Copy Url" onclick="Copy();" ></button> -->
                                                            <button type="button" class="btn btn-secondary" onclick="Copy({{$article->id}});">Copy url</button>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <hr>
                                    </li>
                                </ul>
                            @endforeach
                        @endif
                        {{-- @if (session('status'))
                            <div class="alert alert-success" role="alert">
                                {{ session('status') }}
                            </div>
                        @endif

                        {{ __('You are logged in!') . auth()->user()->is_admin }} --}}
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('additionalscript')
<script>
    function Copy(id) {
        let url = '{{ env("APP_URL")}}'+"/article/detail/" +id.toString();

        navigator.clipboard.writeText(url).then(function() {
            console.log('Copied!');
        }, function() {
            console.log('Copy error')
        });
    }
</script>
@endsection
