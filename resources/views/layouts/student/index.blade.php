@extends('layouts.app')

@section('content')
    <section>
        @include('layouts.backdrop.index')
        <div class="login" style="margin-top: 20vh;">

            <div class="container">
                <div class="row d-flex justify-content-center align-items-end">
                    <div class="col-sm-12 col-md-4">
                        <div class="left_part">
                            <h1 class="m-0" style="font-weight: bold">Welcome To</h1>
                            <img src="{{ asset('images/com/Homapage/Logo.png') }}" alt="" class="img-fluid mb-3"
                                style="max-width:200px">
                            <img src="{{ asset('images/com/Homapage/Handshake.png') }}" alt=""
                                class="img-fluid d-none d-md-block mb-2 mx-auto" style="max-width:330px">
                        </div>
                    </div>
                    <div class="col-sm-12 col-md-4 d-flex justify-content-center" style="">
                        <div class="col-md-10">
                            <img src="{{ asset('images/com/Academy Icon.png') }}" alt="" style="width: 80px"
                                class="d-none d-md-block mb-2 mx-auto">
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
                            @if (session()->has('message'))
                                <div class="alert alert-success">
                                    {{ session()->get('message') }}
                                </div>
                            @endif
                            <form method="POST" action="{{ route('student.auth.submit') }}">
                                @csrf
                                <input id="email" type="text" class="form-control my-2" name="std_id"
                                    placeholder="Student ID">

                                <input id="password" type="text" class="form-control my-2" name="ins_id"
                                    placeholder="Institute ID">
                                <div class="col-md-12 p-0 d-flex justify-content-between align-items-baseline"
                                    style="color:#fff">
                                    <div>
                                        <input class="form-check-input" type="checkbox" name="remember" id="remember"
                                            {{ old('remember') ? 'checked' : '' }}>
                                        <label class="form-check-label remember" for="remember">
                                            {{ __('Remember Me') }}
                                        </label>
                                    </div>
                                    <div>
                                        @if (Route::has('password.request'))
                                            <a class="forget text-light" href="{{ route('password.request') }}">
                                                {{ __('Forgot Password?') }}
                                            </a>
                                        @endif
                                    </div>


                                </div>
                                <div class="d-flex justify-content-start mt-2">
                                    <button type="submit" class="btn btn-light login_submit">
                                        {{ __('Login') }}
                                    </button>
                                </div>

                            </form>
                        </div>
                    </div>

                </div>

            </div>
            <img src="{{ asset('images/com/Homapage/Handshake.png') }}" alt=""
                class="img-fluid d-md-none mt-4 mx-auto" style="max-width:330px">
        </div>

    </section>
@endsection
