<?php

namespace App\Http\Controllers;

use App\Briefcase;
use App\Http\Controllers\Controller;
use App\Http\Requests;
use App\Http\Requests\BriefcaseRequest;
use App\Sandbox\Flash;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Route;
use yajra\Datatables\Datatables;

class BriefcaseController extends Controller
{

    /**
     * @var App\Briefcase
     */
    private $briefcase;

    /**
     * Create a new instance.
     *
     * @return void
     */
    public function __construct(Briefcase $briefcase)
    {
        $this->middleware('auth');

        $this->middleware('topusers');

        $this->briefcase = $briefcase;
    }

    /**
     * Display a listing of the resource.
     *
     * @return Response
     */
    public function index()
    {
        return view('briefcase.index');
    }

    /**
     * Datatable listing of the resource.
     *
     * @return Datatable
     */
    public function dataTable()
    {
        $briefcases = Briefcase::orderBy('id', 'desc')->get();

        return Datatables::of($briefcases)
            ->addColumn('action', function ($briefcase){ return dataTableButtons('briefcase', $briefcase); })
            ->make(true);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return Response
     */
    public function create()
    {
        return view('briefcase.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @return Response
     */
    public function store(BriefcaseRequest $request)
    {
        $briefcase = Briefcase::create($request->input());

        Flash::success();

        return redirect(route('briefcase_index'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return Response
     */
    public function edit(Briefcase $briefcase)
    {
        return view('briefcase.edit', compact('briefcase'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  int  $id
     * @return Response
     */
    public function update(BriefcaseRequest $request, Briefcase $briefcase)
    {
        $briefcase->fill($request->input())->save();

        Flash::success();

        return redirect(route('briefcase_index'));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return Response
     */
    public function destroy(Briefcase $briefcase)
    {
        if(Auth::user()->level() >= 999 || Auth::user()->can('delete.briefcase') || Auth::user()->can('total.briefcase'))
        {
            $briefcase->delete();
            Flash::success();
        }
        else
        {
            Flash::danger();
        }

        return redirect(route('briefcase_index'));
    }

}
