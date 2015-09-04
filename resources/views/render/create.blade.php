@extends('layouts.master')

@section('title') - Create Gallery @endsection

@section('styles')

@endsection

@section('page-header')	

	@include('layouts.partials.path',['menu'=>'Renders Galleries', 'submenu'=>'Create Gallery', 'icon'=>'wallpaper', 'route' => 'render_index'])

@endsection

@section('content')

	{!! Form::open(['method' => 'POST', 'route' => 'render_store', 'class' => 'form-horizontal', 'autocomplete' => 'off', 'files' => true]) !!}
	
	<div class="panel panel-default">

		<div class="panel-heading">	<h3 class="panel-title">New Gallery</h3> </div>	
	
		<div class="panel-body">
		
		    @include('render.partials.form', ['action' => 'create'])

		    <div class="col-xs-24">
				<div class="form-group">
					<div class="btn-group pull-right">
						{!! HTML::link( route('render_index'), 'Cancel', ['class' => 'btn btn-danger']) !!}
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
			ajaxcategories({{session()->get('session-subcategory.maincategory_id') }}, {{session()->get('session-subcategory.category_id') }}, "{{ route('getsubcategories') }}" );		
			ajaxsubcategories({{session()->get('session-subcategory.maincategory_id') }}, {{session()->get('session-subcategory.category_id') }}, {{session()->get('session-subcategory.subcategory_id') }}, "{{ route('getsubcategories') }}" );		
		@endif

		$('.maincategoryselect').change(function(event) 
		{
			ajaxcategories($(this).val(), null, "{{ route('getcategories') }}");					
		});

		$('.categoryselect').change(function(event) 
		{
			ajaxsubcategories($('.maincategoryselect').val(), $(this).val(), null, "{{ route('getsubcategories') }}");					
		});

		var ImageManager = $(document).ImageManager({ alltags: {!! $alltags !!} });
	</script>
@endsection