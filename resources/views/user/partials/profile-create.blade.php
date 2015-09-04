<div id="profile">

	<div class="form-group">
	    {!! Form::label('firstname', 'First Name') !!}
		<div class="input-group {{ $errors->has('firstname') ? 'has-error' : '' }}">
		    <span class="input-group-addon"><i class="glyphicon glyphicon-pencil"></i></span>
		    {!! Form::text('firstname', null, ['class' => 'form-control']) !!}
		</div>
			{!! $errors->first('firstname' ,'<small class="text-danger">:message</small>') !!}
	</div>

	<div class="form-group">
	    {!! Form::label('lastname', 'Last Name') !!}
		<div class="input-group {{ $errors->has('lastname') ? 'has-error' : '' }}">
		    <span class="input-group-addon"><i class="glyphicon glyphicon-pencil"></i></span>
		    {!! Form::text('lastname', null, ['class' => 'form-control']) !!}
		</div>
		{!! $errors->first('lastname' ,'<small class="text-danger">:message</small>') !!}
	</div>

	<div class="form-group">
	    {!! Form::label('phone', 'Phone') !!}
		<div class="input-group {{ $errors->has('phone') ? 'has-error' : '' }}">
		    <span class="input-group-addon"><i class="glyphicon glyphicon-pencil"></i></span>
		    {!! Form::text('phone', null, ['class' => 'form-control']) !!}
		</div>
		{!! $errors->first('phone' ,'<small class="text-danger">:message</small>') !!}
	</div>

	<div class="form-group">
	    {!! Form::label('facebook', 'Facebook') !!}
		<div class="input-group {{ $errors->has('facebook') ? 'has-error' : '' }}">
		    <span class="input-group-addon"><i class="glyphicon glyphicon-pencil"></i></span>
		    {!! Form::text('facebook', null, ['class' => 'form-control']) !!}
		</div>
			{!! $errors->first('facebook' ,'<small class="text-danger">:message</small>') !!}
	</div>

	<div class="form-group">
	    {!! Form::label('twitter', 'Twitter') !!}
		<div class="input-group {{ $errors->has('twitter') ? 'has-error' : '' }}">
		    <span class="input-group-addon"><i class="glyphicon glyphicon-pencil"></i></span>
		    {!! Form::text('twitter', null, ['class' => 'form-control']) !!}
		</div>
		{!! $errors->first('twitter' ,'<small class="text-danger">:message</small>') !!}
	</div>

	<div class="form-group">
	    {!! Form::label('linkedin', 'Linkedin') !!}
		<div class="input-group {{ $errors->has('linkedin') ? 'has-error' : '' }}">
		    <span class="input-group-addon"><i class="glyphicon glyphicon-pencil"></i></span>
		    {!! Form::text('linkedin', null, ['class' => 'form-control']) !!}
		</div>
		{!! $errors->first('linkedin' ,'<small class="text-danger">:message</small>') !!}
	</div>

	<div class="form-group">
	    {!! Form::label('web', 'Web') !!}
		<div class="input-group {{ $errors->has('web') ? 'has-error' : '' }}">
		    <span class="input-group-addon"><i class="glyphicon glyphicon-pencil"></i></span>
		    {!! Form::text('web', null, ['class' => 'form-control']) !!}
		</div>
		{!! $errors->first('web' ,'<small class="text-danger">:message</small>') !!}
	</div>

	<div class="form-group">
	    {!! Form::label('company', 'Company') !!}
		<div class="input-group {{ $errors->has('company') ? 'has-error' : '' }}">
		    <span class="input-group-addon"><i class="glyphicon glyphicon-pencil"></i></span>
		    {!! Form::text('company', null, ['class' => 'form-control']) !!}
		</div>
		{!! $errors->first('company' ,'<small class="text-danger">:message</small>') !!}
	</div>

	<div class="form-group">
	    {!! Form::label('companyaddress', 'Company Address') !!}
		<div class="input-group {{ $errors->has('companyaddress') ? 'has-error' : '' }}">
		    <span class="input-group-addon"><i class="glyphicon glyphicon-pencil"></i></span>
		    {!! Form::text('companyaddress', null, ['class' => 'form-control']) !!}
		</div>
		{!! $errors->first('companyaddress' ,'<small class="text-danger">:message</small>') !!}
	</div>

	<div class="form-group">
	    {!! Form::label('companymail', 'Company Email') !!}
		<div class="input-group {{ $errors->has('companymail') ? 'has-error' : '' }}">
		    <span class="input-group-addon"><i class="glyphicon glyphicon-pencil"></i></span>
		    {!! Form::text('companymail', null, ['class' => 'form-control']) !!}
		</div>
		{!! $errors->first('companymail' ,'<small class="text-danger">:message</small>') !!}
	</div>

	<div class="form-group">
	    {!! Form::label('companyphone', 'Company Phone') !!}
		<div class="input-group {{ $errors->has('companyphone') ? 'has-error' : '' }}">
		    <span class="input-group-addon"><i class="glyphicon glyphicon-pencil"></i></span>
		    {!! Form::text('companyphone', null, ['class' => 'form-control']) !!}
		</div>
		{!! $errors->first('companyphone' ,'<small class="text-danger">:message</small>') !!}
	</div>

</div>