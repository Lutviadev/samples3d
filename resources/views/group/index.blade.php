@extends('layouts.master')

@section('title') - List Groups @endsection

@section('styles')

@endsection

@section('page-header')

	@include('layouts.partials.path',['menu'=>'Groups & Permissions', 'submenu'=>'List Groups', 'icon'=>'group_work', 'route' => 'group_index'])

@endsection

@section('content')

	<div class="panel panel-default">

		<div class="panel-heading">	<h3 class="panel-title">Groups</h3> </div>

		<div class="panel-body">

			@if (Auth::user()->level() >=999 || Auth::user()->can('total.group') || Auth::user()->can('create.group'))
				<a href=" {{ route('group_create') }}" class="btn btn-primary btn-create">Create</a>
			@endif

			<table id="groups" class="display" width="100%" cellspacing="0">
				<thead>
				    <tr>
				        <th width="20%">Name</th>
				        <th width="80%">Description</th>
				        <th class="dt_actions">Actions</th>
				    </tr>
				</thead>
			</table>

		</div>
	</div>

@endsection

@section('scripts')
	<script>

        $('#groups').DataTable({
        	aaSorting: [],
        	processing: true,
        	serverSide: true,
        	responsive: true,
        	ajax: {
        		url: "{{ route('datatableGroup') }}",
        		method: 'POST'
        	},
         	columns: [
	            {data: 'name', name: 'name'},
	            {data: 'description', name: 'description'},
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
						message: 'Are you sure you want to delete this Group?',
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