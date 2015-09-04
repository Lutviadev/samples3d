@extends('layouts.master')

@section('title') - List Tours @endsection

@section('styles')

@endsection

@section('page-header')

	@include('layouts.partials.path',['menu'=>'Tours', 'submenu'=>'List Tours', 'icon'=>'3d_rotation', 'route' => 'tour_index'])

@endsection

@section('content')

	<div class="panel panel-default">

		<div class="panel-heading">	<h3 class="panel-title">Tours</h3> </div>

		<div class="panel-body">

			@if (Auth::user()->level() >=999 || Auth::user()->can('total.tour') || Auth::user()->can('create.tour'))
				<a href=" {{ route('tour_create') }}" class="btn btn-primary btn-create">Create</a>
			@endif

			<table id="tours" class="display" width="100%" cellspacing="0">
				<thead>
				    <tr>
				    	@if (Auth::user()->level() >=999 || Auth::user()->can('total.tour') || Auth::user()->can('create.tour'))
					        <th width="20%">Briefcases</th>
					        <th width="40%">Title</th>
					        <th width="40%">Foldername</th>
				        	<th class="dt_actions">Actions</th>
			        	@else
					        <th width="50%">Title</th>
					        <th width="50%">Foldername</th>
				        	<th class="dt_actions">Actions</th>
				        @endif
				    </tr>
				</thead>
			</table>

		</div>
	</div>

@endsection

@section('scripts')
	<script>

        $('#tours').DataTable({
        	aaSorting: [],
        	processing: true,
        	serverSide: true,
        	responsive: true,
        	ajax: {
        		url: "{{ route('datatableTour') }}",
        		method: 'POST'
        	},
         	columns: [
         		@if (Auth::user()->level() >=999 || Auth::user()->can('total.tour') || Auth::user()->can('create.tour'))
         		{data: 'briefcases', name: 'briefcases'},
         		@endif
	            {data: 'title', name: 'title'},
	            {data: 'foldername', name: 'foldername', orderable: false, searchable: false},
	            {data: 'action', name: 'action', orderable: false, searchable: false}
        	],
        	initComplete: function()
        	{
				$('.delete-form-btn').click(function(event)
				{
					var that = this;
					event.preventDefault();
					bootbox.dialog({
						title: '<i class="material-icons">delete</i> Delete',
						message: 'Are you sure you want to delete this Tour?',
						buttons:{
							danger:{
								label: 'Cancel',
								className: 'btn btn-danger',
								callback: function(){}
							},
							success:{
								label: 'Delete',
								className: 'btn btn-primary',
								callback: function(){
									$(that).closest('form').submit();
								}
							}
						}
					});
				});
        	}
        });

	</script>
@endsection