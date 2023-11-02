@extends('layouts.app')

@section('css')
    <style>
        #item {
            text-decoration: none;
        }

        #item:hover {
            text-decoration: underline;
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
                            Posts
                        </div>
                        {{-- <a type="button" href="{{ route('admin.article.create.view') }}" class="btn btn-primary">
                            Create Post
                        </a> --}}
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
                                                <div class="col-9">
                                                    <h4>
                                                        {{ $article->title }}
                                                    </h4>
                                                </div>
                                            </div>
                                        </a>
                                        <hr>
                                    </li>
                                </ul>
                                {{-- {!! $article->body !!} --}}
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
