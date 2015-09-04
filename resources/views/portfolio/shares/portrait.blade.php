<?php
	$page_w = 560;
	$page_h = 1100;

	$totalimages = count($portfolio->rendersimages);

	$pages = round($totalimages / 2);

	if($totalimages == 1)
	{
		$class = 'final';
	}
	else
	{
		$class = 'pagina';
	}

	$i=1;
	$proindex = 2;

	$imgs = [];

	foreach ($portfolio->rendersimages as $image)
	{
		$imgs[$i]['id'] = $image->id;
		$imgs[$i]['title'] = $image->title;
		$imgs[$i]['desc'] = $image->description;
		$i++;
	}
?>

<!DOCTYPE html>
<html>
  <head>
        <style type="text/css">
            @page {
			  size: A4 portrait;
			  margin: 0;
			}
			.pagina {
			    page-break-after: always;
				margin: 0in;
				height: 100%;
				width: 100%;
				position:absolute;
				font-family: helvetica;
			}
			.final{
				margin: 0in;
				height: 100%;
				width: 100%;
				position:absolute;
				font-family: helvetica;
			}
			.logo{
				padding-top: 25px;
				text-align: center;
				width: 245px;
			}
			.mess{
				padding: 25px;
				text-align: left;
				color: #FFF;
			}
			.datos{
				padding: 25px;
				text-align: left;
				color: #FFF;
				font-size: 15px;
			}
			.datos .nombre{
				font-weight: bold;
				font-size: 18px;
			}
			.col{
				background-image: url('img/pdf/pdfshadow.png');
				background-repeat: no-repeat;
			}
			.text{
				margin-left: 10%;
				width:80%;
			}
			.text h1{
				font-size: 38px;
				margin-bottom: 30px;
				color: #4C4C4E;
				font-weight: lighter;
			}
			.text p{
				font-size: 20px;
				margin: 0px;
				width: 500px;
			}
			.pe{
				text-align: center;
				padding: 15px;
				width: 500px;
			}
			.gris{
				color: #4C4C4E;
			}

			.facebook, .twitter, .web{
				color: #FFF;
				text-decoration: none;
			}
        </style>
  </head>
  <body>

	<table cellpadding="0" cellspacing="0" border="0" width="{{ $page_w }}" class="{{ $class }}">
	<tr>
	<td width="22%" height="580" style="background-color: {{ $portfolio->color }}" valign="top" class="col">

	<table cellpadding="0" cellspacing="0" border="0">
	<tr>
		<td height="65%" valign="top">

		<div class="logo">
		<img src="{{ route('thumb_w', ['id' => $portfolio->user->images[0]->id, 'w' => 200]) }}" alt="">
		</div>

		<div class="mess"></div>

		</td>
	</tr>

	<tr>
		<td width="35%" valign="top">

			<div class="datos">
				<span class="nombre">{{ $portfolio->user->profile->firstname }} {{ $portfolio->user->profile->lastname }}</span><br>
				<br><br>
				<span class="tel">{{ $portfolio->user->profile->companyphone }}</span><br>
				<span class="mail">{{ $portfolio->user->profile->companymail }}</span>
				<br><br>
				<a href="{{ $portfolio->user->profile->facebook }}" class="facebook">Facebook</a><br>
				<a href="{{ $portfolio->user->profile->facebook }}" class="twitter">Twitter</a><br>
				<a href="http://{{ $portfolio->user->profile->web }}" class="web">{{ $portfolio->user->profile->web }}</a><br><br>
				<span class="addres">{{ $portfolio->user->profile->companyaddress }}</span>
			</div>

		</td>
	</tr>
	</table>
	</td>

	<td width="78%" style="background-color: #FFF">

			<div style="text-align:center;height:300px;">
			<h1 style="color:{{ $portfolio->color }}">{{  $portfolio->title }}</h1>
			</div>

			<div style="text-align:center">

				<h3>{{ $imgs[1]['title'] }}</h3>
				<img src="{{ route('thumb_w_h', ['id' => $imgs[1]['id'], 'w' => 600, 'h'=>270]) }}" alt="" width="600" height="270" style="margin-top:8px;">

				@if ($imgs[1]['desc'] == '')
					<p class="pe">&nbsp;&nbsp;&nbsp;&nbsp;</p>
				@else
					<p class="pe">{{ $imgs[1]['desc'] }}</p>
				@endif

			</div>

	</td>

	</tr>
	</table>

	@if ($pages > 1)

	@for ($t = 1; $t <= $pages-1; $t++)

		<table cellpadding="0" cellspacing="0" border="0" width="{{ $page_w }}" class="{{ $class }}">
		<tr>
		<td width="22%" height="580" style="background-color: {{ $portfolio->color }}" valign="top" class="col">

		<table cellpadding="0" cellspacing="0" border="0">
		<tr>
			<td height="65%" valign="top">

			<div class="logo">
			<img src="{{ route('thumb_w', ['id' => $portfolio->user->images[0]->id, 'w' => 200]) }}" alt="">
			</div>

			<div class="mess"></div>

			</td>
		</tr>

		<tr>
			<td width="35%" valign="top">

				<div class="datos">
					<span class="nombre">{{ $portfolio->user->profile->firstname }} {{ $portfolio->user->profile->lastname }}</span><br>
					<br><br>
					<span class="tel">{{ $portfolio->user->profile->companyphone }}</span><br>
					<span class="mail">{{ $portfolio->user->profile->companymail }}</span>
					<br><br>
					<a href="{{ $portfolio->user->profile->facebook }}" class="facebook">Facebook</a><br>
					<a href="{{ $portfolio->user->profile->facebook }}" class="twitter">Twitter</a><br>
					<a href="http://{{ $portfolio->user->profile->web }}" class="web">{{ $portfolio->user->profile->web }}</a><br><br>
					<span class="addres">{{ $portfolio->user->profile->companyaddress }}</span>
				</div>

			</td>
		</tr>
		</table>
		</td>

		<td width="78%" style="background-color: #FFF">

		@for ($x = 1; $x <= 2; $x++)

			@if (isset($imgs[$proindex]))

				<div style="text-align:center;margin-bottom:50px;">

					<h3>{{ $imgs[$proindex]['title'] }}</h3>
					<img src="{{ route('thumb_w_h', ['id' => $imgs[$proindex]['id'], 'w' => 600, 'h'=>270]) }}" alt="" width="600" height="270" style="margin-top:8px;">

					@if ($imgs[$proindex]['desc'] == '')
						<p class="pe">&nbsp;&nbsp;&nbsp;&nbsp;</p>
					@else
						<p class="pe">{{ $imgs[$proindex]['desc'] }}</p>
					@endif

				</div>

			@endif

			<?php $proindex++; ?>
		@endfor

		</td>

		</tr>
		</table>

		<?php
		if($t == $pages-2)
		{
			$class = "final";
		}
		?>

	@endfor

	@endif

</body></html>