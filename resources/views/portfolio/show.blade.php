@extends('layouts.portfolio')

@section('content')

<div class="porfolio">

	<div class="header">
		<div class="logo" style="background-image:url({{ route('thumb_w',['id'=> $logo, 'w' => 250 ]) }})"></div>
		<div class="title" style="background:{{ $portfolio->color }}">{{ $portfolio->title }}</div>
	</div>

	<div class="footer">
		<table width="100%">
			<tr>
				<td valign="top" width="15%">
					<div class="user">
						{{ $user->profile->firstname }}	{{ $user->profile->lastname }} <br>
						@if ($user->profile->web  != '') {{ $user->profile->web }} <br>	@endif

						@if ($portfolio->social == 'show')

						@endif
					</div>
				</td>
				<td valign="top" width="70%"><div class="titles"></div></td>
				<td valign="top" width="15%">
					<div class="data">
						@if ($user->profile->company  != '') {{ $user->profile->company }} <br>	@endif
						@if ($user->profile->companyaddress  != '') {{ $user->profile->companyaddress }} <br>	@endif
						@if ($user->profile->companyphone  != '') {{ $user->profile->companyphone }} <br>	@endif
						@if ($user->profile->companymail  != '') {{ $user->profile->companymail }} <br>	@endif
					</div>
				</td>
			</tr>
		</table>
	</div>

	<div class="controles"></div>

	<div class="bg">

		<div class="owl">
		@foreach ($renderimages as $image)

			<div class="item" style="background:url({{ route('thumb_full',['id'=> $image->id]) }})">
				<div class="footer" style="background:{{ $portfolio->color }}">
					<table width="100%">
						<tr>
							<td><div class="user"></div></td>
							<td valign="top">
								<div class="titles">
									<h2>{{ $image->title }}</h2>
									<p>{{ $image->description }}</p>
								</div>
							</td>
							<td><div class="data"></div></td>
						</tr>
					</table>
				</div>
			</div>

		@endforeach

		@foreach ($toursimages as $image)
			<?php $path = route('portfolio_tour',[ 'path'=>$image->tour[0]->id]);?>
			<div class="item" style="background:url({{ route('thumb_full',['id'=> $image->id]) }})">
				<a href="{{ $path }}" class="play" target="_blank"><i class="material-icons" style="color:{{ $portfolio->color }}">3d_rotation</i></a>
				<div class="footer" style="background:{{ $portfolio->color }}">
					<table width="100%">
						<tr>
							<td><div class="user"></div></td>
							<td valign="top">
								<div class="titles">
									<h2>{{ $image->title }}</h2>
									<p>{{ $image->description }}</p>
								</div>
							</td>
							<td><div class="data"></div></td>
						</tr>
					</table>
				</div>
			</div>

		@endforeach

		@foreach ($animationsimages as $image)

			<div class="item" style="background:url({{ route('thumb_full',['id'=> $image->id]) }})">
				<a href="javascript:void()" class="play"><i class="material-icons" style="color:{{ $portfolio->color }}">play_circle_outline</i></a>
				<div class="footer" style="background:{{ $portfolio->color }}">
					<table width="100%">
						<tr>
							<td><div class="user"></div></td>
							<td valign="top">
								<div class="titles">
									<h2>{{ $image->title }}</h2>
									<p>{{ $image->description }}</p>
								</div>
							</td>
							<td><div class="data"></div></td>
						</tr>
					</table>
				</div>
			</div>

		@endforeach

		</div>
		<div class="footer" style="background:{{ $portfolio->color }}"></div>
	</div>
</div>

@endsection

@section('scripts')
	<script>

	$(document).ready(function(){

		owl = $(".owl");
		owl.owlCarousel({
		    items:1,

		    @if ($total > 1)
			    loop:true,
		    @endif

		    nav:true,
		    navContainer:'.controles',
		    navText:['<i class="material-icons" style="color:{{ $portfolio->color }}">keyboard_arrow_left</i>','<i class="material-icons" style="color:{{ $portfolio->color }}">keyboard_arrow_right</i>']
		});

	});
	</script>
@endsection