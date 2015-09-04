@extends('layouts.master')

@section('title') - Create Main Category @endsection

@section('styles')

@endsection

@section('page-header')	

	@include('layouts.partials.path',['menu'=>'Main Category', 'submenu'=>'Create Main Category', 'icon'=>'wallpaper', 'route' => 'maincategory_index'])

@endsection

@section('content')

	{!! Form::open(['method' => 'POST', 'route' => 'maincategory_store', 'class' => 'form-horizontal', 'autocomplete' => 'off']) !!}
	
	<div class="panel panel-default">

		<div class="panel-heading">	<h3 class="panel-title">New Main Category</h3> </div>	
	
		<div class="panel-body">
		
		    @include('render.maincategory.partials.form')

		    <div class="col-xs-24">
				<div class="form-group">
					<div class="btn-group pull-right">
						{!! HTML::link( route('maincategory_index'), 'Cancel', ['class' => 'btn btn-danger']) !!}
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