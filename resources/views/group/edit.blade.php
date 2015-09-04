@extends('layouts.master')

@section('title') - Edit Group @endsection

@section('styles')

@endsection

@section('page-header')	

	@include('layouts.partials.path',['menu'=>'Groups & Permissions', 'submenu'=>'Edit Group', 'icon'=>'group_work', 'route' => 'group_index'])

@endsection

@section('content')

	{!! Form::model($group, ['method' => 'PATCH', 'route' => ['group_update' ,$group->id], 'class' => 'form-horizontal', 'autocomplete' => 'off']) !!}
	
	<div class="panel panel-default">

		<div class="panel-heading">	<h3 class="panel-title">Edit Group</h3> </div>	
	
		<div class="panel-body">

	    	@include('group.partials.form')

		    <div class="col-xs-24">			
				<div class="form-group">
					<div class="btn-group pull-right">
						{!! HTML::link( route('group_index'), 'Cancel', ['class' => 'btn btn-danger']) !!}
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
	myCollector = $('.briefcaseCollector').Collector({ name:'briefcases', ajaxurl:"{{ route('briefcasename') }}", token:"{{ csrf_token() }}" }); 
	myCollector.getCollection({{ $group->id }}, "{{ route('getcollectionbriefcases') }}", "{{ route('getcollectionpermissions') }}")
	</script>
@endsection