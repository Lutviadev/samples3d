<?php

namespace App\Http\Requests;

use App\Http\Requests\Request;
use Illuminate\Support\Facades\Auth;

class SubcategoryRequest extends Request
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        /*$user = Auth::user(); 

        if ( $user->level() >= 999 || $user->can('create.subcategory') )
        { 
            return true;            
        } 
        else
        {            
            return false;
        }*/

        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        sessionRequest($this->input(),'subcategory');

        switch($this->method())
        {            
            case 'POST':
            {
                return [
                    'maincategory_id' => 'required',
                    'category_id' => 'required',
                    'name' => 'required|max:255|unique:subcategories,name,NULL,id,maincategory_id,'.$this->input('maincategory_id').',category_id,'.$this->input('category_id')              
                ];
            }
            case 'PATCH':
            {
                return [
                    'maincategory_id' => 'required',
                    'category_id' => 'required',
                    'name' => 'required|max:255|unique:subcategories,name,'.$this->route()->parameter('subcategory')->id.',id,maincategory_id,'.$this->input('maincategory_id').',category_id,'.$this->input('category_id')
                ];
            }
        } 
    }

    /**
     * Return if user not have requiere permissions.
     *
     * @return Redirect
     */
    public function forbiddenResponse()
    {
        session()->flash('flashmessage.danger', 'You need permission to perform this action!');
        return Redirect::back();
    }
}
