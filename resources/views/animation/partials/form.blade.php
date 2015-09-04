@if (Auth::user()->level() >= 999 || Auth::user()->can('create.animation') || Auth::user()->can('total.animation') )

	<div class="brifcasesmulti form-group">
	    {!! Form::label('briefcases', 'Briefcases') !!}

	    @if (isset($animation->id))
	    	{!! Form::text('multiselect', getMultifix($briefcases), ['class' => 'multi-empty', 'required' => 'required'])!!}
		@else
			{!! Form::text('multiselect', null, ['class' => 'multi-empty', 'required' => 'required'])!!}
		@endif

	    <br> <span class="multi-sublabel">Selected</span>
		<div class="input-group {{ $errors->has('briefcases') ? 'has-error' : '' }}">
		    <span class="input-group-addon"><i class="glyphicon glyphicon-indent-left"></i></span>

	    	@if (isset($animation->id))
	    		{!! Form::select('briefcases[]',$allbriefcases, $briefcases, ['class' => 'resource_multiselect form-control', 'multiple']) !!}					    
			@else
	    		{!! Form::select('briefcases[]',$allbriefcases, null, ['class' => 'resource_multiselect form-control', 'multiple']) !!}					    
			@endif

		</div>
		{!! $errors->first('briefcases' ,'<small class="text-danger">:message</small>') !!}
	</div>

@endif

<div class="form-group">
	{!! Form::label('images', 'Cover Image') !!}

	@if (isset($animation->id))
		@include('layouts.partials.image', ['images' => $images])
	@else
		@include('layouts.partials.image')
	@endif
</div>

<div class="form-group">
    {!! Form::label('title', 'Title') !!}
	<div class="input-group {{ $errors->has('title') ? 'has-error' : '' }}">
	    <span class="input-group-addon"><i class="glyphicon glyphicon-pencil"></i></span>
	    {!! Form::text('title', null, ['class' => 'form-control', 'required' => 'required']) !!}
	</div>
	{!! $errors->first('title' ,'<small class="text-danger">:message</small>') !!}
</div>

<div class="form-group">
    {!! Form::label('vimeo', 'Vimeo') !!}
	<div class="input-group {{ $errors->has('vimeo') ? 'has-error' : '' }}">
		<span class="input-group-addon"><i class="glyphicon glyphicon-pencil"></i></span>
	    {!! Form::text('vimeo', null, ['class' => 'form-control','required' => 'required']) !!}

	    @if (isset($animation->id))
	    	<span class="input-group-addon openvimeo" data-vimeo="{{ $animation->id }}" data-toggle="modal" data-target="#vimeoModal"><i class="glyphicon glyphicon-play"></i> play</span>
		@endif

	</div>
	{!! $errors->first('vimeo' ,'<small class="text-danger">:message</small>') !!}
</div>

<div class="form-group">
    {!! Form::label('tags', 'Tags') !!}
	<div class="input-group {{ $errors->has('tags') ? 'has-error' : '' }}">
		<span class="input-group-addon"><i class="material-icons tags">local_offer</i></span>

		@if (isset($animation->id))
	    	{!! Form::text('tags', $tags, ['class' => 'tagme form-control']) !!}
	    @else
	    	{!! Form::text('tags', null, ['class' => 'tagme form-control']) !!}
		@endif

	</div>
	{!! $errors->first('tags' ,'<small class="text-danger">:message</small>') !!}
	<span class="note"><i class="glyphicon glyphicon-info-sign"></i> Press [ENTER] after each tag</span>
</div>