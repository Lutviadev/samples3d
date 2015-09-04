@extends('layouts.master')

@section('title') - Create Subcategory @endsection

@section('styles')

@endsection

@section('page-header')	

	@include('layouts.partials.path',['menu'=>'Subcategories', 'submenu'=>'Create Subcategory', 'icon'=>'wallpaper', 'route' => 'subcategory_index'])

@endsection

@section('content')

	{!! Form::open(['method' => 'POST', 'route' => 'subcategory_store', 'class' => 'form-horizontal', 'autocomplete' => 'off']) !!}
	
	<div class="panel panel-default">

		<div class="panel-heading">	<h3 class="panel-title">New Subcategory</h3> </div>	
	
		<div class="panel-body">
		
		    @include('render.subcategory.partials.form', ['action' => 'create'])

		    <div class="col-xs-24">
				<div class="form-group">
					<div class="btn-group pull-right">
						{!! HTML::link( route('subcategory_index'), 'Cancel', ['class' => 'btn btn-danger']) !!}
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
		@if (session()->get('session-subcategory'))
			ajaxcategories({{session()->get('session-subcategory.maincategory_id') }}, {{session()->get('session-subcategory.category_id') }}, "{{ route('getcategories') }}" );	
		@endif

		$('.maincategoryselect').change(function(event) 
		{
			ajaxcategories($(this).val(), null, "{{ route('getcategories') }}");					
		});
	</script>
@endsection

