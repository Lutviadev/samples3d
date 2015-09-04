<?php

use App\Animation;
use App\Briefcase;
use App\Category;
use App\Image;
use App\Maincategory;
use App\Render;
use App\Subcategory;
use App\Tag;
use App\Tour;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\Auth;


/*
 |--------------------------------------------------------------------------
 | BRIEFCASES
 |--------------------------------------------------------------------------
 */

/**
 * Get Briefcases
 *
 * @param  \App $resource
 *
 * @return string name
 */
function getBriefcases($resource)
{
    $brifcases = '';
    foreach ($resource->briefcases as $briefcase)
    {
        $brifcases .= '<span class="case">'.$briefcase->name.'</span>';
    }

    return $brifcases;
}

/*
 |--------------------------------------------------------------------------
 | TAGS
 |--------------------------------------------------------------------------
 */

/**
 * Get resourse Tags
 *
 * @var \App\*
 * @return array
 */

function tipeTags($tipe)
{
    $tags = [];

    $tagsids = [];

    switch ($tipe)
    {
        case 'render':
            $resources = Image::all();
            break;

        case 'anim':
            $resources = Animation::all();
            break;

        default:
            $resources = Tour::all();
            break;
    }

    foreach ($resources as $resource)
    {
        foreach ($resource->tags as $tag)
        {
            $tags[$tag->id] = trim(strtolower($tag->name));
        }
    }

    asort($tags);

    return $tags;
}

/**
 * Trim tags, and create array of tags
 *
 * @var Request
 * @return Request
 */
function clearTags($input)
{
    $cleantags = [];
    $tags = explode(',', $input['tags']);

    foreach ($tags as $tag)
    {
        $cleantags[] = trim($tag);
    }

    $input['tags'] = $cleantags;

    return $input;
}

/**
 * Get resourse Tags
 *
 * @var \App\*
 * @return string
 */
function resourseTags($resourse)
{
    $stringtags = '';
    $tags = $resourse->tags;

    foreach ($tags as $tag)
    {
        $stringtags .= $tag->name.',';
    }

    return $stringtags;
}

/**
 * Get all Tags
 *
 * @return json
 */
function allTags()
{
    return json_encode(Tag::lists('name'));
}

/**
 * Manage tags.
 *
 * @param  array  $tags
 * @param  \App\Tour  $tour
 * @param  string  $method
 */
function manageTags($tags, $resource, $method)
{
    $tagsarray = [];

    if(!is_array($tags))
    {
        $cleantags = [];
        $tags = explode(',', $tags);

        foreach ($tags as $tag)
        {
            $cleantags[] = trim($tag);
        }

        $tags = $cleantags;
    }

    foreach ($tags as $tag => $name)
    {
        $eltag = Tag::whereName($name)->first();

        if(count($eltag) != 0)
        {
            $newtag = $eltag;
        }
        else
        {
            $newtag = Tag::create(['name' => $name]);
        }

        $tagsarray[] = $newtag->id;
    }

    if($method == 'create')
    {
        $resource->tags()->attach($tagsarray);
    }
    else
    {
        $resource->tags()->sync($tagsarray);
    }
}

/*
 |--------------------------------------------------------------------------
 | DATATABLES
 |--------------------------------------------------------------------------
 */

/**
 * Get Edit and Delete permissions
 *
 * @param  \App resource
 * @return array
 */
function permissionsBnts($name, $resource)
{
    $update = false;
    $delete = false;
    $total = false;
    $index = false;

    foreach ($resource->briefcases as $briefcase)
    {
        $queryupdate = Auth::user()->getPermissions()->where('slug','update.'.$name)->where('description', $briefcase->id)->first();
        if($queryupdate != null)
        {
            $update = true;
        }

        $querydelete = Auth::user()->getPermissions()->where('slug','delete.'.$name)->where('description', $briefcase->id)->first();
        if($querydelete != null)
        {
            $delete = true;
        }

        $querytotal = Auth::user()->getPermissions()->where('slug','total.'.$name)->where('description', $briefcase->id)->first();
        if($querytotal != null)
        {
            $total = true;
        }

        $queryindex = Auth::user()->getPermissions()->where('slug','index.'.$name)->where('description', $briefcase->id)->first();
        if($queryindex != null)
        {
            $index = true;
        }
    }

    return ['update' => $update, 'delete' => $delete, 'total' => $total, 'index' => $index];
}

/**
 * Get Edit and Delete permissions
 *
 * @param  \App resource
 * @return array
 */
function permissionsBntsPort()
{
    $update = false;
    $delete = false;
    $total = false;
    $index = false;

    $queryupdate = Auth::user()->getPermissions()->where('slug','update.portfolio')->first();
    if($queryupdate != null)
    {
        $update = true;
    }

    $querydelete = Auth::user()->getPermissions()->where('slug','delete.portfolio')->first();
    if($querydelete != null)
    {
        $delete = true;
    }

    $querytotal = Auth::user()->getPermissions()->where('slug','total.portfolio')->first();
    if($querytotal != null)
    {
        $total = true;
    }

    $queryindex = Auth::user()->getPermissions()->where('slug','index.portfolio')->first();
    if($queryindex != null)
    {
        $index = true;
    }

    return ['update' => $update, 'delete' => $delete, 'total' => $total, 'index' => $index];
}

/**
 * Create Edit and Delete buttons
 *
 * @param  string $name
 * @param  \App resource
 * @param  bool $pdate
 * @param  bool $delete
 * @param  bool $total
 * @param  bool $index
 *
 * @return html
 */
function dataTableButtons($name, $resource, $update = false, $delete = false, $total = false, $index = false)
{
    $btns = '';

    if(Auth::user()->level() >= 999 || $total || $delete)
    {
        $btns .= Form::open(['method' => 'DELETE', 'route' => [$name.'_destroy', $resource->id], 'class' => 'delete-form']);
    }
    else
    {
        $btns .= '<div class="delete-form">';
    }

    if(Auth::user()->level() >= 999 || $total || $update)
    {
        $btns .=  '<a href="'.route($name.'_edit' ,[$name => $resource->id]).'" class="btn btn-xs btn-primary edit-form"><i class="glyphicon glyphicon-edit"></i> Edit</a>';
    }
    else
    {
        if(Auth::user()->level() >= 999 || $total || $index)
        {
            $btns .=  '<a href="'.route($name.'_show' ,[$name => $resource->id]).'" class="btn btn-xs btn-primary edit-form"><i class="glyphicon glyphicon-eye-open"></i> View</a>';        
        }
    }

    if(Auth::user()->level() >= 999 || $total || $delete)
    {
        $btns .= Form::submit("Delete", ['class' => 'delete-form-btn btn btn-xs btn-danger']);
    }

    if(Auth::user()->level() >= 999 || $total || $delete)
    {
        $btns .= Form::close();
    }
    else
    {
        $btns .= '</div>';
    }

    return $btns;
}

/**
 * Get permited resources.
 *
 * @param  \App  $resource
 *
 * @return  Collection
 */
function fromGroup($name, $resource)
{
    if(Auth::user()->level() >= 999)
    {
        $resource = $resource->orderBy('id', 'desc')->get();
    }
    else
    {
        $collection = new Collection;

        $permissions = [];

        $resource = [];

        $resourceids = [];

        $done = false;

        foreach (Auth::user()->roles[0]->briefcases as $briefcase)
        {
            switch ($name)
            {
                case 'tour':        $case = $briefcase->tours; break;
                case 'animation':   $case = $briefcase->animations; break;
                case 'render':      $case = $briefcase->renders; break;
            }

            $permissions[0] = Auth::user()->roles[0]->permissions->where('slug','index.'.$name)->where('description', $briefcase->id)->first();
            $permissions[1] = Auth::user()->roles[0]->permissions->where('slug','update.'.$name)->where('description', $briefcase->id)->first();
            $permissions[2] = Auth::user()->roles[0]->permissions->where('slug','delete.'.$name)->where('description', $briefcase->id)->first();
            $permissions[3] = Auth::user()->roles[0]->permissions->where('slug','total.'.$name)->where('description', $briefcase->id)->first();

            foreach ($permissions as $permission)
            {
                if(isset($permission->slug))
                {
                    foreach ($case as $source)
                    {
                        if(!in_array($source->id, $resourceids))
                        {
                            $resource[] = $source; $done = true;
                            $resourceids[] = $source->id;
                        }
                    }
                }
            }
        }

        $resource = $collection->merge($resource);
    }

    return $resource;
}

/*
 |--------------------------------------------------------------------------
 | SELECTS
 |--------------------------------------------------------------------------
 */

/**
 * Add Select empty value
 *
 * @param  array $selectList
 * @param  string $emptyLabel
 * @return array
 *
 */
function withEmpty($selectList, $emptyLabel = 'Please Select ...')
{
    return ['' => $emptyLabel] + $selectList;
}

/**
 * Create string for multiselect empty check.
 *
 * @param  array  $tags
 * @return  string
 */
function getMultifix($array)
{
    $string = '';

    foreach ($array as $text)
    {
        $string .= ','.$text;
    }

    return $string;
}

/*
 |--------------------------------------------------------------------------
 | SESSIONS
 |--------------------------------------------------------------------------
 */

/**
 * Store request in session.
 *
 * @param array
 * @param string
 */
function sessionRequest($array,$name)
{
    foreach ($array as $key => $value)
    {
        session()->put('session-'.$name.'.'.$key, $value);
    }
}

/**
 * Remove session-group
 *
 * @param string
 */
function removeSession($name)
{
    if(session()->get('session-'.$name))
    {
        return session()->remove('session-'.$name);
    }
}

/*
 |--------------------------------------------------------------------------
 | FILES
 |--------------------------------------------------------------------------
 */

/**
 * Manage multiple images.
 *
 * @param  array  $files
 * @param  array  $images
 * @param  string  $action
 * @param  string  $storage
 */
function manageImages($resource, $files, $images, $action = 'create', $storage = 'storage/renders/', $mode = 'multy')
{
    if($action != 'create' || $mode != 'multy')
    {
        $someimage = $images;
        unset($images[0]);
    }

    if($files != null && $files[0] != null)
    {
        foreach ($files as $file)
        {
            if(!file_exists(public_path().'/'.$storage.$file->getClientOriginalName()))
            {
                $file->move(public_path().'/'.$storage, $file->getClientOriginalName());
            }
        }

    }

    if($images != null)
    {
        foreach ($images as $image)
        {
            if(isset($image['name']))
            {
                $image['path'] = $storage.$image['name'];

                if(isset($image['tags']))
                {
                    $tags = explode(',', $image['tags']);
                }
                else
                {
                    $tags = [];
                }

                $img = Image::where('path', $image['path'])->get();

                if(isset($img->title))
                {
                    $img->fill($image)->save();

                    if(isset($image['tags']))
                    {
                        manageTags($tags, $img, 'edit'); //Sandbox::helpers
                    }
                }
                else
                {
                    $img = Image::create($image);

                    if(isset($image['tags']))
                    {
                        manageTags($tags, $img, 'create'); //Sandbox::helpers
                    }
                }

                $imageids[] = $img->id;
            }
        }

        if($action == 'create')
        {
            $resource->images()->attach($imageids);
        }
        else
        {
            $resource->images()->sync($imageids);
        }
    }
    else
    {
        if(count($someimage) <= 0)
        {
            $resource->images()->delete();
        }
    }
}

/*
 |--------------------------------------------------------------------------
 | PERMISSIONS
 |--------------------------------------------------------------------------
 */

/**
 * Gat action parsed for permission usage
 *
 * @param  string  $as
 * @param  string  $get
 *
 * @return  string
 */
function parseAction($as)
{
    $action = explode('_', $as);

    $index = $action[0].'_index';

    switch ($action[1])
    {
        case 'edit':
            $action[1] = 'update';
            break;

        case 'show':
            $action[1] = 'index';
            break;

        case 'store':
            $action[1] = 'create';
            break;

        case 'destroy':
            $action[1] = 'delete';
            break;
    }

    return $parse = [
        'name' => $action[0],
        'create' => 'create.'.$action[0],
        'update' => 'update.'.$action[0],
        'delete' => 'delete.'.$action[0],
        'action' => $action[1],
        'slug' => $action[1].'.'.$action[0],
        'total' => 'total.'.$action[0]
    ];
}

/*
 |--------------------------------------------------------------------------
 | HELPERS
 |--------------------------------------------------------------------------
 */

function bootBreakpoints()
{
    return '<div style="float:left;width:100%;padding:5px;background:#000;color:#FFF;text-align:right;">
                <div class="visible-xs">xs</div>
                <div class="visible-sm">sm</div>
                <div class="visible-md">md</div>
                <div class="visible-lg">lg</div>
            </div>';
}

/**
 * Get Category name
 *
 * @param  int $id
 * @param  string $type
 *
 * @return string name
 */
function getCategoryname($id, $type)
{
    switch ($type)
    {
        case 'maincategory':
            $cat = Maincategory::find($id);
            break;

        case 'category':
            $cat = Category::find($id);
            break;

        case 'subcategory':
            $cat = Subcategory::find($id);
            break;
    }

    return $cat->name;
}

function search($tags = [] , $tipe = '')
{
    $doit = true;

    $collection = new Collection;

    $images = [];

    $imageids = [];

    if($tipe == 'tour')
    {
        $query = Tour::all();
    }
    else
    {
        $query = Animation::all();
    }

    if($doit)
    {
        foreach ($query as $resource)
        {
            $arraysAreEqual = false;

            $tagcheck = [];

            $restags = $resource->tags->lists('id')->toArray();

            foreach ($tags as $tag)
            {
                $tagcheck[] = in_array($tag, $restags) ? true : false;
            }

            if(!in_array(false, $tagcheck))
            {
                $arraysAreEqual = true;
            }
            else
            {
                $arraysAreEqual = false;
            }

            if($arraysAreEqual)
            {
                $process = false;

                if(Auth::user()->level() >= 999)
                {
                    $process = true;
                }
                else
                {
                    $resourcecases = $resource->briefcases->lists('id')->toArray();
                    $usercases = Auth::user()->roles[0]->briefcases->lists('id')->toArray();

                    foreach ($usercases as $case)
                    {
                        if (in_array($case, $resourcecases))
                        {
                            $process = true;
                        }
                    }
                }

                if($process)
                {
                    foreach ($resource->images as $image)
                    {
                        foreach ($tags as $tag)
                        {

                            if(!in_array($image->id, $imageids))
                            {
                                $images[] = $image;
                                $imageids[] = $image->id;
                            }
                        }
                    }
                }

            }
        }
    }

    if($doit)
    {
        $images = $collection->merge($images);
        return $images;
    }
    else
    {
        return false;
    }
}

function searchImages($main = '', $cat = '', $sub = '', $tags = [])
{
    $collection = new Collection;

    $images = [];

    $imageids = [];

    $doit = true;

    if($sub != '')
    {
        $query = Render::where('maincategory_id', $main)->where('category_id', $cat)->where('subcategory_id', $sub)->get();
    }
    else
    {
        if($cat != '')
        {
            $query = Render::where('maincategory_id', $main)->where('category_id', $cat)->get();
        }
        else
        {
            if($main != '')
            {
                $query = Render::where('maincategory_id', $main)->get();
            }
            else
            {
                if(count($tags) >= 1)
                {
                    $query = Render::all();
                }
                else
                {
                    $doit = false;
                }
            }
        }
    }

    if($doit)
    {
        foreach ($query as $resource)
        {
            $process = false;

            if(Auth::user()->level() >= 999)
            {
                $process = true;
            }
            else
            {
                $resourcecases = $resource->briefcases->lists('id')->toArray();
                $usercases = Auth::user()->roles[0]->briefcases->lists('id')->toArray();

                foreach ($usercases as $case)
                {
                    if (in_array($case, $resourcecases))
                    {
                        $process = true;
                    }
                }
            }

            if($process)
            {
                if(count($tags) >= 1)
                {
                    foreach ($resource->images as $image)
                    {
                        $imagetags = $image->tags()->lists('id')->toArray();

                        $tagcheck = [];

                        foreach ($tags as $tag)
                        {
                            $tagcheck[] = in_array($tag, $imagetags) ? true : false;
                        }

                        if(!in_array($image->id, $imageids) && !in_array(false, $tagcheck))
                        {
                            $images[] = $image;
                            $imageids[] = $image->id;
                        }
                    }
                }
                else
                {
                    foreach ($resource->images as $image)
                    {
                        if(!in_array($image->id, $imageids))
                        {
                            $images[] = $image;
                            $imageids[] = $image->id;
                        }
                    }
                }
            }
        }
    }

    if($doit)
    {
        $images = $collection->merge($images);
        return $images;
    }
    else
    {
        return false;
    }

}

function availableCases()
{
    $user = Auth::user();

    if($user->level() >= 999)
    {
        $cases = Briefcase::lists('name','id')->toArray();
    }
    else
    {
        $cases = Auth::user()->roles[0]->briefcases->lists('name','id')->toArray();
    }

    return $cases;
}