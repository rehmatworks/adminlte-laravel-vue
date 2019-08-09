@extends('layouts.auth')

@section('title')
Sign Up
@endsection

@section('content')
<div class="login-box-body">
    <p class="login-box-msg">Sign in to your account</p>
    <form action="{{ route('register') }}" method="post">
        @csrf
        <div class="form-group has-feedback{{ $errors->has('email') ? ' has-error' : '' }}">
            <input type="email" name="email" value="{{ old('email') }}" class="form-control" placeholder="Email address">
            <span class="glyphicon glyphicon-envelope form-control-feedback"></span>
            <span class="help-block">{{ $errors->has('email') ? $errors->first('email') :  '' }}</span>
        </div>
        <div class="form-group has-feedback{{ $errors->has('name') ? ' has-error' : '' }}">
            <input type="text" name="name" value="{{ old('name') }}" class="form-control" placeholder="Full name">
            <span class="glyphicon glyphicon-user form-control-feedback"></span>
            <span class="help-block">{{ $errors->has('name') ? $errors->first('name') :  '' }}</span>
        </div>
        <div class="form-group has-feedback{{ $errors->has('password') ? ' has-error' : '' }}">
            <input type="password" name="password" class="form-control" placeholder="Set account password">
            <span class="glyphicon glyphicon-lock form-control-feedback"></span>
            <span class="help-block">{{ $errors->has('password') ? $errors->first('password') :  '' }}</span>
        </div>
        <div class="form-group has-feedback">
            <input type="password" name="password_confirmation" class="form-control" placeholder="Confirm password">
            <span class="glyphicon glyphicon-lock form-control-feedback"></span>
        </div>
        <div class="row">
            <div class="col-xs-4 pull-right">
                <button type="submit" class="btn btn-primary btn-block btn-flat">Sign Up</button>
            </div>
        </div>
    </form>
</div>
<p class="text-center" style="margin-top: 10px;">
    Already have an account? <a href="{{ route('login') }}" class="text-center">Sign In</a>
</p>
@endsection
