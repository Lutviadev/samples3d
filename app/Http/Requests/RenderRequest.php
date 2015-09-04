<?php

namespace App\Http\Requests;

use App\Http\Requests\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Redirect;

class RenderRequest extends Request
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        $user = Auth::user(); 

        switch($this->method())
        {            
            case 'POST':
            {
                if ( $user->level() >= 999 || $user->can('create.render') || $user->can('total.render') )
                { 
                    return true;
                } 
                else
                {
                    return false;
                }
            }
            case 'PATCH':
            {
                if ( $user->level() >= 999 || $user->can('update.render') || $user->can('total.render') )
                { 
                    return true;            
                } 
                else
                {
                    return false;
                }
            }
        }
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
                    'subcategory_id' => 'required',
                    'name' => 'required|max:255|unique:renders,name,NULL,id,maincategory_id,'.$this->input('maincategory_id').',category_id,'.$this->input('category_id').',subcategory_id,'.$this->input('subcategory_id')              
                ];
            }
            case 'PATCH':
            {
                return [
                    'maincategory_id' => 'required',
                    'category_id' => 'required',
                    'subcategory_id' => 'required',
                    'name' => 'required|max:255|unique:renders,name,'.$this->route()->parameter('render')->id.',id,maincategory_id,'.$this->input('maincategory_id').',category_id,'.$this->input('category_id').',subcategory_id,'.$this->input('subcategory_id')
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
