<?php

namespace App\Sandbox;

class Flash
{
 	
	/**
     * Store success flash message.
     *
     * @param  string   $message
     * @return session
     */
    public static function success($message = 'Task was successful!')
    {
        return session()->flash('flashmessage.success', $message);
    }   

    /**
     * Store danger flash message.
     *
     * @param  string   $message
     * @return session
     */
    public static function danger($message = 'You need permission to perform this action!')
    {
        return session()->flash('flashmessage.danger', $message);
    }     

    /**
     * Create new token.
     *
     * @return session _token
     */
    public static function token()
    {
        return session()->put('_token', sha1(microtime()));
    }     

}