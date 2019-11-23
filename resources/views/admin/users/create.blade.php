@extends('layouts.default')

@section('title', 'User Create')
@section('page-title', 'Create New User')

@section('main_content')

    <div class="row">
        <div class="col-lg-offset-2 col-lg-8">
            <div class="card bg-white px-20">
                <div class="card-block">
                    {!! Form::open(['method' => 'POST', 'url' => route('users.store'), 'class' => 'form-horizontal']) !!}

                    @include('admin.users.form')

                    <div class="form-group">
                        <div class="col-sm-2"></div>
                        <div class="col-sm-10">
                            <button type="submit" class="btn btn-success btn-icon loading-demo mr5">
                                <i class="icon-cursor mr5"></i>
                                <span>Submit</span>
                            </button>
                        </div>
                    </div>
                    {!! Form::close() !!}
                </div>
            </div>
        </div>
    </div>
@stop
