@extends('layouts.auth')

@section('main-content')
    <div class="container-xxl">
        <div class="authentication-wrapper authentication-basic container-p-y">
            <div class="authentication-inner">
                <!-- Register -->
                <div class="card">
                    <div class="card-body">
                        <!-- Logo -->
                        <div class="app-brand justify-content-center">
                            <img src="/images/logo.png" class="img-fluid" style="max-width: 150px" />
                        </div>
                        <!-- /Logo -->
                        <h5 class="mb-2 text-center fw-bold">{{ Thekuchel Admin->customer->name }}</h5>

                        <h5 class="mb-4 text-center">Invalid Link Forgot Password</h5>
                        <hr />
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

                        @if (session('resent'))
                            <div class="alert alert-success border-left-success" role="alert">
                                {{ __('A fresh verification link has been sent to your email address.') }}
                            </div>
                        @endif

                        <p>
                            Link ini sudah kadaluarsa atau tidak valid, silahkan ulangi proses permintaan perubahan password
                            anda <a href='/forgot-password' class="text-decoration-underline">disini</a>
                        </p>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
