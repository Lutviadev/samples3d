@extends('layouts.master')

@section('title') - List Renders Galleries @endsection

@section('styles')

@endsection

@section('page-header')

	@include('layouts.partials.path',['menu'=>'Renders Galleries', 'submenu'=>'List Renders Galleries', 'icon'=>'3d_rotation', 'route' => 'render_index'])

@endsection

@section('content')

	<div class="panel panel-default">

		<div class="panel-heading">	<h3 class="panel-title">Renders Galleries</h3> </div>

		<div class="panel-body">

			@if (Auth::user()->level() >=999 || Auth::user()->can('total.render') || Auth::user()->can('create.render'))
				<a href=" {{ route('render_create') }}" class="btn btn-primary btn-create">Create</a>
			@endif

			<table id="renders" class="display" width="100%" cellspacing="0">
				<thead>
				    <tr>
				        @if (Auth::user()->level() >=999 || Auth::user()->can('total.render') || Auth::user()->can('create.render'))
					        <th width="20%">Briefcases</th>
					        <th width="10%">Main Category</th>
					        <th width="10%">Category</th>
					        <th width="10%">Subcategory</th>
					        <th width="50%">Name</th>
					        <th class="dt_actions">Actions</th>
					    @else
					        <th width="15%">Main Category</th>
					        <th width="15%">Category</th>
					        <th width="15%">Subcategory</th>
					        <th width="55%">Name</th>
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

        $('#renders').DataTable({
        	aaSorting: [],
        	processing: true,
        	serverSide: true,
        	responsive: true,
        	ajax: {
        		url: "{{ route('datatableRender') }}",
        		method: 'POST'
        	},
         	columns: [
         		@if (Auth::user()->level() >=999 || Auth::user()->can('total.render') || Auth::user()->can('create.render'))
	            {data: 'briefcases', name: 'briefcases'},
	            @endif
	            {data: 'maincategory', name: 'maincategory'},
	            {data: 'category', name: 'category'},
	            {data: 'subcategory', name: 'subcategory'},
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
						message: 'Are you sure you want to delete this Gallery?',
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

