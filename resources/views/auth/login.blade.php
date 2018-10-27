@extends('layouts.app')

@section('title')
    Login
@stop



@section('content')
    <div class="login-box">
        <div class="login-logo">
            <a href=""><b>Dummy</b> Text</a>
        </div>
        <!-- /.login-logo -->
        <div class="login-box-body">
            <p class="login-box-msg">Sign in to start your session</p>

            {!! Form::open(['method' => 'POST', 'url' => route('postLogin')]) !!}

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

            <div class="row">
                <div class="col-xs-8">
                    <div class="checkbox icheck">
                        <label>
                            {!! Form::checkbox('remember_me', 'on', false); !!} Remember Me
                        </label>
                    </div>
                </div>

                <div class="col-xs-4">
                    {!! Form::submit('Sign In', ['class'=>'btn btn-primary btn-block btn-flat']) !!}
                </div>
            </div>

            {!! Form::close() !!}

            <a href="{{ route('forgotpassword') }}">I forgot my password</a>
        </div>
        <!-- /.form-box -->
    </div>
    <!-- /.register-box -->
    @stop


    @section('javascripts')
        <!-- iCheck -->
        <script src="{{asset('libs/plugins/iCheck/icheck.min.js')}}"></script>
@stop
