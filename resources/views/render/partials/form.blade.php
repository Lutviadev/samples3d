@if (Auth::user()->level() >= 999 || Auth::user()->can('create.render') || Auth::user()->can('total.render') )

	<div class="brifcasesmulti form-group">    
	    {!! Form::label('briefcases', 'Briefcases') !!}
	
	    @if (isset($render->id))
	    	{!! Form::text('multiselect', getMultifix($briefcases), ['class' => 'multi-empty', 'required' => 'required'])!!}
		@else
			{!! Form::text('multiselect', null, ['class' => 'multi-empty', 'required' => 'required'])!!}
		@endif

		<br> <span class="multi-sublabel">Selected</span>
		<div class="input-group {{ $errors->has('briefcases') ? 'has-error' : '' }}">
		    <span class="input-group-addon"><i class="glyphicon glyphicon-indent-left"></i></span>  
	    	
	    	@if (isset($render->id))
	    		{!! Form::select('briefcases[]',$allbriefcases, $briefcases, ['class' => 'resource_multiselect form-control', 'multiple']) !!}					    
			@else
	    		{!! Form::select('briefcases[]',$allbriefcases, null, ['class' => 'resource_multiselect form-control', 'multiple']) !!}					    
			@endif

		</div>	
		{!! $errors->first('briefcases' ,'<small class="text-danger">:message</small>') !!}
	</div>

@endif

<div class="form-group">
    {!! Form::label('enviroment', 'Enviroment') !!}	
    <div class="input-group">
		<div class="btn-group" data-toggle="buttons">
			@if (isset($render->enviroment) && $render->enviroment == 'exterior')
				<label class="btn btn-info">
				    {!! Form::radio('enviroment', 'interior',  null, null) !!} Interior		    
				</label>
				<label class="btn btn-info active">
					{!! Form::radio('enviroment', 'exterior',  null, ['checked']) !!} Exterior
				</label>
			@else				
				<label class="btn btn-info active">
				    {!! Form::radio('enviroment', 'interior',  null, ['checked']) !!} Interior		    
				</label>
				<label class="btn btn-info">
					{!! Form::radio('enviroment', 'exterior',  null, null) !!} Exterior
				</label>
			@endif			
		</div>
	</div>
</div>

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
	{!! Form::label('subcategory_id', 'Subcategory') !!}
	<div class="input-group {{ $errors->has('subcategory_id') ? 'has-error' : '' }}">
		<span class="input-group-addon"><i class="glyphicon glyphicon-menu-hamburger"></i></span>
		
		{!! Form::select('subcategory_id', $subcategories, null, ['class' => 'subcategoryselect form-control', 'required' => 'required']) !!}

	</div>
	{!! $errors->first('subcategory_id' ,'<small class="text-danger">:message</small>') !!}
</div>

<div class="form-group">
    {!! Form::label('name', 'Name') !!}
	<div class="input-group {{ $errors->has('name') ? 'has-error' : '' }}">
	    <span class="input-group-addon"><i class="glyphicon glyphicon-pencil"></i></span>

	    {!! Form::text('name', null, ['class' => 'form-control', 'required' => 'required']) !!}

	</div>	
	{!! $errors->first('name' ,'<small class="text-danger">:message</small>') !!}
</div>

<div class="form-group"> 
	{!! Form::label('images', 'Images') !!}

	@if (isset($render->id))
		@include('layouts.partials.gallery', ['images' => $images])
	@else
		@include('layouts.partials.gallery')
	@endif
</div>