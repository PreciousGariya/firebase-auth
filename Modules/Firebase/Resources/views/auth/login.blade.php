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
                                        <label>Email<span class="text-danger">*</span></label>
                                        <div class="input-group">
                                            <div class="input-group-text"><i class="bi bi-person-fill"></i></div>
                                            <input type="email" id="email" name="email" class="form-control" placeholder="Enter email" required>
                                        </div>
                                        <span id="email-error" class="error text-danger"></span>
                                    </div>

                                    <div class="col-12">
                                        <label>Password<span class="text-danger">*</span></label>
                                        <div class="input-group">
                                            <div class="input-group-text"><i class="bi bi-lock-fill"></i></div>
                                            <input type="password" id="password" name="password" class="form-control" placeholder="Enter Password" required>
                                        </div>
                                        <span id="password-error" class="error text-danger"></span>
                                    </div>

                                    <div class="col-12">
                                        <button type="button" onclick="login()" class="btn btn-success px-4 float-end mt-4 mx-2"> Login</button>
                                        <button type="button" onclick="googleSignIn()" class="btn btn-danger px-4 float-start mt-4 mx-2"><i class="bi bi-google"></i> Login</button>
                                        <button type="button" onclick="facebookSignIn()" class="btn btn-primary px-4 float-start mt-4 mx-2"><i class="bi bi-facebook"></i> Login</button>
                                        <button type="button" onclick="twitterSignIn()" class="btn btn-primary px-4 float-start mt-4 mx-2"><i class="bi bi-twitter"></i> Twitter</button>
                                    </div>
                                </form>
                                <hr>
                                <div id="phone-auth-container">
                                    <div class="input-group mb-3">
                                        <input type="tel" id="phone-input" class="form-control" placeholder="Enter phone number" aria-label="Enter phone number" aria-describedby="button-addon2">
                                        <button class="btn btn-outline-primary" onclick="verifyPhoneNumber()" type="button" id="button-addon2">Verify</button>
                                    </div>

                                    <div id="user-status"></div>
                                </div>
                                <button class="btn btn-danger" onclick="resetPassword()">Reset Password</button>
                            </div>
                        </div>
                        <div class="col-md-5 ps-0 d-none d-md-block">
                            <div class="form-right h-100 bg-primary text-white text-center pt-5">
                                <i class="bi bi-bootstrap"></i>
                                <h2 class="fs-1">Login</h2>
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
