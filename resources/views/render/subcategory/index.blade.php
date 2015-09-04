@extends('layouts.master')

@section('title') - List Subcategories @endsection

@section('styles')

@endsection

@section('page-header')	

	@include('layouts.partials.path',['menu'=>'Subcategories', 'submenu'=>'List Subcategories', 'icon'=>'wallpaper', 'route' => 'subcategory_index'])

@endsection

@section('content')
	
	<div class="panel panel-default">

		<div class="panel-heading">	<h3 class="panel-title">Subcategories</h3> </div>
	
		<div class="panel-body">

			<a href=" {{ route('subcategory_create') }}" class="btn btn-primary btn-create">Create</a>

			<table id="subcategories" class="display" width="100%" cellspacing="0">
				<thead>
				    <tr>
				        <th width="33%">Main Category</th>
				        <th width="33%">Category</th>
				        <th width="33%">Name</th>
				        <th class="dt_actions">Actions</th>		        
				    </tr>
				</thead>
			</table>

		</div>			
	</div>

@endsection

@section('scripts')
	<script>

        $('#subcategories').DataTable({
        	aaSorting: [],
        	processing: true,
        	serverSide: true,
        	responsive: true,
        	ajax: {
        		url: "{{ route('datatableSubcategory') }}",
        		method: 'POST'
        	},
         	columns: [
	            {data: 'maincategory', name: 'maincategory'},
	            {data: 'category', name: 'category'},
	            {data: 'name', name: 'name'},
	            {data: 'action', name: 'action', orderable: false, searchable: false}	               
        	],
        	initComplete: function()
        	{

				$('.delete-form-btn').click(function(event) 
				{			
					var that = this;	
					event.preventDefault();		
					bootbox.confirm('<h3 class="confirm-del-title">DELETE</h3> Are you sure you want to delete this record?', function(result) 
					{	
						if(result === true)
						{
							$(that).closest('form').submit();
						}
					}); 
				});
        	}
        });

	</script>
@endsection