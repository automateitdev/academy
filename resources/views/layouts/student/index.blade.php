@extends('layouts.app')

@section('content')
<div class="login">
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-sm-4 col-md-4 offset-md-2">
                <div class="left_part">
                    <h1>Welcome To</h1>
                    <a href="#">
                        <img src="{{asset('images/com/Homapage/Logo.png')}}" alt="">
                    </a>
                    <img src="{{asset('images/com/Homapage/Handshake.png')}}" alt="">
                </div>
            </div>
            <div class="col-sm-4 col-md-4">
                <div class="cards">
                    <div class="card-headers">
                        <a href="#">
                            <img src="{{asset('images/com/Academy Icon.png')}}" alt="">
                        </a>
                        <p class="s-title">Student Portal</p>
                    </div>

                    <div class="card-bodys">
                    @if ($errors->any())
                        <div class="alert alert-danger">
                            <strong>Whoops!</strong> There were some problems with your input.<br><br>
                            <ul>
                                @foreach ($errors->all() as $error)
                                    <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                        </div>
                    @endif
                    @if(session()->has('message'))
                        <div class="alert alert-success">
                            {{ session()->get('message') }}
                        </div>
                    @endif
                        <form method="POST" action="{{ route('student.auth.submit') }}">
                            @csrf

                            <div class="row mb-3">
                                <!-- <label for="email" class="col-md-4 col-form-label text-md-end">{{ __('Email Address') }}</label> -->

                                <div class="col-md-6">
                                    <input id="email" type="text" class="form-control" name="std_id" placeholder="Student ID">
                                </div>
                            </div>

                            <div class="row mb-3">
                                <!-- <label for="password" class="col-md-4 col-form-label text-md-end">{{ __('Password') }}</label> -->

                                <div class="col-md-6">
                                    <input id="password" type="text" class="form-control" name="ins_id" placeholder="Institute ID">
                                </div>
                            </div>

                            <div class="row mb-3">
                                <div class="">
                                    <div class="form-check">
                                        <div class="row">
                                            <div class="col-sm-3 col-md-3">
                                                <input class="form-check-input" type="checkbox" name="remember" id="remember" {{ old('remember') ? 'checked' : '' }}>
                                                <label class="form-check-label remember" for="remember">
                                                    {{ __('Remember Me') }}
                                                </label>
                                            </div>
                                            <div class="col-sm-6 col-md-6">
                                                @if (Route::has('password.request'))
                                                    <a class="btn btn-link forget" href="{{ route('password.request') }}">
                                                        {{ __('Forgot Your Password?') }}
                                                    </a>
                                                @endif
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div class="row mb-0">
                                <div class="col-md-5">
                                <div class="">
                                        <button type="submit" class="btn btn-primary login_submit">
                                            {{ __('Login') }}
                                        </button>
                                    </div>
                                </div>
                                <div class="col-md-7"></div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
            <div class="col-sm-2 col-md-2"></div>
        </div>
    </div>
</div>
@endsection
