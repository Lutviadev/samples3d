<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Http\Requests;
use App\Portfolio;
use App\Tour;
use App\User;
use Illuminate\Http\Request;

class PortshowController extends Controller
{
     /**
     * @var App\Role
     */
    private $portfolio;

    /**
     * Create a new instance.
     *
     */
    public function __construct(Portfolio $portfolio)
    {
        $this->portfolio = $portfolio;
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return Response
     */
    public function show($slug)
    {

        $portfolio = Portfolio::whereSlug($slug)->first();

        $animationsimages = $portfolio->animationsimages;

        $toursimages = $portfolio->toursimages;

        $renderimages = $portfolio->rendersimages;

        $user = User::find($portfolio->user_id);

        if(isset($user->images[0]))
        {
            $logo = $user->images[0];
        }
        else
        {
            $logo = '';
        }

        $total = count($renderimages) + count($toursimages) + count($renderimages) ;

        return view('portfolio.show', compact('portfolio','animationsimages','toursimages','renderimages','logo','user','total'));        
    }

    public function tour($id)
    {
        $tour = Tour::find($id);

        return view('tour.proyect', compact('tour'));
    }
}
