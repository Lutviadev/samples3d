@extends('layouts.master')

@section('title') - Gallery @endsection

@section('styles')

@endsection

@section('page-header')

	@include('layouts.partials.path',['menu'=>'Renders Galleries', 'submenu'=>'Gallery', 'icon'=>'wallpaper', 'route' => 'render_index'])

@endsection

@section('content')

	{!! Form::model($render, ['method' => 'GET', null , 'class' => 'form-horizontal', 'autocomplete' => 'off']) !!}

	<div class="panel panel-default">

		<div class="panel-heading">	<h3 class="panel-title">Gallery</h3> </div>

		<div class="panel-body">

		    @include('render.partials.form')

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
		@if (session()->get('session-subcategory'))
			ajaxcategories({{session()->get('session-subcategory.maincategory_id') }}, {{session()->get('session-subcategory.category_id') }}, "{{ route('getcategories') }}" );	
			ajaxsubcategories({{session()->get('session-subcategory.maincategory_id') }}, {{session()->get('session-subcategory.category_id') }}, {{session()->get('session-subcategory.subcategory_id') }}, "{{ route('getsubcategories') }}" );		
		@else
			ajaxcategories({{ $render->maincategory_id }}, {{ $render->category_id }}, "{{ route('getcategories') }}" );
			ajaxsubcategories({{ $render->maincategory_id }}, {{ $render->category_id }}, {{ $render->subcategory_id }}, "{{ route('getsubcategories') }}" );
		@endif

		$('.maincategoryselect').change(function(event)
		{
			ajaxcategories($(this).val(), null, "{{ route('getcategories') }}");
		});

		$('.categoryselect').change(function(event)
		{
			ajaxsubcategories($('.maincategoryselect').val(), $(this).val(), null, "{{ route('getsubcategories') }}");
		});

		var ImageManager = $(document).ImageManager({ alltags: {!! $alltags !!}, thumbroute:"{{ route('thumbroute') }}" });

		@if (isset($images))
			@foreach ($images as $image)
				ImageManager.addImage(['{{ $image->title }}','{{ $image->description }}','{{ $image->id }}','{{ resourseTags($image) }}','{{ $image->path }}']);
			@endforeach
		@endif
	</script>
@endsection