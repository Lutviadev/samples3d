@extends('layouts.master')

@section('title') - Create Portfolio @endsection

@section('styles')

@endsection

@section('page-header')

	@include('layouts.partials.path',['menu'=>'Portfolio', 'submenu'=>'Create Portfolio', 'icon'=>'3d_rotation', 'route' => 'portfolio_index'])

@endsection

@section('content')

	@include('layouts.partials.vimeo')

	@include('portfolio.partials.search', ['search' => 'rendermodal','name'=> 'Renders', 'tags' => $tagsrender])

	@include('portfolio.partials.search', ['search' => 'tourmodal','name'=> 'Tours', 'tags' => $tagstour])

	@include('portfolio.partials.search', ['search' => 'animationmodal','name'=> 'Animations', 'tags' => $tagsanim])

	{!! Form::open(['method' => 'POST', 'route' => 'portfolio_store', 'class' => 'form-horizontal', 'autocomplete' => 'off']) !!}

	<div class="panel panel-default">

		<div class="panel-heading">	<h3 class="panel-title">New Portfolio</h3> </div>

		<div class="panel-body">

		    @include('portfolio.partials.form', ['action' => 'create'])

		    <div class="col-xs-24">
				<div class="form-group">
					<div class="btn-group pull-right">
						{!! HTML::link( route('tour_index'), 'Cancel', ['class' => 'btn btn-danger']) !!}
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

	$('.colorpicker').minicolors({theme: 'bootstrap',position: 'bottom right'});

	var ImageManager = $(document).ImageManager({mode:'check',gallery: $('#rendermodal-gallery'),thumbroute:"{{ route('thumbroute') }}" ,tipo:'render'});
	var ImageManager2 = $(document).ImageManager({mode:'image',gallery: $('#render'),thumbroute:"{{ route('thumbroute') }}",inputname:'renders' });
	var selected = [];
	var iM_ids_index = 0;
	var put = false;
	portRender('{{ route("getcategories") }}','{{ route("getsubcategories") }}','{{ route("render_search") }}');

	var ImageManager3= $(document).ImageManager({mode:'check',gallery: $('#tourmodal-gallery'),thumbroute:"{{ route('thumbroute') }}",tipo:'tour' });
	var ImageManager5 = $(document).ImageManager({mode:'image',gallery: $('#tour'),thumbroute:"{{ route('thumbroute') }}",inputname:'tours'  });
	var selected_2 = [];
	var iM_ids_index_2 = 0;
	var put2 = false;
	portTour('{{ route("tour_search") }}');

	var ImageManager4 = $(document).ImageManager({mode:'check',gallery: $('#animationmodal-gallery'),thumbroute:"{{ route('thumbroute') }}",tipo:'anim', vimeo:"{{ route('get_vimeo') }}" });
	var ImageManager6 = $(document).ImageManager({mode:'image',gallery: $('#animation'),thumbroute:"{{ route('thumbroute') }}",inputname:'animations', tipo:'anim' });
	var selected_3 = [];
	var iM_ids_index_3 = 0;
	var put3 = false;
	portAnim('{{ route("animation_search") }}');
	</script>
@endsection