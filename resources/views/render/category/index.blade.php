@extends('layouts.master')

@section('title') - List Categories @endsection

@section('styles')

@endsection

@section('page-header')	

	@include('layouts.partials.path',['menu'=>'Categories', 'submenu'=>'List Categories', 'icon'=>'wallpaper', 'route' => 'maincategory_index'])

@endsection

@section('content')
	
	<div class="panel panel-default">

		<div class="panel-heading">	<h3 class="panel-title">Categories</h3> </div>
	
		<div class="panel-body">

			<a href=" {{ route('category_create') }}" class="btn btn-primary btn-create">Create</a>

			<table id="categories" class="display" width="100%" cellspacing="0">
				<thead>
				    <tr>
				        <th width="50%">Main Category</th>
				        <th width="50%">Name</th>
				        <th class="dt_actions">Actions</th>		        
				    </tr>
				</thead>
			</table>

		</div>			
	</div>

@endsection

@section('scripts')
	<script>

        $('#categories').DataTable({
        	aaSorting: [],
        	processing: true,
        	serverSide: true,
        	responsive: true,
        	ajax: {
        		url: "{{ route('datatableCategory') }}",
        		method: 'POST'
        	},
         	columns: [
	            {data: 'maincategory', name: 'maincategory'},
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