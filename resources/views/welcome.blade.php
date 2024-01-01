@extends('layouts.app')

@section('content')
    <div class="position-relative fixed-top container-fluid w-100 min-vh-100 p-0">
        <div class="postion-absolute mt-4 container-fluid w-100 min-vh-100 d-flex justify-content-center align-items-center top-50 p-0 m-0"
            style="z-index: 99!important;">
            <a type="button" href="{{ route('home') }}" class="btn btn-light m-2">Get Started</a>
            <a type="button" href="{{ route('login') }}" class="btn btn-light m-2">Login</a>
        </div>
        <div class="position-absolute container-fluid w-100 min-vh-100 p-0 top-0"
            style="background-image: url('{{ asset('Assets/Images/hero.png') }}');filter: blur(8px); background-position: center;
        background-repeat: no-repeat;
        z-index:-1!important;
        background-size: cover;">
        </div>

    </div>
@endsection
