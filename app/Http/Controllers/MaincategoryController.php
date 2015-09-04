<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Http\Requests;
use App\Http\Requests\MaincategoryRequest;
use App\Maincategory;
use App\Sandbox\Flash;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use yajra\Datatables\Datatables;

class MaincategoryController extends Controller
{
    /**
     * @var App\Maincategory
     */
    private $maincategory;

    /**
     * Create a new instance.
     *
     */
    public function __construct(Maincategory $maincategory)
    {
        $this->middleware('auth');

        $this->middleware('topusers');

        $this->maincategory = $maincategory;
    }

    /**
     * Display a listing of the resource.
     *
     * @return Response
     */
    public function index()
    {
        return view('render.maincategory.index');
    }

    /**
     * Datatable listing of the resource.
     *
     * @return Datatable
     */
    public function dataTable()
    {
        $maincategories = Maincategory::all();

        return Datatables::of($maincategories)
            ->addColumn('action', function ($maincategory){ return dataTableButtons('maincategory', $maincategory); })
            ->make(true);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return Response
     */
    public function create()
    {
        return view('render.maincategory.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @return Response
     */
    public function store(MaincategoryRequest $request)
    {
        $maincategory = Maincategory::create($request->input());

        Flash::success();

        return redirect(route('maincategory_index'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return Response
     */
    public function edit(Maincategory $maincategory)
    {
        return view('render.maincategory.edit', compact('maincategory'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  int  $id
     * @return Response
     */
    public function update(Maincategory $maincategory, MaincategoryRequest $request)
    {
        $maincategory->fill($request->input())->save();

        Flash::success();

        return redirect(route('maincategory_index'));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return Response
     */
    public function destroy(Maincategory $maincategory)
    {
        if(Auth::user()->level() >= 999 || Auth::user()->can('delete.maincategory') || Auth::user()->can('total.maincategory'))
        {
            $maincategory->delete();

            Flash::success();
        }
        else
        {
            Flash::danger();
        }

        return redirect(route('maincategory_index'));
    }
}
