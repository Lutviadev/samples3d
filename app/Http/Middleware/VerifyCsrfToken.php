<?php

namespace App\Http\Middleware;

use Illuminate\Foundation\Http\Middleware\VerifyCsrfToken as BaseVerifier;

class VerifyCsrfToken extends BaseVerifier
{
    /**
     * The URIs that should be excluded from CSRF verification.
     *
     * @var array
     */
    protected $except = 
    [
        'get-categories',
        'get-subcategories',
        'ajax-table-group',
    	'ajax-table-briefcase',
    	'ajax-table-user',
        'ajax-table-animation',
        'ajax-table-tour',
        'ajax-table-maincategory',
        'ajax-table-category',
        'ajax-table-subcategory',
        'ajax-table-render',
        'ajax-table-portfolios',
        'render-search',
        'tour-search',
        'animation-search',
        'get-vimeo'
    ];
}
