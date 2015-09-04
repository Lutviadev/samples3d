<?php

namespace App\Http\Controllers;

use App\Briefcase;
use App\Http\Controllers\Controller;
use App\Http\Requests;
use App\Http\Requests\TourRequest;
use App\Sandbox\Flash;
use App\Tag;
use App\Tour;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\File;
use yajra\Datatables\Datatables;

class TourController extends Controller
{
    /**
     * @var App\Tour
     */
    private $tour;

    /**
     * Create a new instance.
     *
     */
    public function __construct(Tour $tour)
    {
        $this->middleware('auth');

        $this->middleware('group');

        $this->tour = $tour;
    }

    /**
     * Display a listing of the resource.
     *
     * @return Response
     */
    public function index()
    {
        return view('tour.index');
    }

    /**
     * Datatable listing of the resource.
     *
     * @return Datatable
     */
    public function dataTable()
    {
        $tours = fromGroup('tour', $this->tour);

        return Datatables::of($tours)
            ->addColumn('briefcases', function ($tour)    { return getBriefcases($tour); })
            ->addColumn('action', function ($tour)
            {
                $permissionbnts = permissionsBnts('tour', $tour);
                return dataTableButtons('tour', $tour, $permissionbnts['update'], $permissionbnts['delete'], $permissionbnts['total'], $permissionbnts['index']); 
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
        $foldersnames = Self::getTourFolders();

        $allbriefcases = availableCases();

        $alltags = allTags(); //Sandbox::helpers

        return view('tour.create', compact('foldersnames','alltags','allbriefcases'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @return Response
     */
    public function store(TourRequest $request)
    {
        $tour = Tour::create($request->input());

        $tour->briefcases()->attach($request->input('briefcases'));

        manageTags($request->input('tags'), $tour, 'create'); //Sandbox::helpers

        manageImages($tour, $request->file('images'), $request->input('images'), 'create', 'storage/tourscovers/', 'simple'); 

        Flash::success();

        return redirect(route('tour_index'));
    }

    /**
     * Show the form for the specified resource can update.
     *
     * @param  int  $id
     * @return Response
     */
    public function show(Tour $tour)
    {
        $foldersnames = Self::getTourFolders();

        $briefcases = $tour->briefcases->lists('id')->toArray();

        $allbriefcases = availableCases(); //Sandbox::helpers

        $tags = resourseTags($tour); //Sandbox::helpers

        $alltags = allTags(); //Sandbox::helpers

        return view('tour.show', compact('tour','foldersnames','tags','alltags','briefcases','allbriefcases'));
    }

    /**
     * Form for editing the specified resource.
     *
     * @param  int  $id
     * @return Response
     */
    public function edit(Tour $tour)
    {
        $foldersnames = Self::getTourFolders();

        $briefcases = $tour->briefcases->lists('id')->toArray();

        $allbriefcases = availableCases(); //Sandbox::helpers

        $tags = resourseTags($tour); //Sandbox::helpers

        $alltags = allTags(); //Sandbox::helpers

        $images = $tour->images;

        return view('tour.edit', compact('tour','foldersnames','tags','alltags','briefcases','allbriefcases', 'images'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  int  $id
     * @return Response
     */
    public function update(Tour $tour, TourRequest $request)
    {
        $tour->fill($request->input())->save();

        if($request->input('briefcases') != null)
        {
            $tour->briefcases()->sync($request->input('briefcases'));
        }

        manageTags($request->input('tags'), $tour, 'edit'); //Sandbox::helpers

        manageImages($tour, $request->file('images'), $request->input('images'), 'edit', 'storage/tourscovers/', 'simple');

        Flash::success();

        return redirect(route('tour_index'));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return Response
     */
    public function destroy(Tour $tour)
    {
        if(Auth::user()->level() >= 999 || Auth::user()->can('delete.tour') || Auth::user()->can('total.tour'))
        {
            $tour->delete();

            Flash::success();
        }
        else
        {
            Flash::danger();
        }

        return redirect(route('tour_index'));
    }

    /**
     * Get tours folders.
     *
     * @return array
     */
    private static function getTourFolders()
    {
        $directories = [];

        $tourfolder = public_path().'/storage/tours';

        $directorieslist = File::directories($tourfolder);

        foreach ($directorieslist as $directory)
        {
            $dirname = str_replace($tourfolder.'/', '', $directory);
            $directories[$dirname] = $dirname;
        }

        return $directories;
    }

}