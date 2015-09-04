@if (Auth::user()->level() >=999)

<div class="form-group">    
    {!! Form::label('user_id', 'User') !!}
	<div class="input-group {{ $errors->has('user_id') ? 'has-error' : '' }}">
	    <span class="input-group-addon"><i class="glyphicon glyphicon-pencil"></i></span>  
	    {!! Form::select('user_id', $users, null, ['class' => 'form-control']) !!}					    
	</div>	
	{!! $errors->first('user_id' ,'<small class="text-danger">:message</small>') !!}
</div>

@endif


<div class="col-xs-24">
	
	<div class="form-group social">
	    {!! Form::label('social', 'Social Icons') !!}	
	    <div class="input-group">
			<div class="btn-group" data-toggle="buttons">
				@if (isset($portfolio->social) && $portfolio->social == 'hide')
					<label class="btn btn-info">
					    {!! Form::radio('social', 'show',  null, null) !!} Show		    
					</label>
					<label class="btn btn-info active">
						{!! Form::radio('social', 'hide',  null, ['checked']) !!} Hide
					</label>
				@else				
					<label class="btn btn-info active">
					    {!! Form::radio('social', 'show',  null, ['checked']) !!} Show		    
					</label>
					<label class="btn btn-info">
						{!! Form::radio('social', 'hide',  null, null) !!} Hide
					</label>
				@endif			
			</div>
		</div>
	</div>

	<div class="form-group color">    
	    {!! Form::label('color', 'Color') !!}
		<div class="input-group {{ $errors->has('color') ? 'has-error' : '' }}">
		    <span class="input-group-addon"><i class="glyphicon glyphicon-tint"></i></span>  
		    {!! Form::text('color', null, ['class' => 'colorpicker form-control', 'required' => 'required']) !!}	    
		</div>	
		{!! $errors->first('color' ,'<small class="text-danger">:message</small>') !!}
	</div>

</div>

<div class="form-group">    
    {!! Form::label('title', 'Title') !!}
	<div class="input-group {{ $errors->has('title') ? 'has-error' : '' }}">
	    <span class="input-group-addon"><i class="glyphicon glyphicon-pencil"></i></span>  
	    {!! Form::text('title', null, ['class' => 'form-control', 'required' => 'required']) !!}	    
	</div>	
	{!! $errors->first('title' ,'<small class="text-danger">:message</small>') !!}
</div>

<div class="form-group">    
    {!! Form::label('phase1', 'Phase 1') !!}
	<div class="input-group {{ $errors->has('phase1') ? 'has-error' : '' }}">
	    <span class="input-group-addon"><i class="glyphicon glyphicon-pencil"></i></span>  
	    {!! Form::text('phase1', null, ['class' => 'form-control', 'required' => 'required']) !!}	    
	</div>	
	{!! $errors->first('phase1' ,'<small class="text-danger">:message</small>') !!}
</div>

<div class="form-group">    
    {!! Form::label('phase2', 'Phase 2') !!}
	<div class="input-group {{ $errors->has('phase2') ? 'has-error' : '' }}">
	    <span class="input-group-addon"><i class="glyphicon glyphicon-pencil"></i></span>  
	    {!! Form::text('phase2', null, ['class' => 'form-control', 'required' => 'required']) !!}	    
	</div>	
	{!! $errors->first('phase2' ,'<small class="text-danger">:message</small>') !!}
</div>

<div class="form-group">    
    {!! Form::label('slug', 'Name') !!}
	<div class="input-group {{ $errors->has('slug') ? 'has-error' : '' }}">
	    <span class="input-group-addon"><i class="glyphicon glyphicon-link"></i> samples3d.com/portfolio/show/</span>  
	    {!! Form::text('slug', null, ['class' => 'form-control', 'required' => 'required']) !!}	    
	</div>	
	{!! $errors->first('slug' ,'<small class="text-danger">:message</small>') !!}
	<span class="note"><i class="glyphicon glyphicon-info-sign"></i> Name need by unique. Is used to make portfolio share link, for example 'myName' would result to 'http://samples3d.com/portfolios/myName'</span>
</div>

<div id="resourcetabs">
	<!-- Nav tabs -->
	<ul class="nav nav-tabs" role="tablist">
		<li role="presentation" class="active"><a href="#renders" aria-controls="renders" role="tab" data-toggle="tab">Renders</a></li>
		<li role="presentation"><a href="#animations" aria-controls="animations" role="tab" data-toggle="tab">Animations</a></li>
		<li role="presentation"><a href="#tours" aria-controls="tours" role="tab" data-toggle="tab">Tours</a></li>
	</ul>

	<!-- Tab panes -->
	<div class="tab-content">
		<div role="tabpanel" class="tab-pane active" id="renders">
			<div class="resource">		
				@include('layouts.partials.resource', ['gallery' => 'render'])
			</div>	
		</div>
		<div role="tabpanel" class="tab-pane" id="animations">
			<div class="resource">		
				@include('layouts.partials.resource', ['gallery' => 'animation'])
			</div>	
		</div>
		<div role="tabpanel" class="tab-pane" id="tours">
			<div class="resource">		
				@include('layouts.partials.resource', ['gallery' => 'tour'])
			</div>	
		</div>
	</div>
</div>