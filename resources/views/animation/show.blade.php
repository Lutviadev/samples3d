@extends('layouts.master')

@section('title') - Animation @endsection

@section('styles')

@endsection

@section('page-header')

	@include('layouts.partials.path',['menu'=>'Animations', 'submenu'=>'Animation', 'icon'=>'videocam', 'route' => 'animation_index'])

@endsection

@section('content')

	@include('layouts.partials.vimeo')

	{!! Form::model($animation, ['method' => 'GET', null , 'class' => 'form-horizontal', 'autocomplete' => 'off']) !!}

	<div class="panel panel-default">

		<div class="panel-heading">	<h3 class="panel-title">Animation</h3> </div>

		<div class="panel-body">

		    @include('animation.partials.form', ['action' => 'edit'])

		    <div class="col-xs-24">
				<div class="form-group">
					<div class="btn-group pull-right">
						{!! HTML::link( route('animation_index'), 'Close', ['class' => 'btn btn-danger']) !!}
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

	var ImageManager = $(document).ImageManager({mode:'single',thumbroute:"{{ route('thumbroute') }}"});

	@if (isset($images))
		@foreach ($images as $image)
			ImageManager.addImage(['{{ $image->title }}','{{ $image->description }}','{{ $image->id }}','{{ resourseTags($image) }}','']);
		@endforeach
	@endif

	vimeo('{{ $animation->vimeo }}');
	</script>
@endsection