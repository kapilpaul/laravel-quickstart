@extends('layouts.loginRegister')

@section('title')
    Registration
@stop

@section('css')
    <!-- iCheck -->
    <link rel="stylesheet" href="{{asset('libs/plugins/iCheck/square/blue.css')}}">
@stop

@section('body_content')
    <body class="hold-transition register-page">
        <div class="register-box">
            <div class="register-logo">
                <a href="../../index2.html"><b>Mobile</b> Garden</a>
            </div>

            <div class="register-box-body">
                <p class="login-box-msg">Register a new membership</p>

                {!! Form::open(['method' => 'POST', 'action' => 'RegistrationController@postRegister']) !!}

                    <div class="form-group has-feedback">
                        {!! Form::text('name', null, ['class'=>'form-control', 'placeholder' => 'Name']) !!}

                        <span class="glyphicon glyphicon-user form-control-feedback"></span>
                        @if ($errors->has('name'))
                            <span class="help-block">
                                <p class="text-red">{{ $errors->first('name') }}</p>
                            </span>
                        @endif
                    </div>

                    <div class="form-group has-feedback">
                        {!! Form::email('email', null, ['class'=>'form-control', 'placeholder' => 'example@example.com'])
                         !!}
                        <span class="glyphicon glyphicon-envelope form-control-feedback"></span>
                        @if ($errors->has('email'))
                            <span class="help-block">
                                <p class="text-red">{{ $errors->first('email') }}</p>
                            </span>
                        @endif
                    </div>

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

                    <div class="row">
                        <div class="col-xs-8">
                            <div class="checkbox icheck">
                                <label>
                                    {!! Form::checkbox('remember_me', 'Remember Me', false); !!} Remember Me
                                </label>
                            </div>
                        </div>

                        <div class="col-xs-4">
                            {!! Form::submit('Register', ['class'=>'btn btn-primary btn-block btn-flat']) !!}
                        </div>
                    </div>

                {!! Form::close() !!}

                <a href="{{ route('login') }}" class="text-center">I already have a membership</a>
            </div>
            <!-- /.form-box -->
        </div>
        <!-- /.register-box -->
@stop


@section('javascripts')
    <!-- iCheck -->
    <script src="{{asset('libs/plugins/iCheck/icheck.min.js')}}"></script>
@stop
