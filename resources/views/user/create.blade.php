@extends('layouts.master')

@section('title') - Create User @endsection

@section('styles')

@endsection

@section('page-header')

	@include('layouts.partials.path',['menu'=>'Users', 'submenu'=>'Create User', 'icon'=>'group', 'route' => 'user_index'])

@endsection

@section('content')

	{!! Form::open(['method' => 'POST', 'route' => 'user_store', 'class' => 'form-horizontal', 'autocomplete' => 'off', 'files' => true]) !!}

	<div class="panel panel-default">

		<div class="panel-heading">	<h3 class="panel-title">New User</h3> </div>

		<div class="panel-body">

			@include('user.partials.form', ['action' => 'create'])

			<div class="col-xs-24">
				<div class="form-group">
					<div class="btn-group pull-right">
						{!! HTML::link( route('user_index'), 'Cancel', ['class' => 'btn btn-danger']) !!}
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
		$('.profilebtn').click(function(event)
		{
			event.preventDefault();
			$('#profile').slideToggle();
		});

		var ImageManager = $(document).ImageManager({mode:'single',myme:'png'});
	</script>
@endsection