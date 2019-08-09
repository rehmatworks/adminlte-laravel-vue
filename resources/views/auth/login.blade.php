@extends('layouts.auth')

@section('title')
Sign In
@endsection

@section('content')
<div class="login-box-body">
    <p class="login-box-msg">Sign in to your account</p>
    <form action="{{ route('login') }}" method="post">
        @csrf
        <div class="form-group has-feedback{{ $errors->has('email') ? ' has-error' : '' }}">
            <input type="email" name="email" value="{{ old('email') }}" class="form-control" placeholder="Email address">
            <span class="glyphicon glyphicon-envelope form-control-feedback"></span>
            <span class="help-block">{{ $errors->has('email') ? $errors->first('email') :  '' }}</span>
        </div>
        <div class="form-group has-feedback{{ $errors->has('password') ? ' has-error' : '' }}">
            <input type="password" name="password" class="form-control" placeholder="Account password">
            <span class="glyphicon glyphicon-lock form-control-feedback"></span>
            <span class="help-block">{{ $errors->has('password') ? $errors->first('password') :  '' }}</span>
            <small>Forgot your password? <a href="{{ route('password.request') }}">Reset it here</a></small>
        </div>
        <div class="row">
            <div class="col-xs-4 pull-right">
                <button type="submit" class="btn btn-primary btn-block btn-flat">Sign In</button>
            </div>
        </div>
    </form>
</div>
<p class="text-center" style="margin-top: 10px;">
    Need an account? <a href="{{ route('register') }}" class="text-center">Sign Up</a>
</p>
@endsection
