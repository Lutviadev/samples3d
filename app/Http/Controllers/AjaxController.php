<?php

namespace App\Http\Controllers;

use App\Briefcase;
use App\Category;
use App\Http\Controllers\Controller;
use App\Image;
use App\Maincategory;
use App\Subcategory;
use App\Tag;
use Bican\Roles\Models\Permission;
use Bican\Roles\Models\Role;
use Illuminate\Support\Facades\Input;
use Request;

class AjaxController extends Controller
{
	/**
	 * Get Briefcase name
	 *
	 * @param Input $id
	 * @return json_encode name
	 */
    public function briefcaseName($id)
    {
    	$briefcase = Briefcase::find($id);
    	
		$return = ['name' => $briefcase->name];	

    	echo json_encode($return);
    }

    /**
	 * Get group briefcases
	 * @param Input $id
	 * @return json_encode briefcases
	 */
    public function getCollectionBriefcases(Role $group)
    {
    	$briefcases = [];	
	
		if(session()->get('session-group.name'))
		{
			foreach (session()->get('session-group.briefcases') as $key => $value) 
			{
				$briefcases[] = $value;
			}		
		}
		else
		{
			foreach ($group->permissions()->groupBy('description')->get() as $permission) 
			{
				$briefcases[] = $permission->description;
			}		
		}

		echo json_encode($briefcases);	
    }

    /**
	 * Get briefcases permissions
	 *
	 * @param Input $id
	 * @return json_encode permissions
	 */
    public function getCollectionPermissions(Role $group)
    {
    	$permissions = [];

		if(session()->get('session-group.name'))
		{
			foreach (session()->get('session-group.permissions') as $key => $values) 
			{				
				foreach ($values as $permission) 
				{
					if($key == Input::get('idbriefcase'))
					{
						$permissions[] = $permission;
					}
				}			
			}
		}
		else
		{
			foreach ($group->permissions->where('description', Input::get('idbriefcase')) as $permission) 
			{
				$clearslug = explode('.', $permission->slug);	
				$permissions[] = $clearslug['0'].'.'.$clearslug[1];	
			}
		}

		echo json_encode($permissions);	
    }

    /**
	 * Get Categories list
	 *
	 * @return json_encode name
	 */
    public function getCategories()
    {	
    	$categories = Category::where('maincategory_id', Input::get('idmain'))->get();    	
    	echo json_encode($categories);
    }    

    /**
	 * Get Subcategories list
	 *
	 * @return json_encode name
	 */
    public function getSubcategories()
    {	
    	$subcategories = Subcategory::where('maincategory_id', Input::get('idmain'))->where('category_id', Input::get('idcat'))->get();    	
    	echo json_encode($subcategories);
    }

    public function renderSearch()
    {               
        $tags = Input::get('tags') != null ? Input::get('tags') : [];

        if(Input::get('subcategory') != null && Input::get('subcategory') != '')
        {
        	$images = searchImages(Input::get('maincategory'),Input::get('category'),Input::get('subcategory'),$tags);
        }
        else
        {
        	if(Input::get('category') != null && Input::get('category') != '')
	        {
	        	$images = searchImages(Input::get('maincategory'),Input::get('category'),'',$tags);
	        }
	        else
	        {
	        	if(Input::get('maincategory') != null && Input::get('maincategory') != '')
		        {
		        	$images = searchImages(Input::get('maincategory'),'','',$tags);
		        }	
		        else
		        {
		        	$images = searchImages('','','',$tags);
		        }
	        }
        }        

        $data = [
        	'images' => $images,
        ];

    	echo json_encode($data);
    }

    public function tourSearch()
    {
    	$tags = Input::get('tags') != null ? Input::get('tags') : [];	

    	$images = search($tags, 'tour');

    	$data = [
        	'images' => $images,
        ];

    	echo json_encode($data);
    }

    public function  animationSearch()
    {
   	$tags = Input::get('tags') != null ? Input::get('tags') : [];	

    	$images = search($tags, 'anim');

    	$data = [
        	'images' => $images,
        ];

    	echo json_encode($data);
    }

    public function getVimeo()
    {
    	$image = Image::find(Input::get('id'));

    	$vimeo = $image->animation[0]->vimeo;

		$return = $vimeo;

    	echo $return;
    }

}