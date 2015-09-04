<div class="form-group">    
    {!! Form::label('name', 'Name') !!}
	<div class="input-group {{ $errors->has('name') ? 'has-error' : '' }}">
	    <span class="input-group-addon"><i class="glyphicon glyphicon-pencil"></i></span>  
	    {!! Form::text('name', null, ['class' => 'form-control', 'required' => 'required']) !!}	    
	</div>	
	{!! $errors->first('name' ,'<small class="text-danger">:message</small>') !!}
</div>

<div class="form-group"> 
    {!! Form::label('description', 'Description') !!}
	<div class="input-group {{ $errors->has('description') ? 'has-error' : '' }}">
		<span class="input-group-addon"><i class="glyphicon glyphicon-pencil"></i></span> 
	    {!! Form::text('description', null, ['class' => 'form-control']) !!}	    	   	    
	</div>
	{!! $errors->first('description' ,'<small class="text-danger">:message</small>') !!}
</div>

<div class="form-group"> 
	<h3><b>Available briefcases</b></h3>
</div>

<div class="input-group {{ $errors->has('briefcases') ? 'has-error' : '' }} {{ $errors->has('permissions') ? 'has-error' : '' }}">
	<span class="input-group-addon"><i class="glyphicon glyphicon-menu-hamburger"></i></span>  
	
	@if (isset($group->name))
		
		{!! Form::select('selectCollection', [null=>'Please Select ...'] + $briefcases, null, ['class' => 'form-control', 'id' => 'selectCollection']) !!}				

	@else
		
		{!! Form::select('selectCollection', [null=>'Please Select ...'] + $briefcases, null, ['class' => 'form-control', 'required' => 'required', 'id' => 'selectCollection']) !!}				
	
	@endif	
	
	<span class="input-group-btn">
	{!! Form::button("Add to group", ['class' => 'btn btn-primary', 'id' => 'addToCollection']) !!}
	</span>			
</div>

@if (!$errors->first('briefcases')) 
	{!! $errors->first('permissions','<div><small class="text-danger">:message</small></div>') !!} 
@else
	{!! $errors->first('briefcases', '<div><small class="text-danger">:message</small></div>') !!} 
@endif

<div class="form-group">
	<div class="col-xs-24 briefcaseCollector collector" style="margin-top:15px;"></div>	
</div>