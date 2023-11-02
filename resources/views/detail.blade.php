@extends('layouts.app')

{{-- @section('title')
@endsection --}}

@section('content')
    <div class="container-fluid">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <h2 class="text-center">
                    {{ $article[0]->title }}</h2>
                {!! $article[0]->body !!}
            </div>
        </div>
    </div>
@endsection
