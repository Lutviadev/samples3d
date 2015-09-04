@extends('layouts.master')

@section('title') - Edit Subcategories @endsection

@section('styles')

@endsection

@section('page-header')	

	@include('layouts.partials.path',['menu'=>'Subcategories', 'submenu'=>'Edit Subcategory', 'icon'=>'wallpaper', 'route' => 'subcategory_index'])

@endsection

@section('content')

	{!! Form::model($subcategory, ['method' => 'PATCH', 'route' => ['subcategory_update', $subcategory->id], 'class' => 'form-horizontal', 'autocomplete' => 'off']) !!}
	
	<div class="panel panel-default">

		<div class="panel-heading">	<h3 class="panel-title">Edit Subcategories</h3> </div>	
	
		<div class="panel-body">
		
		    @include('render.subcategory.partials.form')

		    <div class="col-xs-24">
				<div class="form-group">
					<div class="btn-group pull-right">
						{!! HTML::link( route('subcategory_index'), 'Cancel', ['class' => 'btn btn-danger']) !!}
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
		@if (session()->get('session-subcategory'))
			ajaxcategories({{session()->get('session-subcategory.maincategory_id') }}, {{session()->get('session-subcategory.category_id') }}, "{{ route('getcategories') }}" );	
		@else
			ajaxcategories({{ $subcategory->maincategory_id }}, {{ $subcategory->category_id }}, "{{ route('getcategories') }}" );	
		@endif

		$('.maincategoryselect').change(function(event) 
		{
			ajaxcategories($(this).val(), null, "{{ route('getcategories') }}");					
		});
	</script>
@endsection