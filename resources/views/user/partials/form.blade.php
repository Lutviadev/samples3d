<input type="password" name="prevent_autofill" style="display:none;" disabled="disabled" />

<div class="form-group">
	{!! Form::label('images', 'Logo') !!}

	@if (isset($animation->id))
		@include('layouts.partials.image', ['images' => $images])
	@else
		@include('layouts.partials.image')
	@endif
</div>

<div class="form-group">
    {!! Form::label('username', 'Username') !!}
	<div class="input-group {{ $errors->has('username') ? 'has-error' : '' }}">
	    <span class="input-group-addon"><i class="glyphicon glyphicon-pencil"></i></span>
	    {!! Form::text('username', null, ['class' => 'form-control', 'required' => 'required']) !!}
	</div>
	{!! $errors->first('username' ,'<small class="text-danger">:message</small>') !!}
</div>

<div class="form-group">
    {!! Form::label('email', 'Email') !!}
	<div class="input-group {{ $errors->has('email') ? 'has-error' : '' }}">
	    <span class="input-group-addon"><i class="glyphicon glyphicon-pencil"></i></span>
	    {!! Form::text('email', null, ['class' => 'form-control', 'required' => 'required']) !!}
	</div>
	{!! $errors->first('email' ,'<small class="text-danger">:message</small>') !!}
</div>

<div class="form-group">
    {!! Form::label('password', 'Password') !!}
	<div class="input-group {{ $errors->has('password') ? 'has-error' : '' }}">
	    <span class="input-group-addon"><i class="glyphicon glyphicon-pencil"></i></span>

	    @if ($action == 'edit')
			{!! Form::password('password', ['class' => 'form-control']) !!}
		@else
			{!! Form::password('password', ['class' => 'form-control', 'required' => 'required']) !!}
		@endif

	</div>
</div>

<div class="form-group">
    {!! Form::label('password_confirmation', 'Password Repeat') !!}
	<div class="input-group {{ $errors->has('password') ? 'has-error' : '' }}">
	    <span class="input-group-addon"><i class="glyphicon glyphicon-pencil"></i></span>

		@if ($action == 'edit')
			{!! Form::password('password_confirmation', ['class' => 'form-control']) !!}
		@else
			{!! Form::password('password_confirmation', ['class' => 'form-control', 'required' => 'required']) !!}
		@endif

	</div>
		{!! $errors->first('password' ,'<small class="text-danger">:message</small>') !!}
</div>

<div class="form-group">
	{!! Form::label('group', 'Group') !!}
	<div class="input-group {{ $errors->has('group') ? 'has-error' : '' }}">
		<span class="input-group-addon"><i class="glyphicon glyphicon-menu-hamburger"></i></span>

		@if ($action == 'edit')
			{!! Form::select('group', $groups, $usergroup, ['class' => 'form-control', 'required' => 'required']) !!}
		@else
			{!! Form::select('group', $groups, null, ['class' => 'form-control', 'required' => 'required']) !!}
		@endif

	</div>
	{!! $errors->first('group' ,'<small class="text-danger">:message</small>') !!}
</div>

<div class="page-subtitle">
	<i class="material-icons">person_add</i> Profile <a href="" class="profilebtn material-icons">library_add</a>
</div>

@if ($action == 'edit')
	@include('user.partials.profile-edit')
@else
	@include('user.partials.profile-create')
@endif