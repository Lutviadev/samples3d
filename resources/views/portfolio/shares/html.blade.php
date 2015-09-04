<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<title>Samples 3D</title>
</head>

<style>
	body
	{
		font-family:Arial,sans-serif;
		margin: 0px;
	}
	td{
		padding:5px;
	}
</style>
<body>
	<table width="650px" cellpadding="0" cellspacing="0">

		<tr bgcolor="{{ $portfolio->color }}">
			<td width="250px" align="center">
			<img src="{{ route('thumb_w', ['id' => $portfolio->user->images[0]->id, 'w' => 200]) }}" alt="">
			</td>
			<td valign="center">
				<span href="" style="color:#000;font-size:20px;">{{ $portfolio->user->profile->firstname }} {{ $portfolio->user->profile->lastname }}</span><br>
				<span href="" style="color:#FFF">{{ $portfolio->user->profile->web }}</span>
			</td>
		</tr>
		<tr>
			<td colspan="2" style="color:{{ $portfolio->color }}" align="center"><h4 style="font-weight:normal; font-size:26px; margin: 15px 0px;">{{ $portfolio->title }}</h4></td>
		</tr>

		@foreach ($portfolio->toursimages as $tourimage)

			@if (count($tourimage->tour) != 0)

				<tr>
					<td colspan="2" align="center">
						<table width="600px">
						<tr>
							<td>
								<a href="{{ route('portfolio_tour', ['id' => $tourimage->tour[0]->id ]) }}" target="_blank">
								<img src="{{ route('thumb_w', ['id' => $tourimage->id, 'w' => 600]) }}" alt="">
							</td>
						</tr>
						<tr>
							<td>
								<a href="{{ route('portfolio_tour', ['id' => $tourimage->tour[0]->id ]) }}" target="_blank">
								<span style="font-size:12px;float:right;color:{{ $portfolio->color }};margin-right:15px;">open tour</span></a>
								</a>
								<span style="margin:0px 0px 5px 0px; font-weight:normal; font-size:20px; color:#999999">
								{{ $tourimage->tour[0]->title }}
								</span><br>
								<br>
							</td>
						</tr>
						</table>
					</td>
				</tr>

			@endif

		@endforeach

		@foreach ($portfolio->animationsimages as $animationsimage)

			@if (count($animationsimage->animation) != 0)

				<tr>
					<td colspan="2" align="center">
						<table width="600px">
						<tr>
							<td>
								<a href="{{ route('portfolio_tour', ['id' => $animationsimage->animation[0]->id ]) }}" target="_blank">
								<img src="{{ route('thumb_w', ['id' => $animationsimage->id, 'w' => 600]) }}" alt="">
							</td>
						</tr>
						<tr>
							<td>
								<a href="{{ route('portfolio_animation', ['id' => $animationsimage->animation[0]->id ]) }}" target="_blank">
								<span style="font-size:12px;float:right;color:{{ $portfolio->color }};margin-right:15px;">open animation</span></a>
								</a>
								<span style="margin:0px 0px 5px 0px; font-weight:normal; font-size:20px; color:#999999">
								{{ $animationsimage->animation[0]->title }}
								</span><br>
								<br>
							</td>
						</tr>
						</table>
					</td>
				</tr>

			@endif

		@endforeach

		@foreach ($portfolio->rendersimages as $image)

			<tr>
				<td colspan="2" align="center">
					<table width="600px">
					<tr>
						<td>
							<img src="{{ route('thumb_w', ['id' => $image->id, 'w' => 600]) }}" alt="">
						</td>
					</tr>
					<tr>
						<td>
							<span style="margin:0px 0px 5px 0px; font-weight:normal; font-size:20px; color:#999999">
							{{ $image->title }}
							</span><br>
							<span style="margin:0px 0px 15px 0px; font-weight:normal; text-align:justify; color:#999999">
							{{ $image->description }}
							</span>
							<br>
						</td>
					</tr>
					</table>
				</td>
			</tr>
			<tr><td colspan="2" height="15px"></td></tr>

		@endforeach

		<tr bgcolor="{{ $portfolio->color }}" style="color:#FFF">
			<td colspan="2" align="center" height="60px">
			<span style="font-weight:normal; text-align:center; color:#FFFFFF; font-size:14px">
			@if ($portfolio->user->profile->company != '') {{ $portfolio->user->profile->company }} @endif
			@if ($portfolio->user->profile->companyphone != '') | {{ $portfolio->user->profile->companyphone }} @endif
			@if ($portfolio->user->profile->companymail != '') | {{ $portfolio->user->profile->companymail }} @endif
			@if ($portfolio->user->profile->companyaddress != '') | {{ $portfolio->user->profile->companyaddress }} @endif
			</span> <br>
			@if ($portfolio->social == 'show')

				<div style="margin-top:10px;">
					@if ($portfolio->user->profile->twitter != '') <a href="{{ $portfolio->user->profile->twitter }}"><img title="Twitter" src="http://betastatus.info/remoteresources/twitter-white.png" alt="Twitter" width="16" height="16" /></a> @endif
					@if ($portfolio->user->profile->linkedin != '') <a href="{{ $portfolio->user->profile->linkedin }}"><img title="Linkedin" src="http://betastatus.info/remoteresources/linkedin-white.png" alt="Linkedin" width="16" height="16" /></a> @endif
					@if ($portfolio->user->profile->facebook != '') <a href="{{ $portfolio->user->profile->facebook }}"><img title="Facebook" src="http://betastatus.info/remoteresources/facebook-white.png" alt="Facebook" width="16" height="16" /></a> @endif
				</div>

			@endif
			</td>
		</tr>

	</table>
</body>
</html>