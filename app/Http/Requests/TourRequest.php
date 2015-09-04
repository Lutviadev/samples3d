<?php

namespace App\Http\Requests;

use App\Http\Requests\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Redirect;

class TourRequest extends Request
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
                if ( $user->level() >= 999 || $user->can('create.tour') || $user->can('total.tour') )
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
                if ( $user->level() >= 999 || $user->can('update.tour') || $user->can('total.tour') )
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
        $this->replace( clearTags($this->all()) );

        return [
            'title'         => 'required|max:255',
            'foldername'    => 'required'
        ];
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
