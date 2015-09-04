<div class="form-group">    
    {!! Form::label('name', 'Name') !!}
	<div class="input-group {{ $errors->has('name') ? 'has-error' : '' }}">
	    <span class="input-group-addon"><i class="glyphicon glyphicon-pencil"></i></span>  
	    {!! Form::text('name', null, ['class' => 'form-control', 'required' => 'required']) !!}	    
	</div>	
	{!! $errors->first('name' ,'<small class="text-danger">:message</small>') !!}
</div>