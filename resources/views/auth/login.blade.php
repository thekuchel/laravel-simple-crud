@extends('layouts.auth')

@section('main-content')

    <div class="nk-app-root">
        <!-- main @s -->
        <div class="nk-main ">
            <!-- wrap @s -->
            <div class="nk-wrap nk-wrap-nosidebar">
                <!-- content @s -->
                    <div class="nk-content ">
                        <div class="nk-block nk-block-middle nk-auth-body  wide-xs">
                            <div class="brand-logo pb-4 text-center">
                                <a href="html/index.html" class="logo-link">
                                    <img class="logo-light logo-img logo-img-lg" src="./images/logo.png"
                                        srcset="./images/logo2x.png 2x" alt="logo">
                                    <img class="logo-dark logo-img logo-img-lg" src="./images/logo-dark.png"
                                        srcset="./images/logo-dark2x.png 2x" alt="logo-dark">
                                </a>
                            </div>
                            <div class="card card-bordered">
                                <div class="card-inner card-inner-lg">
                                    <div class="nk-block-head">
                                        <div class="nk-block-head-content">
                                            <h4 class="nk-block-title">Thekuchel Admin</h4>
                                            <div class="nk-block-des">
                                                <p>Admin Dashboard</p>
                                            </div>
                                        </div>
                                    </div>
                                    @if ($errors->any())
                                        <div class="alert alert-danger border-left-danger" role="alert">
                                            @foreach ($errors->all() as $error)
                                                {{ $error }}
                                            @endforeach
                                        </div>
                                    @endif

                                    @if ($message = Session::get('success'))
                                        <div class="alert alert-success">
                                            {{ $message }}
                                        </div>
                                    @endif
                                    <form id="formAuthentication" class="mb-3" method="POST">
                                        @csrf
                                        <div class="form-group">
                                            <div class="form-label-group">
                                                <label class="form-label" for="username">Username</label>
                                            </div>
                                            <div class="form-control-wrap">
                                                <input type="text" class="form-control form-control-lg" id="username"
                                                    name="username" value="{{ old('username') ? old('username') : '' }}"
                                                    placeholder="Username anda" autofocus />
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <div class="form-label-group">
                                                <label class="form-label" for="password">Password</label>
                                                <a href="/forgot_password">
                                                    <small>Ganti Password <i class="bx bx-link-external"></i></small>
                                                </a>
                                            </div>
                                            <div class="form-control-wrap">
                                                <a href="#" class="form-icon form-icon-right passcode-switch lg"
                                                    data-target="password">
                                                    <em class="passcode-icon icon-hide icon ni ni-eye-off"></em>
                                                    <em class="passcode-icon icon-show icon ni ni-eye"></em>
                                                </a>
                                                <input type="password" id="password" class="form-control form-control-lg" name="password"
                                                    placeholder="&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;"
                                                    aria-describedby="password" />
                                            </div>
                                        </div>
                                        <div class="mb-3">
                                            <div class="form-check">
                                                <input class="form-check-input" type="checkbox" id="remember-me"
                                                    name="remember-me" />
                                                <label class="form-check-label" for="remember-me"> Ingat Saya </label>
                                            </div>
                                        </div>
                                        <div class="mb-3">
                                            <button class="btn btn-lg btn-primary btn-block" type="submit">Sign in</button>
                                        </div>
                                        <hr />
                                        <p class="fw-bold">Belum punya akun? hubungi divisi terkait</p>
                                        <a href="/forgot-password" class="btn btn-lg btn-outline-primary w-100">Lupa Password</a>
                                    </form>

                                </div>
                            </div>
                            <!-- /Register -->
                        </div>
                    </div>
                </div>

                <script src="/assets/vendor/js/helpers.js"></script>
            @endsection
