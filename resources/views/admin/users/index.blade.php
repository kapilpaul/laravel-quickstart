@extends('layouts.default')

@section('title', 'Users List')
@section('page-title', 'Users')

@push('header_top_css')
    <link rel="stylesheet" href="{{ asset('assets/vendor/sweetalert/dist/sweetalert.css') }}">
@endpush

@section('main_content')
    <a href="{{ route('users.create') }}" class="btn btn-success btn-icon loading-demo mb-15">
        <i class="fa fa-plus mr5"></i>
        <span>Create</span>
    </a>

    <div class="row">
        <div class="col-lg-12">
            <div class="card bg-white m-b">
                <div class="card-block p-a-0">
                    <div class="table-responsive">
                        <table class="table table-striped m-b-0">
                            <thead>
                            <tr>
                                <th class="">#</th>
                                <th class="col-md-4">
                                    <span></span>Name
                                </th>
                                <th class="col-md-2">Email</th>
                                <th class="col-md-2">Role</th>
                                <th class="col-md-2">Status</th>
                                <th class="col-md-2">Action</th>
                            </tr>
                            </thead>
                            <tbody>
                            @if($users)
                                @foreach($users as $user)
                                    <tr>
                                        <td>
                                            <span></span>{{ $loop->iteration }}</td>
                                        <td>{{ $user->first_name }} {{ $user->last_name }}</td>
                                        <td>{{ $user->email }}</td>
                                        <td class="align-middle">
                                            {{ $user->roles[0]->name }}
                                        </td>
                                        <td class="align-middle">
                                            @if($user->status == 1)
                                                {!! Form::open(['method' => 'GET', "id" =>"activeform" .$user->id, "class" => "activeform", 'style' => 'display:inline-block;', 'url' => route('users.inactive', $user->id)]) !!}
                                                <button type="submit" class="no-border no-bg">
                                                    <span class="label label-success">Active</span>
                                                </button>
                                                {!! Form::close() !!}
                                            @else
                                                {!! Form::open(['method' => 'GET', "id" =>"activeform" .$user->id, "class" => "inactiveactiveform", 'style' => 'display:inline-block;', 'url' => route('users.active', $user->id)]) !!}
                                                <button type="submit" class="no-border no-bg">
                                                    <span class="label label-danger">Inactive</span>
                                                </button>
                                                {!! Form::close() !!}
                                            @endif
                                        </td>

                                        <td>
                                            <a href="{{ route('users.edit', $user->id) }}"
                                               class="btn btn-success btn-icon-icon btn-sm mr5">
                                                <i class="fa fa-pencil"></i>
                                            </a>

                                        {!! Form::open(['method' => 'DELETE', "id" =>"deleteform" .$user->id, "class" => "deleteform", 'style' => 'display:inline-block;', 'url' => route('users.destroy', $user->id)]) !!}

                                            <button type="submit" class="btn btn-danger btn-icon-icon btn-sm mr5">
                                                <i class="fa fa-trash-o"></i>
                                            </button>

                                        {!! Form::close() !!}
                                        </td>
                                    </tr>
                                @endforeach
                            @endif
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
@stop

@push('footer_js')
    <script src="{{ asset('assets/vendor/sweetalert/dist/sweetalert.min.js') }}"></script>

    <script>
        /**
         * Sweetalerts demo page
         */
        (function ($) {
            $('.deleteform').on('click', function (e) {
                e.preventDefault();
                let elem = e;
                swal({
                    title: 'Are you sure?',
                    text: 'You will not be able to recover this!',
                    type: 'warning',
                    showCancelButton: true,
                    confirmButtonColor: '#6FC080',
                    confirmButtonText: 'Yes, delete it!',
                    cancelButtonText: 'No, cancel!',
                    closeOnConfirm: false,
                    closeOnCancel: false
                }, function (isConfirm) {
                    if (isConfirm) {
                        $("#" + elem.currentTarget.id).submit();
                        swal('Deleted!', 'Your data has been deleted!', 'success');
                    } else {
                        swal('Cancelled', 'Your data is safe :)', 'error');
                    }
                });
            });

            $('.activeform').on('click', function (e) {
                e.preventDefault();
                let elem = e;
                swal({
                    title: 'Are you sure?',
                    text: 'You can change it anytime!',
                    type: 'warning',
                    showCancelButton: true,
                    confirmButtonColor: '#6FC080',
                    confirmButtonText: 'Yes, inactive it!',
                    cancelButtonText: 'No, cancel!',
                    closeOnConfirm: false,
                    closeOnCancel: false
                }, function (isConfirm) {
                    if (isConfirm) {
                        $("#" + elem.currentTarget.id).submit();
                        swal('Inactivated!', 'User has been inactive!', 'success');
                    } else {
                        swal('Cancelled', 'User is safe :)', 'error');
                    }
                });
            });

            $('.inactiveactiveform').on('click', function (e) {
                e.preventDefault();
                let elem = e;
                swal({
                    title: 'Are you sure?',
                    text: 'You can change it anytime!',
                    type: 'warning',
                    showCancelButton: true,
                    confirmButtonColor: '#6FC080',
                    confirmButtonText: 'Yes, activate it!',
                    cancelButtonText: 'No, cancel!',
                    closeOnConfirm: false,
                    closeOnCancel: false
                }, function (isConfirm) {
                    if (isConfirm) {
                        $("#" + elem.currentTarget.id).submit();
                        swal('Activated!', 'User has been activated!', 'success');
                    } else {
                        swal('Cancelled', 'User is safe :)', 'error');
                    }
                });
            });
        })(jQuery);
    </script>
@endpush
