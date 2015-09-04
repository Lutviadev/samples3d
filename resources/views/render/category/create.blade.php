@extends('layouts.master')

@section('title') - Create Category @endsection

@section('styles')

@endsection

@section('page-header')	

	@include('layouts.partials.path',['menu'=>'Category', 'submenu'=>'Create Category', 'icon'=>'wallpaper', 'route' => 'category_index'])

@endsection

@section('content')

	{!! Form::open(['method' => 'POST', 'route' => 'category_store', 'class' => 'form-horizontal', 'autocomplete' => 'off']) !!}
	
	<div class="panel panel-default">

		<div class="panel-heading">	<h3 class="panel-title">New Category</h3> </div>	
	
		<div class="panel-body">
		
		    @include('render.category.partials.form')

		    <div class="col-xs-24">
				<div class="form-group">
					<div class="btn-group pull-right">
						{!! HTML::link( route('category_index'), 'Cancel', ['class' => 'btn btn-danger']) !!}
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