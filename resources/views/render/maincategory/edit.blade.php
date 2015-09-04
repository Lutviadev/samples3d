@extends('layouts.master')

@section('title') - Edit Main Category @endsection

@section('styles')

@endsection

@section('page-header')	

	@include('layouts.partials.path',['menu'=>'Main Category', 'submenu'=>'Edit Main Category', 'icon'=>'wallpaper', 'route' => 'maincategory_index'])

@endsection

@section('content')

	{!! Form::model($maincategory, ['method' => 'PATCH', 'route' => ['maincategory_update', $maincategory->id], 'class' => 'form-horizontal', 'autocomplete' => 'off']) !!}
	
	<div class="panel panel-default">

		<div class="panel-heading">	<h3 class="panel-title">Edit Main Category</h3> </div>	
	
		<div class="panel-body">
		
		    @include('render.maincategory.partials.form')

		    <div class="col-xs-24">
				<div class="form-group">
					<div class="btn-group pull-right">
						{!! HTML::link( route('maincategory_index'), 'Cancel', ['class' => 'btn btn-danger']) !!}
						{!! Form::submit("Update", ['class' => 'btn btn-primary']) !!}
					</div>
				</div>
			</div>	

		</div>			
	</div>

	{!! Form::close() !!}

@endsection

@section('scripts')

@endsection