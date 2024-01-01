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
                <div class="row justify-content-center align-items-center">

                @if ($article[0]->previous_link !== null)
                    <a class="btn btn-primary" href="{{$article[0]->previous_link}}" role="button">Previous</a>
                @endif
                    
                @if ($article[0]->next_link !== null)
                    <a class="btn btn-primary" href="{{$article[0]->next_link}}" role="button">Next</a>
                @endif
                </div>
            </div>
        </div>
    </div>
@endsection
