<?php

namespace App\Http\Controllers;

use App\Category;
use App\Http\Controllers\Controller;
use App\Http\Requests;
use App\Http\Requests\CategoryRequest;
use App\Maincategory;
use App\Sandbox\Flash;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use yajra\Datatables\Datatables;

class CategoryController extends Controller
{
    /**
     * @var App\Maincategory
     */
    private $category;

    /**
     * Create a new instance.
     *
     */
    public function __construct(Category $category)
    {
        $this->middleware('auth');

        $this->middleware('topusers');

        $this->category = $category;
    }

    /**
     * Display a listing of the resource.
     *
     * @return Response
     */
    public function index()
    {
        return view('render.category.index');
    }

    /**
     * Datatable listing of the resource.
     *
     * @return Datatable
     */
    public function dataTable()
    {
        $query = DB::select("SELECT maincategories.name as 'maincategory', categories.id, categories.name
                             FROM categories, maincategories
                             WHERE categories.maincategory_id = maincategories.id");

        $categories = $this->category->hydrate($query);

        return Datatables::of($categories)
            ->addColumn('action', function ($category){ return dataTableButtons('category', $category); })
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

        return view('render.category.create', compact('maincategories'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @return Response
     */
    public function store(CategoryRequest $request)
    {
        $category = Category::create($request->input());

        Flash::success();

        return redirect(route('category_index'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return Response
     */
    public function edit(Category $category)
    {
        $maincategories = withEmpty( Maincategory::lists('name', 'id')->toArray() );

        return view('render.category.edit', compact('category','maincategories'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  int  $id
     * @return Response
     */
    public function update(Category $category, CategoryRequest $request)
    {
        $category->fill($request->input())->save();

        Flash::success();

        return redirect(route('category_index'));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return Response
     */
    public function destroy(Category $category)
    {
        if(Auth::user()->level() >= 999 || Auth::user()->can('delete.category') || Auth::user()->can('total.category'))
        {
            $category->delete();

            Flash::success();
        }
        else
        {
            Flash::danger();
        }

        return redirect(route('category_index'));
    }
}