<?php

namespace App\Http\Controllers;

use App\Briefcase;
use App\Http\Controllers\Controller;
use App\Http\Requests;
use App\Http\Requests\RenderRequest;
use App\Image;
use App\Maincategory;
use App\Render;
use App\Sandbox\Flash;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use yajra\Datatables\Datatables;

class RenderController extends Controller
{
    /**
     * @var App\Maincategory
     */
    private $render;

    /**
     * Create a new instance.
     *
     */
    public function __construct(Render $render)
    {
        $this->middleware('auth');

        $this->render = $render;
    }

    /**
     * Display a listing of the resource.
     *
     * @return Response
     */
    public function index()
    {
        removeSession('subcategory');

        return view('render.index');
    }

    /**
     * Datatable listing of the resource.
     *
     * @return Datatable
     */
    public function dataTable()
    {
        $renders = fromGroup('render', $this->render);

        return Datatables::of($renders)
            ->addColumn('briefcases', function ($render)    { return getBriefcases($render); })
            ->addColumn('maincategory', function ($render)  { return getCategoryname($render->maincategory_id, 'maincategory'); })
            ->addColumn('category',     function ($render)  { return getCategoryname($render->category_id, 'category'); })
            ->addColumn('subcategory',  function ($render)  { return getCategoryname($render->subcategory_id, 'subcategory'); })
            ->addColumn('action',       function ($render)
            {
                $permissionbnts = permissionsBnts('render', $render);
                return dataTableButtons('render', $render, $permissionbnts['update'], $permissionbnts['delete'], $permissionbnts['total'], $permissionbnts['index']); 
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
        $allbriefcases = availableCases();

        $maincategories = withEmpty(Maincategory::lists('name','id')->toArray());

        $categories = withEmpty( [] );

        $subcategories = withEmpty( [] );

        $alltags = allTags(); //Sandbox::helpers

        return view('render.create', compact('alltags','allbriefcases','maincategories','categories','subcategories'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @return Response
     */
    public function store(RenderRequest $request)
    {
        $files = $request->file('images');

        $images = $request->input('images');

        $render = Render::create($request->input());

        $render->briefcases()->attach($request->input('briefcases'));

        manageImages($render, $files, $images); //Sandbox::helpers

        Flash::success();

        return redirect(route('render_index'));
    }

    /**
     * Show the form for the specified resource can update.
     *
     * @param  int  $id
     * @return Response
     */
    public function show($id)
    {
        $render = Render::find($id);

        $briefcases = $render->briefcases->lists('id')->toArray();

        $allbriefcases = availableCases(); //Sandbox::helpers

        $maincategories = withEmpty(Maincategory::lists('name','id')->toArray());

        $images = $render->images;

        $alltags = allTags(); //Sandbox::helpers

        $categories = withEmpty( [] );

        $subcategories = withEmpty( [] );

        return view('render.show', compact('render','maincategories','categories','subcategories','briefcases','allbriefcases','alltags','images'));
    }

    /**
     * Form for editing the specified resource.
     *
     * @param  int  $id
     * @return Response
     */
    public function edit(Render $render)
    {
        $briefcases = $render->briefcases->lists('id')->toArray();

        $allbriefcases = availableCases(); //Sandbox::helpers

        $maincategories = withEmpty(Maincategory::lists('name','id')->toArray());

        $images = $render->images;

        $alltags = allTags(); //Sandbox::helpers

        $categories = withEmpty( [] );

        $subcategories = withEmpty( [] );

        return view('render.edit', compact('render','maincategories','categories','subcategories','briefcases','allbriefcases','alltags','images'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  int  $id
     * @return Response
     */
    public function update(Render $render, RenderRequest $request)
    {
        //dd($request);

        $files = $request->file('images');

        $images = $request->input('images');

        $render->fill($request->input())->save();

        if($request->input('briefcases') != null)
        {
            $render->briefcases()->sync($request->input('briefcases'));
        }

        manageImages($render, $files, $images, 'edit');

        Flash::success();

        return redirect(route('render_index'));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return Response
     */
    public function destroy(Render $render)
    {
        if(Auth::user()->level() >= 999 || Auth::user()->can('delete.render') || Auth::user()->can('total.render'))
        {
            $render->delete();

            Flash::success();
        }
        else
        {
            Flash::danger();
        }

        return redirect(route('render_index'));
    }
}
