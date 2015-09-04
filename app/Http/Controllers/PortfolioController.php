<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Http\Requests;
use App\Http\Requests\PortfolioRequest;
use App\Image;
use App\Maincategory;
use App\Portfolio;
use App\Sandbox\Flash;
use App\Tag;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use yajra\Datatables\Datatables;

class PortfolioController extends Controller
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
        $this->middleware('auth');

        $this->portfolio = $portfolio;
    }

    /**
     * Display a listing of the resource.
     *
     * @return Response
     */
    public function index()
    {
        return view('portfolio.index');
    }

    /**
     * Datatable listing of the resource.
     *
     * @return Datatable
     */
    public function dataTable()
    {
        if(Auth::user()->level() >= 999)
        {
            $portfolios = fromGroup('portfolio', $this->portfolio);
        }
        else
        {
            $portfolios = Auth::user()->portfolios;
        }

        return Datatables::of($portfolios)
            ->addColumn('user', function ($portfolio)
            {
                $user = User::find($portfolio->user_id);

                return $user->username;
            })
            ->addColumn('slug', function ($portfolio)
            {
                $html  = '<i class="glyphicon glyphicon-link"></i> Url: <a href="http://samples3d.com/portfolio/show/'.$portfolio->slug.'" target="_blank">samples3d.com/portfolio/show/'.$portfolio->slug.'</a>';
                $html .= '<br> <i class="glyphicon glyphicon-floppy-saved"></i> PDF: <a href="'.route('share_landscape',['portfolio' =>$portfolio->id]).'">Landscape</a>, <a href="'.route('share_portrait',['portfolio' =>$portfolio->id]).'">Portrait</a>';
                $html .= '<br> <i class="glyphicon glyphicon-qrcode"></i> Code: <a href="view-source:'.route('share_html',['portfolio' =>$portfolio->id]).'" target="_blank">Html</a>, <a href="'.route('share_mail',['portfolio' =>$portfolio->id]).'">Mail</a>';
                return $html;
            })
            ->addColumn('action', function ($portfolio)
            {
                $permissionbnts = permissionsBntsPort();
                return dataTableButtons('portfolio', $portfolio, $permissionbnts['update'], $permissionbnts['delete'], $permissionbnts['total'], $permissionbnts['index']);
            })
            ->make(true);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return Response
     */
    public function create()
    {
        $maincategories = withEmpty(Maincategory::lists('name','id')->toArray(), 'Select / Reset ...');
        $categories = withEmpty( [], 'All ...' );
        $subcategories = withEmpty( [], 'All ...' );

        $tagsrender = tipeTags('render');
        $tagstour   = tipeTags('tour');
        $tagsanim   = tipeTags('anim');

        $users = withEmpty( User::lists('username', 'id')->toArray());

        return view('portfolio.create', compact('users','maincategories','categories','subcategories','tagsrender','tagsanim','tagstour'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  Request  $request
     * @return Response
     */
    public function store(PortfolioRequest $request)
    {
        $portfolio = Portfolio::create($request->input());

        $portfolio->animationsimages()->attach($request->input('animations'));

        $portfolio->toursimages()->attach($request->input('tours'));

        $portfolio->rendersimages()->attach($request->input('renders'));

        Flash::success();

        return redirect(route('portfolio_index'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return Response
     */
    public function edit(Portfolio $portfolio)
    {
        $maincategories = withEmpty(Maincategory::lists('name','id')->toArray(), 'Select / Reset ...');
        $categories = withEmpty( [], 'All ...' );
        $subcategories = withEmpty( [], 'All ...' );

        $tagsrender = tipeTags('render');
        $tagstour   = tipeTags('tour');
        $tagsanim   = tipeTags('anim');

        $renders = $portfolio->rendersimages;
        $tours = $portfolio->toursimages;
        $animations = $portfolio->animationsimages;

        $rendermatrix = [];
        foreach ($renders as $render)
        {
            $rendermatrix[] = $render->id;
        }

        $tourmatrix = [];
        foreach ($tours as $tour)
        {
            $tourmatrix[] = $tour->id;
        }

        $animationmatrix = [];
        foreach ($animations as $animation)
        {
            $animationmatrix[] = $animation->id;
        }

        $users = withEmpty( User::lists('username', 'id')->toArray());

        return view('portfolio.edit', compact('users','portfolio','maincategories','categories','subcategories','tagsrender','tagsanim','tagstour','renders','tours','animations','rendermatrix','tourmatrix','animationmatrix'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  Request  $request
     * @param  int  $id
     * @return Response
     */
    public function update(Portfolio $portfolio, PortfolioRequest $request)
    {
        $portfolio->fill($request->input())->save();

        $portfolio->animationsimages()->sync($request->input('animations'));

        $portfolio->toursimages()->sync($request->input('tours'));

        $portfolio->rendersimages()->sync($request->input('renders'));

        Flash::success();

        return redirect(route('portfolio_index'));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return Response
     */
    public function destroy(Portfolio $portfolio)
    {
        if(Auth::user()->level() >= 999 || Auth::user()->can('delete.portfolio') || Auth::user()->can('total.portfolio'))
        {
            $portfolio->delete();

            Flash::success();
        }
        else
        {
            Flash::danger();
        }

        return redirect(route('portfolio_index'));
    }
}
