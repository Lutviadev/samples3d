@if (Auth::user()->level() >= 999 || Auth::user()->can('create.tour') || Auth::user()->can('total.tour') )

	<div class="brifcasesmulti form-group">
	    {!! Form::label('briefcases', 'Briefcases') !!}

	    @if (isset($tour->id))
	    	{!! Form::text('multiselect', getMultifix($briefcases), ['class' => 'multi-empty', 'required' => 'required'])!!}
		@else
			{!! Form::text('multiselect', null, ['class' => 'multi-empty', 'required' => 'required'])!!}
		@endif

	    <br> <span class="multi-sublabel">Selected</span>
		<div class="input-group {{ $errors->has('briefcases') ? 'has-error' : '' }}">
		    <span class="input-group-addon"><i class="glyphicon glyphicon-indent-left"></i></span>

	    	@if (isset($tour->id))
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
    {!! Form::label('foldername', 'Foldername') !!}
	<div class="input-group {{ $errors->has('foldername') ? 'has-error' : '' }}">
	    <span class="input-group-addon"><i class="glyphicon glyphicon-pencil"></i></span>
	    {!! Form::select('foldername', withEmpty($foldersnames), null, ['class' => 'form-control', 'required' => 'required']) !!}

	    @if (isset($tour->id))
	    	<a href="{{ route('portfolio_tour',['id' => $tour->id]) }}" class="input-group-addon opentour" target="_blank">preview</a>
		@endif
	</div>
	{!! $errors->first('foldername' ,'<small class="text-danger">:message</small>') !!}
</div>

<div class="form-group">
    {!! Form::label('tags', 'Tags') !!}
	<div class="input-group {{ $errors->has('tags') ? 'has-error' : '' }}">
		<span class="input-group-addon"><i class="material-icons tags">local_offer</i></span>

		@if (isset($tour->id))
	    	{!! Form::text('tags', $tags, ['class' => 'tagme form-control']) !!}
	    @else
	    	{!! Form::text('tags', null, ['class' => 'tagme form-control']) !!}
		@endif

	</div>
	{!! $errors->first('tags' ,'<small class="text-danger">:message</small>') !!}
	<span class="note"><i class="glyphicon glyphicon-info-sign"></i> Press [ENTER] after each tag</span>
</div>