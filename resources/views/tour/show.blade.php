@extends('layouts.master')

@section('title') - Tour @endsection

@section('styles')

@endsection

@section('page-header')	

	@include('layouts.partials.path',['menu'=>'Tours', 'submenu'=>'Tour', 'icon'=>'3d_rotation', 'route' => 'tour_index'])

@endsection

@section('content')

	{!! Form::model($tour, ['method' => 'GET', null, 'class' => 'form-horizontal', 'autocomplete' => 'off']) !!}
	
	<div class="panel panel-default">

		<div class="panel-heading">	<h3 class="panel-title">Tour</h3> </div>	
	
		<div class="panel-body">
		
		    @include('tour.partials.form', ['action' => 'create'])

		    <div class="col-xs-24">
				<div class="form-group">
					<div class="btn-group pull-right">
						{!! HTML::link( route('tour_index'), 'Close', ['class' => 'btn btn-danger']) !!}
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
	</script>
@endsection