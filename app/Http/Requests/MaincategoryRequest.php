<?php

namespace App\Http\Requests;

use App\Http\Requests\Request;
use Illuminate\Support\Facades\Auth;

class MaincategoryRequest extends Request
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        $user = Auth::user(); 

        /**if ( $user->level() >= 999 || $user->can('create.maincategory') )
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
                    'name' => 'required|max:255|unique:maincategories,name'                 
                ];
            }
            case 'PATCH':
            {
                return [
                    'name' => 'required|max:255|unique:maincategories,name,'.$this->route()->parameter('maincategory')->id
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
