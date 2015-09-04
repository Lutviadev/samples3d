@extends('layouts.master')

@section('title') - Create Briefcase @endsection

@section('styles')

@endsection

@section('page-header')	

	@include('layouts.partials.path',['menu'=>'Briefcases', 'submenu'=>'Create Briefcase', 'icon'=>'work', 'route' => 'briefcase_index'])

@endsection

@section('content')

	{!! Form::open(['method' => 'POST', 'route' => 'briefcase_store', 'class' => 'form-horizontal', 'autocomplete' => 'off']) !!}
	
	<div class="panel panel-default">

		<div class="panel-heading">	<h3 class="panel-title">New Briefcase</h3> </div>	
	
		<div class="panel-body">
		
		    @include('briefcase.partials.form')

		    <div class="col-xs-24">
				<div class="form-group">
					<div class="btn-group pull-right">
						{!! HTML::link( route('briefcase_index'), 'Cancel', ['class' => 'btn btn-danger']) !!}
						{!! Form::submit("Create", ['class' => 'btn btn-primary']) !!}
					</div>
				</div>
			</div>	

		</div>			
	</div>

	{!! Form::close() !!}

@endsection

@section('scripts')

@endsection