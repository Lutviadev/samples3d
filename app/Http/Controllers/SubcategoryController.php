<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Http\Requests;
use App\Http\Requests\SubcategoryRequest;
use App\Maincategory;
use App\Sandbox\Flash;
use App\Subcategory;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use yajra\Datatables\Datatables;

class SubcategoryController extends Controller
{
    /**
     * @var App\Maincategory
     */
    private $subcategory;

    /**
     * Create a new instance.
     *
     */
    public function __construct(Subcategory $subcategory)
    {
        $this->middleware('auth');

        $this->middleware('topusers');

        $this->subcategory = $subcategory;
    }

    /**
     * Display a listing of the resource.
     *
     * @return Response
     */
    public function index()
    {
        removeSession('subcategory');

        return view('render.subcategory.index');
    }

    /**
     * Datatable listing of the resource.
     *
     * @return Datatable
     */
    public function dataTable()
    {
        $query = DB::select("SELECT maincategories.name as 'maincategory', categories.name as 'category', subcategories.id, subcategories.name
                             FROM categories, maincategories, subcategories
                             WHERE subcategories.maincategory_id = maincategories.id AND subcategories.category_id = categories.id");

        $subcategories = $this->subcategory->hydrate($query);

        return Datatables::of($subcategories)
            ->addColumn('action', function ($subcategory){ return dataTableButtons('subcategory', $subcategory); })
            ->make(true);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return Response
     */
    public function create()
    {
        $maincategories = withEmpty( Maincategory::lists('name', 'id')->toArray() );

        $categories = withEmpty( [] );

        return view('render.subcategory.create', compact('maincategories', 'categories'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @return Response
     */
    public function store(Subcategory $subcategory, SubcategoryRequest $request)
    {
        $subcategory = Subcategory::create($request->input());

        Flash::success();

        return redirect(route('subcategory_index'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return Response
     */
    public function edit(Subcategory $subcategory)
    {
        $maincategories = withEmpty( Maincategory::lists('name', 'id')->toArray() );

        $categories = withEmpty( [] );

        return view('render.subcategory.edit', compact('maincategories','categories','subcategory'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  int  $id
     * @return Response
     */
    public function update(Subcategory $subcategory, SubcategoryRequest $request)
    {
        $subcategory->fill($request->input())->save();

        Flash::success();

        return redirect(route('subcategory_index'));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return Response
     */
    public function destroy(Subcategory $subcategory)
    {
        if(Auth::user()->level() >= 999 || Auth::user()->can('delete.subcategory') || Auth::user()->can('total.subcategory'))
        {
            $subcategory->delete();

            Flash::success();
        }
        else
        {
            Flash::danger();
        }

        return redirect(route('subcategory_index'));
    }
}
