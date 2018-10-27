@extends('layouts.loginRegister')

@section('title')
    Reset Password
@stop



@section('body_content')
    <body class="hold-transition login-page">
    <div class="login-box">
        <div class="login-logo">
            <a href=""><b>Mobile</b> Garden</a>
        </div>
        <!-- /.login-logo -->
        <div class="login-box-body" style="overflow: hidden;">
            <p class="login-box-msg">Reset your password</p>

            {!! Form::open(['method' => 'POST', 'action' => ['ForgetPasswordController@postResetPassword',
            $user->email, $reminder->code]])
             !!}

            @if(session('error'))
                <div class="alert alert-danger">
                    <p>{{session('error')}}</p>
                </div>
            @endif
            @if(session('success'))
                <div class="alert alert-success">
                    <p>{{session('success')}}</p>
                </div>
            @endif

            <div class="form-group has-feedback">
                {!! Form::password('password', ['class'=>'form-control', 'placeholder' => 'Password'])
                 !!}
                <span class="glyphicon glyphicon-lock form-control-feedback"></span>
                @if ($errors->has('password'))
                    <span class="help-block">
                        <p class="text-red">{{ $errors->first('password') }}</p>
                    </span>
                @endif
            </div>

            <div class="form-group has-feedback">
                {!! Form::password('password_confirmation', ['class'=>'form-control', 'placeholder' => 'Retype Password'])
                 !!}
                <span class="glyphicon glyphicon-log-in form-control-feedback"></span>
            </div>


            <div class="col-xs-4 pull-right">
                {!! Form::submit('Reset', ['class'=>'btn btn-primary btn-block btn-flat']) !!}
            </div>

            {!! Form::close() !!}
        </div>
        <!-- /.form-box -->
    </div>
    <!-- /.register-box -->
    @stop


    @section('javascripts')
        <!-- iCheck -->
        <script src="{{ asset('libs/plugins/iCheck/icheck.min.js') }}"></script>
@stop
