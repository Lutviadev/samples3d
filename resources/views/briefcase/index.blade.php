@extends('layouts.master')

@section('title') - List Briefcases @endsection

@section('styles')

@endsection

@section('page-header')

	@include('layouts.partials.path',['menu'=>'Briefcases', 'submenu'=>'List Briefcases', 'icon'=>'work', 'route' => 'briefcase_index'])

@endsection

@section('content')

	<div class="panel panel-default">

		<div class="panel-heading">	<h3 class="panel-title">Briefcases</h3> </div>

		<div class="panel-body">

			@if (Auth::user()->level() >=999 || Auth::user()->can('total.briefcase') || Auth::user()->can('create.briefcase'))
				<a href=" {{ route('briefcase_create') }}" class="btn btn-primary btn-create">Create</a>
			@endif

			<table id="briefcases" class="display" width="100%" cellspacing="0">
				<thead>
				    <tr>
				        <th width="100%">Name</th>
				        <th class="dt_actions">Actions</th>
				    </tr>
				</thead>
			</table>

		</div>
	</div>

@endsection

@section('scripts')
	<script>

        $('#briefcases').DataTable({
        	aaSorting: [],
        	processing: true,
        	serverSide: true,
        	responsive: true,
        	ajax: {
        		url: "{{ route('datatableBriefcase') }}",
        		method: 'POST'
        	},
         	columns: [
	            {data: 'name', name: 'name'},
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
						message: 'Are you sure you want to delete this Briefcase?',
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