@extends('layouts.master')

@section('title') - Edit Tour @endsection

@section('styles')

@endsection

@section('page-header')

	@include('layouts.partials.path',['menu'=>'Tours', 'submenu'=>'Edit Tour', 'icon'=>'3d_rotation', 'route' => 'tour_index'])

@endsection

@section('content')

	{!! Form::model($tour, ['method' => 'PATCH', 'route' => ['tour_update', $tour->id], 'class' => 'form-horizontal', 'autocomplete' => 'off','files' => true]) !!}

	<div class="panel panel-default">

		<div class="panel-heading">	<h3 class="panel-title">Edit Tour</h3> </div>

		<div class="panel-body">

		    @include('tour.partials.form', ['action' => 'create'])

		    <div class="col-xs-24">
				<div class="form-group">
					<div class="btn-group pull-right">
						{!! HTML::link( route('tour_index'), 'Cancel', ['class' => 'btn btn-danger']) !!}
						{!! Form::submit("Update", ['class' => 'btn btn-primary']) !!}
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
			ImageManager.addImage(['','','{{ $image->id }}','','']);
		@endforeach
	@endif

	</script>
@endsection