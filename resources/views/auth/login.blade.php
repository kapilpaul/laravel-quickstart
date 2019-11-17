@extends('layouts.blank')

@section('main_content')
    <div class="app signin v2 usersession">
        <div class="session-wrapper">
            <div class="session-carousel slide" data-ride="carousel" data-interval="3000">
                <!-- Wrapper for slides -->
                <div class="carousel-inner" role="listbox">
                    <div class="item active"
                         style="background-image:url({{ asset('assets/images/webable.jpg') }});background-size:cover;background-repeat: no-repeat;background-position: 50% 50%;">
                    </div>
                    {{--<div class="item"--}}
                         {{--style="background-image:url({{ asset('assets/images/webable.jpg') }});background-size:cover;background-repeat: no-repeat;background-position: 50% 50%;">--}}
                    {{--</div>--}}
                </div>
            </div>

            <div class="card bg-white no-border">
                <div class="card-block">
                    <!-- Login Form -->
                    {!! Form::open([
                        'method' => 'POST',
                        'url' => route('postLogin'),
                        'id' => 'form-login', 'class' => "form-layout"
                    ]) !!}

                    <div class="text-center m-b">
                        <h4 class="text-uppercase">WebAble</h4>
                        <p>Please sign in to your account</p>
                    </div>

                    <div class="form-inputs p-b">
                        {!! Form::label('login-email', 'Your email address', ['class' => 'text-uppercase']) !!}
                        {!! Form::email('email', null, ['id' => 'login-email', 'class'=>'form-control input-lg', 'placeholder' =>
                                'example@example.com']) !!}

                        @include('common.form.validation', ['key' => 'email'])

                        {!! Form::label('login-password', 'Password', ['class' => 'text-uppercase']) !!}
                        {!! Form::password('password', ['id' => 'login-password', 'class'=>'form-control input-lg', 'placeholder' => 'Password']) !!}

                        @include('common.form.validation', ['key' => 'password'])

                        <button type="submit" class="btn btn-primary btn-block btn-lg m-b">Login</button>
                    </div>
                {!! Form::close() !!}
                <!-- END Login Form -->
                </div>
            </div>
            <div class="push"></div>
        </div>
    </div>
@stop

