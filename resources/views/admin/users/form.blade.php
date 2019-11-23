<div class="form-group">
    {!! Form::label('first_name', 'First Name', ['class' => 'col-sm-2 control-label']) !!}
    <div class="col-sm-10">
        {!! Form::text('first_name', null, ["class" =>"form-control", "placeholder" => "First Name"]) !!}
        @include('common.form.validation', ['key' => 'first_name'])
    </div>
</div>

<div class="form-group">
    {!! Form::label('last_name', 'Last Name', ['class' => 'col-sm-2 control-label']) !!}
    <div class="col-sm-10">
        {!! Form::text('last_name', null, ["class" =>"form-control", "placeholder" => "Last Name"]) !!}
        @include('common.form.validation', ['key' => 'last_name'])
    </div>
</div>

<div class="form-group">
    {!! Form::label('email', 'Email', ['class' => 'col-sm-2 control-label']) !!}
    <div class="col-sm-10">
        {!! Form::email('email', null, ["class" =>"form-control", "placeholder" => "example@example.com"]) !!}
        @include('common.form.validation', ['key' => 'email'])
    </div>
</div>

<div class="form-group">
    {!! Form::label('password', 'Password', ['class' => 'col-sm-2 control-label']) !!}
    <div class="col-sm-10">
        {!! Form::password('password', ["class" =>"form-control", "placeholder" => "******"]) !!}
        @include('common.form.validation', ['key' => 'password'])
    </div>
</div>

<div class="form-group">
    {!! Form::label('roles_id', 'Role', ['class' => 'col-sm-2 control-label']) !!}
    <div class="col-sm-10">
        @if(isset($user_role))
        {!! Form::select('roles_id', $roles, $user_role, ["class" =>"form-control", "placeholder" => "Select a Role", "style" => 'width:100%']) !!}
        @else
        {!! Form::select('roles_id', $roles, null, ["class" =>"form-control", "placeholder" => "Select a Role", "style" => 'width:100%']) !!}
        @endif
        @include('common.form.validation', ['key' => 'roles_id'])
    </div>
</div>
