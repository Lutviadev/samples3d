<?php

namespace App\Http\Requests;

use App\Http\Requests\Request;
use App\Sandbox\Flash;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Redirect;

class AnimationRequest extends Request
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
                if ( $user->level() >= 999 || $user->can('create.animation') || $user->can('total.animation') )
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
                if ( $user->level() >= 999 || $user->can('update.animation') || $user->can('total.animation') )
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
        return [
            'title'         => 'required|max:255',
            'vimeo'         => 'required|max:255'
        ];
    }

    /**
     * Return if user not have requiere permissions.
     *
     * @return Redirect
     */
    public function forbiddenResponse()
    {
        Flash::danger();
        return Redirect::back();
    }

}
