@extends('layouts.blank')

@section('title', 'Forgot Password')

@section('main_content')
    <div class="app forgot-password usersession">
        <div class="session-wrapper">
            <div class="page-height row-equal align-middle">
                <div class="column">
                    <div class="card bg-white no-border">
                        <div class="card-block">
                                {!! Form::open([
                                    'method' => 'POST',
                                    'url' => route('postForgotpassword'),
                                    'id' => 'form-reminder', 'class' => "form-layout"
                                ]) !!}

                                <div class="text-center m-b">
                                    <h4 class="text-uppercase">Reset Password</h4>
                                </div>
                                <div class="form-inputs">
                                    {!! Form::label('reminder-email', 'Your email address', ['class' => 'text-uppercase']) !!}
                                    {!! Form::email('email', null, ['id' => "reminder-email", 'class'=>'form-control input-lg', 'placeholder' => 'example@example.com']) !!}

                                    @include('common.form.validation', ['key' => 'email'])

                                </div>
                                <button class="btn btn-primary btn-lg btn-block" type="submit">Reset Password</button>
                            {!! Form::close() !!}
                        </div>

                        <a href="{{ route('login') }}" class="bottom-link">Login instead.</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
@stop

