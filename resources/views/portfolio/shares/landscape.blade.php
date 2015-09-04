<?php
	$page_w = 1222;
	$page_h = 800;

	$totalimages = 1;

	$totalimages = count($portfolio->rendersimages);

	if($totalimages == 1)
	{
		$class = 'final';
	}else{
		$class = 'pagina';
	}

	$i=0;
?>
<!DOCTYPE html>
<html>
  <head>
        <style type="text/css">
            @page {
			  size: A4 landscape;
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
				width: 710px;
			}
			.pe{
				text-align: center;
				padding: 15px;
				width: 843px;
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

	@foreach ($portfolio->rendersimages as $image)

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

			<table cellpadding="0" cellspacing="0" border="0" class="gris">
			<tr>
			<td height="582" valign="middle" align="center">
			<div class="img">
			<h1>{{ $image->title }}</h1>
			<img src="{{ route('thumb_w', ['id' => $image->id, 'w' => 840]) }}" alt="" style="margin-top:8px;">
			@if ($image->description == '')
				<p class="pe">&nbsp;&nbsp;&nbsp;&nbsp;</p>
			@else
				<p class="pe">{{ $image->description }}</p>
			@endif
			</div>
			</td>
			</tr>
			</table>

		</td>

		</tr>
		</table>

		<?php
			if($i == $totalimages-2)
			{
				$class = "final";
			}
			$i++;
		?>

	@endforeach

</body></html>