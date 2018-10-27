@extends('layouts.loginRegister')

@section('title')
    Forgot Password
@stop



@section('body_content')
    <body class="hold-transition login-page">
    <div class="login-box">
        <div class="login-logo">
            <a href=""><b>Mobile</b> Garden</a>
        </div>
        <!-- /.login-logo -->
        <div class="login-box-body" style="overflow: hidden;">
            <p class="login-box-msg">Forgot your password</p>

            {!! Form::open(['method' => 'POST', 'action' => 'ForgetPasswordController@postForgotPassword']) !!}

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
                    {!! Form::email('email', null, ['class'=>'form-control', 'placeholder' => 'example@example.com'])
                     !!}
                    <span class="glyphicon glyphicon-lock form-control-feedback"></span>
                    @if ($errors->has('email'))
                        <span class="help-block">
                            <p class="text-red">{{ $errors->first('email') }}</p>
                        </span>
                    @endif
                </div>


                <div class="col-xs-4 pull-right">
                    {!! Form::submit('Send', ['class'=>'btn btn-primary btn-block btn-flat']) !!}
                </div>

            {!! Form::close() !!}
        </div>
        <!-- /.form-box -->
    </div>
    <!-- /.register-box -->
    @stop


    @section('javascripts')
        <!-- iCheck -->
        <script src="{{asset('libs/plugins/iCheck/icheck.min.js')}}"></script>
@stop
