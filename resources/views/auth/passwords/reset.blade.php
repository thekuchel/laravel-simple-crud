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

                        <h5 class="mb-4 text-center">Forgot Password</h5>
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

                        <form method="POST" action="/change-forgot-password/{{$code}}" class="user">
                            <input type="hidden" name="_token" value="{{ csrf_token() }}">

                            <div class="form-group mb-3">
                                <label class="form-label" for="name">Password Baru<span class="text-danger"><b>*</b></span> :</label>
                                <input type="password" class="form-control form-control-user" name="password"
                                    placeholder="{{ __('Password') }}" required>
                            </div>

                            <div class="form-group mb-3">
                                <label class="form-label" for="name">Konfirmasi Password Baru <span class="text-danger"><b>*</b></span> :</label>
                                <input type="password" class="form-control form-control-user" name="password_confirmation"
                                    placeholder="{{ __('Confirm Password') }}" required>
                            </div>

                            <div class="form-group">
                                <button type="submit" class="btn btn-primary btn-user w-100">
                                    {{ __('Reset Password') }}
                                </button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
