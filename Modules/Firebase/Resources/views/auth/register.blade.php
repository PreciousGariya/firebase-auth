@extends('firebase::layouts.master')

@section('content')
<div class="login-page bg-light">
    <div class="container">
        <div class="row">
            <div class="col-lg-10 offset-lg-1">
                <div class="bg-white shadow rounded">
                    <div class="row">
                        <div class="col-md-7 pe-0">
                            <div class="form-left h-100 py-5 px-5">
                                <form class="row g-4">
                                    <div class="text-danger" id="error_div"></div>
                                    <div class="col-12">
                                        <label>Name<span class="text-danger">*</span></label>
                                        <div class="input-group">
                                            <div class="input-group-text"><i class="bi bi-person-fill"></i></div>
                                            <input type="text" id="name" name="name" class="form-control" placeholder="Enter Name" required>
                                        </div>
                                    </div>
                                    <div class="col-12">
                                        <label>Email<span class="text-danger">*</span></label>
                                        <div class="input-group">
                                            <div class="input-group-text"><i class="bi bi-person-fill"></i></div>
                                            <input type="email" id="email" name="email" class="form-control" placeholder="Enter email" required>
                                        </div>
                                    </div>

                                    <div class="col-12">
                                        <label>Password<span class="text-danger">*</span></label>
                                        <div class="input-group">
                                            <div class="input-group-text"><i class="bi bi-lock-fill"></i></div>
                                            <input type="password" id="password" name="password" class="form-control" placeholder="Enter Password" required>
                                        </div>
                                    </div>
                                    <div class="col-12">
                                        <button type="button" onclick="register()" class="btn btn-danger px-4 float-end mt-4"><i class="bi bi-google"></i> Register</button>
                                    </div>
                                </form>
                            </div>
                        </div>
                        <div class="col-md-5 ps-0 d-none d-md-block">
                            <div class="form-right h-100 bg-primary text-white text-center pt-5">
                                <i class="bi bi-bootstrap"></i>
                                <h2 class="fs-1">Register</h2>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<style>
    a {
        text-decoration: none;
    }

    .login-page {
        width: 100%;
        height: 100vh;
        display: inline-block;
        display: flex;
        align-items: center;
    }

    .form-right i {
        font-size: 100px;
    }
</style>

@endsection
