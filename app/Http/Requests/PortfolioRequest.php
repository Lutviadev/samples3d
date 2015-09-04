<?php

namespace App\Http\Requests;

use App\Http\Requests\Request;
use App\Portfolio;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Redirect;

class PortfolioRequest extends Request
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
                if ( $user->level() >= 999 || $user->can('create.portfolio') || $user->can('total.portfolio') )
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
                if ( $user->level() >= 999 || $user->can('update.portfolio') || $user->can('total.portfolio') )
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
        switch($this->method())
        {            
            case 'POST':
            {
                $this->addUser();
                $this->checkArray();

                return [
                    'color'         => 'required',
                    'title'         => 'required|max:255',
                    'phase1'        => 'required|max:255',
                    'phase2'        => 'required|max:255',
                    'slug'          => 'required|max:255|unique:portfolios,slug'
                ];
            }
            case 'PATCH':
            {
                $this->checkArray();

                return [
                    'color'         => 'required',
                    'title'         => 'required|max:255',
                    'phase1'        => 'required|max:255',
                    'phase2'        => 'required|max:255',
                    'slug'          => 'required|max:255|unique:portfolios,slug,'.$this->route()->parameter('portfolio')->id,
                ];
            }
        } 
    }

    /**
     * Add slug input to current request.
     *
     * @return string
     */
    private function addUser()
    {
        if($this->user_id == null || $this->user_id == '')
        {
            return $this->merge(['user_id' => Auth::user()->id]);   
        }
    }  


    /**
     * Add slug input to current request.
     *
     * @return string
     */
    private function checkArray()
    {            
        if($this->renders == null)
        {
            $renders = [];   
        }
        else
        {
            $renders = $this->renders;
        }

        if($this->tours == null)
        {
            $tours = [];   
        }
        else
        {
            $tours = $this->tours;
        }

        if($this->animations == null)
        {
            $animations = [];   
        }
        else
        {
            $animations = $this->animations;  
        }

        return $this->merge(['renders' => $renders, 'tours' => $tours, 'animations' => $animations]);   
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
