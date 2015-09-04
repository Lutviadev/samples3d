@extends('layouts.master')

@section('title') - Edit User @endsection

@section('styles')

@endsection

@section('page-header')

	@include('layouts.partials.path',['menu'=>'Users', 'submenu'=>'Edit User', 'icon'=>'group', 'route' => 'user_index'])

@endsection

@section('content')

	{!! Form::model($user, ['method' => 'PATCH', 'route' => ['user_update', $user->id], 'class' => 'form-horizontal', 'autocomplete' => 'off', 'files' => true]) !!}

	<div class="panel panel-default">

		<div class="panel-heading">	<h3 class="panel-title">Edit User</h3> </div>

		<div class="panel-body">

			@include('user.partials.form', ['action' => 'edit'])

			<div class="col-xs-24">
				<div class="form-group">
					<div class="btn-group pull-right">
						{!! HTML::link( route('user_index'), 'Cancel', ['class' => 'btn btn-danger']) !!}
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
		$('.profilebtn').click(function(event)
		{
			event.preventDefault();
			$('#profile').slideToggle();

		});
		var ImageManager = $(document).ImageManager({mode:'single',myme:'png',thumbroute:"{{ route('thumbroute') }}"});

		@if (isset($images))
			@foreach ($images as $image)
				ImageManager.addImage(['','','{{ $image->id }}','','']);
			@endforeach
		@endif
	</script>
@endsection