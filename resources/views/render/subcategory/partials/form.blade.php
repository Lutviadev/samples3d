<div class="form-group">
	{!! Form::label('maincategory_id', 'Main Category') !!}
	<div class="input-group {{ $errors->has('maincategory_id') ? 'has-error' : '' }}">
		<span class="input-group-addon"><i class="glyphicon glyphicon-menu-hamburger"></i></span>
					
		{!! Form::select('maincategory_id', $maincategories, null, ['class' => 'maincategoryselect form-control', 'required' => 'required']) !!}

	</div>
	{!! $errors->first('maincategory_id' ,'<small class="text-danger">:message</small>') !!}
</div>

<div class="form-group">
	{!! Form::label('category_id', 'Category') !!}
	<div class="input-group {{ $errors->has('category_id') ? 'has-error' : '' }}">
		<span class="input-group-addon"><i class="glyphicon glyphicon-menu-hamburger"></i></span>
		
		{!! Form::select('category_id', $categories, null, ['class' => 'categoryselect form-control', 'required' => 'required']) !!}

	</div>
	{!! $errors->first('category_id' ,'<small class="text-danger">:message</small>') !!}
</div>

<div class="form-group">    
    {!! Form::label('name', 'Name') !!}
	<div class="input-group {{ $errors->has('name') ? 'has-error' : '' }}">
	    <span class="input-group-addon"><i class="glyphicon glyphicon-pencil"></i></span>  
	    {!! Form::text('name', null, ['class' => 'form-control', 'required' => 'required']) !!}	    
	</div>	
	{!! $errors->first('name' ,'<small class="text-danger">:message</small>') !!}
</div>