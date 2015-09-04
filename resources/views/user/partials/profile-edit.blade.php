<div id="profile">

	<div class="form-group">
	    {!! Form::label('firstname', 'First Name') !!}
		<div class="input-group {{ $errors->has('firstname') ? 'has-error' : '' }}">
		    <span class="input-group-addon"><i class="glyphicon glyphicon-pencil"></i></span>
		    {!! Form::text('firstname', $user->profile->firstname, ['class' => 'form-control']) !!}
		</div>
		{!! $errors->first('firstname' ,'<small class="text-danger">:message</small>') !!}
	</div>

	<div class="form-group">
	    {!! Form::label('lastname', 'Last Name') !!}
		<div class="input-group {{ $errors->has('lastname') ? 'has-error' : '' }}">
		    <span class="input-group-addon"><i class="glyphicon glyphicon-pencil"></i></span>
		    {!! Form::text('lastname', $user->profile->lastname, ['class' => 'form-control']) !!}
		</div>
		{!! $errors->first('lastname' ,'<small class="text-danger">:message</small>') !!}
	</div>

	<div class="form-group">
	    {!! Form::label('phone', 'Phone') !!}
		<div class="input-group {{ $errors->has('phone') ? 'has-error' : '' }}">
		    <span class="input-group-addon"><i class="glyphicon glyphicon-pencil"></i></span>
		    {!! Form::text('phone', $user->profile->phone, ['class' => 'form-control']) !!}
		</div>
		{!! $errors->first('phone' ,'<small class="text-danger">:message</small>') !!}
	</div>

	<div class="form-group">
	    {!! Form::label('facebook', 'Facebook') !!}
		<div class="input-group {{ $errors->has('facebook') ? 'has-error' : '' }}">
		    <span class="input-group-addon"><i class="glyphicon glyphicon-pencil"></i></span>
		    {!! Form::text('facebook', $user->profile->facebook, ['class' => 'form-control']) !!}
		</div>
		{!! $errors->first('facebook' ,'<small class="text-danger">:message</small>') !!}
	</div>

	<div class="form-group">
	    {!! Form::label('twitter', 'Twitter') !!}
		<div class="input-group {{ $errors->has('twitter') ? 'has-error' : '' }}">
		    <span class="input-group-addon"><i class="glyphicon glyphicon-pencil"></i></span>
		    {!! Form::text('twitter', $user->profile->twitter, ['class' => 'form-control']) !!}
		</div>
			{!! $errors->first('twitter' ,'<small class="text-danger">:message</small>') !!}
	</div>

	<div class="form-group">
	    {!! Form::label('linkedin', 'Linkedin') !!}
		<div class="input-group {{ $errors->has('linkedin') ? 'has-error' : '' }}">
		    <span class="input-group-addon"><i class="glyphicon glyphicon-pencil"></i></span>
		    {!! Form::text('linkedin', $user->profile->linkedin, ['class' => 'form-control']) !!}
		</div>
			{!! $errors->first('linkedin' ,'<small class="text-danger">:message</small>') !!}
	</div>

	<div class="form-group">
	    {!! Form::label('web', 'Web') !!}
		<div class="input-group {{ $errors->has('web') ? 'has-error' : '' }}">
		    <span class="input-group-addon"><i class="glyphicon glyphicon-pencil"></i></span>
		    {!! Form::text('web', $user->profile->web, ['class' => 'form-control']) !!}
		</div>
		{!! $errors->first('web' ,'<small class="text-danger">:message</small>') !!}
	</div>

	<div class="form-group">
	    {!! Form::label('company', 'Company') !!}
		<div class="input-group {{ $errors->has('company') ? 'has-error' : '' }}">
		    <span class="input-group-addon"><i class="glyphicon glyphicon-pencil"></i></span>
		    {!! Form::text('company', $user->profile->company, ['class' => 'form-control']) !!}
		</div>
		{!! $errors->first('company' ,'<small class="text-danger">:message</small>') !!}
	</div>

	<div class="form-group">
	    {!! Form::label('companyaddress', 'Company Address') !!}
		<div class="input-group {{ $errors->has('companyaddress') ? 'has-error' : '' }}">
		    <span class="input-group-addon"><i class="glyphicon glyphicon-pencil"></i></span>
		    {!! Form::text('companyaddress', $user->profile->companyaddress, ['class' => 'form-control']) !!}
		</div>
		{!! $errors->first('companyaddress' ,'<small class="text-danger">:message</small>') !!}
	</div>

	<div class="form-group">
	    {!! Form::label('companymail', 'Company Email') !!}
		<div class="input-group {{ $errors->has('companymail') ? 'has-error' : '' }}">
		    <span class="input-group-addon"><i class="glyphicon glyphicon-pencil"></i></span>
		    {!! Form::text('companymail', $user->profile->companymail, ['class' => 'form-control']) !!}
		</div>
		{!! $errors->first('companymail' ,'<small class="text-danger">:message</small>') !!}
	</div>

	<div class="form-group">
	    {!! Form::label('companyphone', 'Company Phone') !!}
		<div class="input-group {{ $errors->has('companyphone') ? 'has-error' : '' }}">
		    <span class="input-group-addon"><i class="glyphicon glyphicon-pencil"></i></span>
		    {!! Form::text('companyphone', $user->profile->companyphone, ['class' => 'form-control']) !!}
		</div>
		{!! $errors->first('companyphone' ,'<small class="text-danger">:message</small>') !!}
	</div>

</div>