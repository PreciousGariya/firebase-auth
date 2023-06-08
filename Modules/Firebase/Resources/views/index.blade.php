@extends('firebase::layouts.master')

@section('content')
<div class="container">
    <div class="row">

        <div class="col-md-6">
            @auth('firebase')
            <h5>
                Hi, {{ auth('firebase')->user()->name }} Welcome!!
            </h5>
            <form action="{{route('laravel.auth.logout')}}" method="post">
                @csrf
                <button type="submit" class="btn btn-danger" type="button">Logout</button>
            </form>
            @else
            <h1>Login</h1>
            <a class="btn btn-primary" href="/firebase/laravel-auth">Login</a>
            @endauth
        </div>
    </div>
</div>
@endsection
