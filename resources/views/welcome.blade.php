@extends('frontend.layout')

@section('content')
<div class="container">
    <div class="row">
        <h5>
            Hi, {{ auth('firebase')->user()->name }}
        </h5>
        <div class="col-md-6">
            @auth('firebase')
            <button class="btn btn-danger" type="button" onclick="logout()">Logout</button>

            @else
            <h1>Login</h1>
            <a class="btn btn-primary" href="/front/login">Login</a>
            @endauth
        </div>
    </div>
</div>



@endsection
