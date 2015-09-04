<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Http\Requests;
use App\Portfolio;
use Barryvdh\DomPDF\Facade as PDF;
use Illuminate\Filesystem\Filesystem;
use Illuminate\Http\Request;
use Response;

class SharesController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

	public function html(Portfolio $portfolio)
	{
		return view('portfolio.shares.html', compact('portfolio'));
	}

	public function mail(Portfolio $portfolio)
	{
		$fs = new Filesystem();

		$path = public_path().'/storage/temp/';

		$mail = view('portfolio.shares.html', compact('portfolio'));

		$fs->put($path.'mail.html', $mail);

		$headers = array(
      		'Content-Type: text/html',
	    );

	    return Response::download($path.'mail.html', 'mail.html', $headers);
	}

	public function portrait(Portfolio $portfolio)
	{
		$view = view('portfolio.shares.portrait', compact('portfolio'))->render();

		//return $view;

		$pdf = PDF::loadHTML($view)->setPaper('a4')->setOrientation('portrait');

		return $pdf->download('portrait.pdf');
	}

	public function landscape(Portfolio $portfolio)
	{
		$view = view('portfolio.shares.landscape', compact('portfolio'))->render();

		$pdf = PDF::loadHTML($view)->setPaper('a4')->setOrientation('landscape');

		return $pdf->download('landscape.pdf');
	}

}
