<?php

namespace App\Http\Requests;

use App\Http\Requests\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Redirect;

class GroupRequest extends Request
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {      
        $user = Auth::user();    

        if ( $user->level() >= 999 || $user->can('create.briefcases') )
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
        $this->addSlugInput();
        
        sessionRequest($this->input(),'group');
        
        switch($this->method())
        {            
            case 'POST':
            {
                return [
                    'name'          => 'required|max:255|unique:roles,name',
                    'description'   => 'max:255',
                    'briefcases'    => 'required',
                    'permissions'   => 'required'
                ];
            }
            case 'PATCH':
            {
                return [
                    'name'          => 'required|max:255|unique:roles,name,'.$this->route()->parameter('group')->id,
                    'description'   => 'max:255',
                    'briefcases'    => 'required',
                    'permissions'   => 'required'
                ];
            }
        }        
    }

    /**
     * Add slug input to current request.
     *
     * @return string
     */
    private function addSlugInput()
    {
        return $this->merge(['slug' => str_replace( ' ', '', strtolower($this->name) )]);   
    }    
  
    /**
     * Set custom messages.
     *
     * @return array
     */
    public function messages()
    {
        return [
            'briefcases.required' => 'Please add at least one briefcase to this group !',
            'permissions.required' => 'Please add at least one permission to each briefcase !',
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
