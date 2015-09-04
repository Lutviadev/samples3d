<?php

namespace App\Http\Controllers;

use App\Animation;
use App\Briefcase;
use App\Http\Controllers\Controller;
use App\Http\Requests;
use App\Http\Requests\AnimationRequest;
use App\Sandbox\Flash;
use App\Tag;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use yajra\Datatables\Datatables;

class AnimationController extends Controller
{

    /**
     * @var App\Animation
     */
    private $animation;

    /**
     * Create a new instance.
     *
     */
    public function __construct(Animation $animation)
    {
        $this->middleware('auth');

        $this->middleware('group');

        $this->animation = $animation;
    }

    /**
     * Display a listing of the resource.
     *
     * @return Response
     */
    public function index()
    {
        return view('animation.index');
    }

    /**
     * Datatable listing of the resource.
     *
     * @return Datatable
     */
    public function dataTable()
    {
        $animations = fromGroup('animation', $this->animation);

        return Datatables::of($animations)
            ->addColumn('briefcases', function ($animation)    { return getBriefcases($animation); })
            ->addColumn('action', function ($animation)
            {
                $permissionbnts = permissionsBnts('animation', $animation);
                return dataTableButtons('animation', $animation, $permissionbnts['update'], $permissionbnts['delete'], $permissionbnts['total'], $permissionbnts['index']); 
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
        $alltags = allTags(); //Sandbox::helpers

        $allbriefcases = availableCases(); //Sandbox::helpers

        return view('animation.create', compact('alltags','allbriefcases'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @return Response
     */
    public function store(AnimationRequest $request)
    {
        $animation = Animation::create($request->input());

        $animation->briefcases()->attach($request->input('briefcases'));

        manageTags($request->input('tags'), $animation, 'create'); //Sandbox::helpers

        manageImages($animation, $request->file('images'), $request->input('images'), 'create', 'storage/animationcovers/', 'simple');   

        Flash::success();

        return redirect(route('animation_index'));
    }

    /**
     * Show the form for the specified resource can update.
     *
     * @param  int  $id
     * @return Response
     */
    public function show(Animation $animation)
    {
        $briefcases = $animation->briefcases->lists('id')->toArray();

        $allbriefcases = availableCases(); //Sandbox::helpers

        $tags = resourseTags($animation); //Sandbox::helpers

        $alltags = allTags(); //Sandbox::helpers

        $images = $animation->images;

        return view('animation.show', compact('animation','tags','alltags','briefcases','allbriefcases', 'images'));
    }

    /**
     * Form for editing the specified resource.
     *
     * @param  int  $id
     * @return Response
     */
    public function edit(Animation $animation)
    {
        $briefcases = $animation->briefcases->lists('id')->toArray();

        $allbriefcases = availableCases(); //Sandbox::helpers

        $tags = resourseTags($animation); //Sandbox::helpers

        $alltags = allTags(); //Sandbox::helpers

        $images = $animation->images;

        return view('animation.edit', compact('animation','tags','alltags','briefcases','allbriefcases', 'images'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  int  $id
     * @return Response
     */
    public function update(AnimationRequest $request, Animation $animation)
    {
        $animation->fill($request->input())->save();

        $files = $request->file('images');

        $images = $request->input('images');

        if($request->input('briefcases') != null)
        {
            $animation->briefcases()->sync($request->input('briefcases'));
        }

        manageTags($request->input('tags'), $animation, 'edit'); //Sandbox::helpers

        manageImages($animation, $request->file('images'), $request->input('images'), 'edit', 'storage/animationcovers/', 'simple');

        Flash::success();

        return redirect(route('animation_index'));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return Response
     */
    public function destroy(Animation $animation)
    {
        if(Auth::user()->level() >= 999 || Auth::user()->can('delete.animation') || Auth::user()->can('total.animation'))
        {
            $animation->delete();
            Flash::success();
        }
        else
        {
            Flash::danger();
        }

        return redirect(route('animation_index'));
    }

}