@extends('layouts.master')

@section('title') - Users @endsection

@section('styles')

@endsection

@section('page-header')

	@include('layouts.partials.path',['menu'=>'Users', 'submenu'=>'List Users', 'icon'=>'group', 'route' => 'user_index'])

@endsection

@section('content')

	<div class="panel panel-default">

		<div class="panel-heading">	<h3 class="panel-title">Users</h3> </div>

		<div class="panel-body">

			@if (Auth::user()->level() >=999 || Auth::user()->can('total.user') || Auth::user()->can('create.user'))
				<a href=" {{ route('user_create') }}" class="btn btn-primary btn-create">Create</a>
			@endif

			<table id="users" class="display" width="100%" cellspacing="0">
				<thead>
				    <tr>
				        <th width="20%">Username</th>
				        <th width="60%">Email</th>
				        <th width="20%">Group</th>
				        <th class="dt_actions">Actions</th>
				    </tr>
				</thead>
			</table>

		</div>
	</div>

@endsection

@section('scripts')
	<script>

        $('#users').DataTable({
        	aaSorting: [],
        	processing: true,
        	serverSide: true,
        	responsive: true,
        	ajax: {
        		url: "{{ route('datatableUser') }}",
        		method: 'POST'
        	},
         	columns: [
	            {data: 'username', name: 'username'},
	            {data: 'email', name: 'email'},
	            {data: 'group', name: 'group'},
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
						message: 'Are you sure you want to delete this User?',
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