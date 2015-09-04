@extends('layouts.master')

@section('title') - List Portfolios @endsection

@section('styles')

@endsection

@section('page-header')

	@include('layouts.partials.path',['menu'=>'Portfolios', 'submenu'=>'List Portfolios', 'icon'=>'3d_rotation', 'route' => 'portfolio_index'])

@endsection

@section('content')

	<div class="panel panel-default">

		<div class="panel-heading">	<h3 class="panel-title">Portfolios</h3> </div>

		<div class="panel-body">

			@if (Auth::user()->level() >=999 || Auth::user()->can('total.portfolio') || Auth::user()->can('create.portfolio'))
				<a href=" {{ route('portfolio_create') }}" class="btn btn-primary btn-create">Create</a>
			@endif

			<table id="portfolios" class="display" width="100%" cellspacing="0">
				<thead>
				    <tr>
				    	@if (Auth::user()->level() >=999)
					        <th width="20%">User</th>
					        <th width="40%">Title</th>
					        <th width="40%">Shares</th>
				        	<th class="dt_actions">Actions</th>
			        	@else
					        <th width="50%">Title</th>
					        <th width="50%">Shares</th>
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

        $('#portfolios').DataTable({
        	aaSorting: [],
        	processing: true,
        	serverSide: true,
        	responsive: true,
        	ajax: {
        		url: "{{ route('datatablePortfolios') }}",
        		method: 'POST'
        	},
         	columns: [
         		@if (Auth::user()->level() >= 999)
         		{data: 'user', name: 'user'},
         		@endif
	            {data: 'title', name: 'title'},
	            {data: 'slug', name: 'slug', orderable: false, searchable: false},
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
						message: 'Are you sure you want to delete this Portfolio?',
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