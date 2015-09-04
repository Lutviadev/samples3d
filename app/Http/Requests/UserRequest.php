<?php

namespace App\Http\Requests;

use App\Http\Requests\Request;
use Bican\Roles\Models\Permission;
use Bican\Roles\Models\Role;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Redirect;

class UserRequest extends Request
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        $user = Auth::user();

        if ( $user->level() >= 999 || $user->can('create.user') )
        {
            return true;
        }
        else
        {
            return false;
        }
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
                    'username'  => 'required|max:255|unique:users,username',
                    'email'     => 'required|email|unique:users,email',
                    'password'  => 'required|min:3|confirmed'
                ];
            }
            case 'PATCH':
            {
                return [
                    'username'  => 'required|max:255|unique:users,username,'.$this->route()->parameter('user')->id,
                    'email'     => 'required|email|unique:users,email,'.$this->route()->parameter('user')->id,
                    'password'  => 'confirmed'
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
