@extends('layouts.default')

@section('title', 'Change Password')
@section('page-title', 'Change Password')

@section('main_content')
    <div class="row">
        <div class="col-lg-offset-3 col-lg-6">
            <div class="page-height row-equal align-middle">
                <div class="column">
                    <div class="card bg-white no-border">
                        <div class="card-block">
                            {!! Form::open([
                                'method' => 'POST',
                                'url' => route('user.changePassword'),
                                'id' => 'form-reminder', 'class' => "form-layout"
                            ]) !!}

                            <div class="form-inputs">
                                {!! Form::label('old_password', 'Old Password', ['class' => 'text-uppercase']) !!}
                                {!! Form::password('old_password', ['id' => "old_password", 'class'=>'form-control input-lg', 'placeholder' => '******']) !!}

                                @include('common.form.validation', ['key' => 'old_password'])
                            </div>

                            <div class="form-inputs">
                                {!! Form::label('new_password', 'New Password', ['class' => 'text-uppercase']) !!}
                                {!! Form::password('new_password', ['id' => "new_password", 'class'=>'form-control input-lg', 'placeholder' => '******']) !!}

                                @include('common.form.validation', ['key' => 'new_password'])
                            </div>
                            <button class="btn btn-primary btn-lg btn-block" type="submit">Change Password</button>
                            {!! Form::close() !!}
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@stop
