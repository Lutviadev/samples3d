<?php

namespace App\Http\Requests;

use App\Http\Requests\Request;
use Illuminate\Support\Facades\Auth;

class CategoryRequest extends Request
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        $user = Auth::user();

        /*if ( $user->level() >= 999 || $user->can('create.category') )
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
        switch($this->method())
        {            
            case 'POST':
            {
                return [
                    'maincategory_id' => 'required',
                    'name' => 'required|max:255|unique:categories,name,NULL,id,maincategory_id,'.$this->input('maincategory_id')              
                ];
            }
            case 'PATCH':
            {
                return [
                    'maincategory_id' => 'required',
                    'name' => 'required|max:255|unique:categories,name,'.$this->route()->parameter('category')->id.',id,maincategory_id,'.$this->input('maincategory_id')
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
