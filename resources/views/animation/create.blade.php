@extends('layouts.master')

@section('title') - Create Animation @endsection

@section('styles')

@endsection

@section('page-header')

	@include('layouts.partials.path',['menu'=>'Animations', 'submenu'=>'Create Animation', 'icon'=>'videocam', 'route' => 'animation_index'])

@endsection

@section('content')

	@include('layouts.partials.vimeo')

	{!! Form::open(['method' => 'POST', 'route' => 'animation_store', 'class' => 'form-horizontal', 'autocomplete' => 'off', 'files' => true]) !!}

	<div class="panel panel-default">

		<div class="panel-heading">	<h3 class="panel-title">New Animation</h3> </div>

		<div class="panel-body">

		    @include('animation.partials.form', ['action' => 'create'])

		    <div class="col-xs-24">
				<div class="form-group">
					<div class="btn-group pull-right">
						{!! HTML::link( route('animation_index'), 'Cancel', ['class' => 'btn btn-danger']) !!}
						{!! Form::submit("Create", ['class' => 'btn btn-primary']) !!}
					</div>
				</div>
			</div>

		</div>
	</div>

	{!! Form::close() !!}

@endsection

@section('scripts')
	<script>
	$('.tagme').tagsinput(
	{
		trimValue: true,
		freeInput: true,
		typeahead:
		{
			source: {!! $alltags !!},
			displayText: function(item){ return item; }
		}
	});

	var ImageManager = $(document).ImageManager({mode:'single'});
	</script>
@endsection