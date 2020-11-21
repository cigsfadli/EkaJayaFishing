@extends('auth.layout')
@section('content')
    
<div class="login-wrap">
    <div class="login-content">
        <div class="login-logo">
            <a href="{{ url('/') }}">
                <img src="{{ asset('assets/images/icon/logo-1.png') }}" alt="CoolAdmin">
            </a>
        </div>
        <div class="login-form">
            @if (count($errors) > 0)
                <div class="alert alert-danger">
                    @foreach ($errors->all() as $error)
                    <span>{{ $error }}</span>
                    @endforeach
                </div>
            @endif
            <form action="" method="post">
                @csrf
                <div class="form-group">
                    <label>Username</label>
                    <input class="au-input au-input--full" type="text" name="username" placeholder="Username">
                </div>
                <div class="form-group">
                    <label>Password</label>
                    <input class="au-input au-input--full" type="password" name="password" placeholder="Password">
                </div>
                <div class="login-checkbox">
                    <label>
                        <input type="checkbox" name="remember">Remember Me
                    </label>
                </div>
                <button class="au-btn au-btn--block au-btn--blue m-b-20" type="submit">sign in</button>
            </form>
            <div class="register-link">
            </div>
        </div>
    </div>
</div>
@endsection