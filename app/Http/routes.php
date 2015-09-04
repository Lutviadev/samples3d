<?php

use App\Animation;
use App\Briefcase;
use App\Category;
use App\Image;
use App\Maincategory;
use App\Portfolio;
use App\Profile;
use App\Render;
use App\Subcategory;
use App\Tag;
use App\Tour;
use App\User;
use Bican\Roles\Models\Permission;
use Bican\Roles\Models\Role;

use Illuminate\Support\Collection;

/*
|--------------------------------------------------------------------------
| Application Routes
|--------------------------------------------------------------------------
|
| Here is where you can register all of the routes for an application.
| It's a breeze. Simply tell Laravel the URIs it should respond to
| and give it the controller to call when that URI is requested.
|
*/

/*
 * Login
 */
Route::get('/', [ 'as' => 'auth', 'uses' => 'Auth\AuthController@getLogin' ]);

/*
 * Authentication
 */
Route::post('auth/login', ['as' => 'login', 'uses' => 'Auth\AuthController@postLogin']);
Route::get('auth/logout', ['as' => 'logout', 'uses' => 'Auth\AuthController@getLogout']);

/*
 * Dashboard
 */
Route::get('dashboard', ['middleware' => 'auth', 'as' => 'dashboard', 'uses' => 'DashboardController@index']);



/*
 |--------------------------------------------------------------------------
 | Resources
 |--------------------------------------------------------------------------
 */

Route::resource('user', 'UserController', [
    'names'  =>    [
        'index'    => 'user_index',
        'create'    => 'user_create',
        'store'    => 'user_store',
        'edit'        => 'user_edit',
        'update'    => 'user_update',
        'destroy'    => 'user_destroy'
    ],
    'except' => ['show']
]);

Route::group(['prefix' => 'group'], function ()
{
    Route::get('mass', ['middleware' => 'auth', 'as' => 'group_mass', 'uses' => 'GroupController@massAssign']);
});

Route::resource('group', 'GroupController', [
    'names'  =>    [
        'index'    => 'group_index',
        'create'    => 'group_create',
        'store'    => 'group_store',
        'edit'        => 'group_edit',
        'update'    => 'group_update',
        'destroy'    => 'group_destroy'
    ],
    'except' => ['show']
]);

Route::resource('briefcase', 'BriefcaseController', [
    'names'  =>    [
        'index'    => 'briefcase_index',
        'create'    => 'briefcase_create',
        'store'    => 'briefcase_store',
        'edit'        => 'briefcase_edit',
        'update'    => 'briefcase_update',
        'destroy'    => 'briefcase_destroy'
    ],
    'except' => ['show']
]);

Route::resource('animation', 'AnimationController', [
    'names'  =>    [
        'index'    => 'animation_index',
        'show'        => 'animation_show',
        'create'    => 'animation_create',
        'store'    => 'animation_store',
        'edit'        => 'animation_edit',
        'update'    => 'animation_update',
        'destroy'    => 'animation_destroy'
    ]
]);

Route::resource('tour', 'TourController', [
    'names'  =>    [
        'index'    => 'tour_index',
        'show'        => 'tour_show',
        'create'    => 'tour_create',
        'store'    => 'tour_store',
        'edit'        => 'tour_edit',
        'update'    => 'tour_update',
        'destroy'    => 'tour_destroy'
    ]
]);

Route::resource('render', 'RenderController', [
    'names'  =>    [
        'index'    => 'render_index',
        'create'    => 'render_create',
        'store'    => 'render_store',
        'edit'        => 'render_edit',
        'update'    => 'render_update',
        'destroy'    => 'render_destroy'
    ],
    'except' => ['show']
]);

Route::group(['prefix' => 'render'], function () {

    Route::get('show/{id}', ['as' => 'render_show', 'uses' => 'RenderController@show']);

    Route::resource('maincategory', 'MaincategoryController', [
        'names'  =>    [
            'index'    => 'maincategory_index',
            'create'    => 'maincategory_create',
            'store'    => 'maincategory_store',
            'edit'        => 'maincategory_edit',
            'update'    => 'maincategory_update',
            'destroy'    => 'maincategory_destroy'
        ],
        'except' => ['show']
    ]);

    Route::resource('category', 'CategoryController', [
        'names'  =>    [
            'index'    => 'category_index',
            'create'    => 'category_create',
            'store'    => 'category_store',
            'edit'        => 'category_edit',
            'update'    => 'category_update',
            'destroy'    => 'category_destroy'
        ],
        'except' => ['show']
    ]);

    Route::resource('subcategory', 'SubcategoryController', [
        'names'  =>    [
            'index'    => 'subcategory_index',
            'create'    => 'subcategory_create',
            'store'    => 'subcategory_store',
            'edit'        => 'subcategory_edit',
            'update'    => 'subcategory_update',
            'destroy'    => 'subcategory_destroy'
        ],
        'except' => ['show']
    ]);

});


Route::get('portfolio/show/{slug}', ['as' => 'portfolio_show', 'uses' => 'PortshowController@show']);
Route::get('portfolio/tour/{id}', ['as' => 'portfolio_tour', 'uses' => 'PortshowController@tour']);
Route::get('portfolio/animation/{id}', ['as' => 'portfolio_animation', 'uses' => 'PortshowController@animation']);
Route::resource('portfolio', 'PortfolioController', [
    'names'  =>    [
        'index'    => 'portfolio_index',
        'create'    => 'portfolio_create',
        'store'    => 'portfolio_store',
        'edit'        => 'portfolio_edit',
        'update'    => 'portfolio_update',
        'destroy'    => 'portfolio_destroy'
    ],
    'except' => ['show']
]);


/*
 |--------------------------------------------------------------------------
 | Model Bind
 |--------------------------------------------------------------------------
 */

/**
 * GroupController
 *
 * @param id $group
 * @return \Bican\Roles\Models\Role
 */
Route::bind('group', function ($group) { return Role::find($group); });

/**
 * UserController
 *
 * @param id $user
 * @return \App\User
 */
Route::bind('user', function ($user) { return User::find($user); });

/**
 * BriefcaseController
 *
 * @param id $briefcase
 * @return \App\Briefcase
 */
Route::bind('briefcase', function ($briefcase) { return Briefcase::find($briefcase); });

/**
 * AnimationController
 *
 * @param id $animation
 * @return \App\Animation
 */
Route::bind('animation', function ($animation) { return Animation::find($animation); });

/**
 * TourController
 *
 * @param id $tour
 * @return \App\Tour
 */
Route::bind('tour', function ($tour) { return Tour::find($tour); });

/**
 * MaincategoryController
 *
 * @param id $maincategory
 * @return \App\Maincategory
 */
Route::bind('maincategory', function ($maincategory) { return Maincategory::find($maincategory); });

/**
 * CategoryController
 *
 * @param id $category
 * @return \App\Category
 */
Route::bind('category', function ($category) { return Category::find($category); });

/**
 * SubcategoryController
 *
 * @param id $subcategory
 * @return \App\Subcategory
 */
Route::bind('subcategory', function ($subcategory) { return Subcategory::find($subcategory); });

/**
 * RenderController
 *
 * @param id $render
 * @return \App\Render
 */
Route::bind('render', function ($render) { return Render::find($render); });

/**
 * PortfolioController
 *
 * @param id $portfolio
 * @return \App\Portfolio
 */
Route::bind('portfolio', function ($portfolio) { return Portfolio::find($portfolio); });

/**
 * SharesController
 *
 * @param id $portfolio
 * @return \App\Portfolio
 */
Route::bind('shares', function ($portfolio) { return Portfolio::find($portfolio); });


/*
 |--------------------------------------------------------------------------
 | Ajax
 |--------------------------------------------------------------------------
 */

Route::post('briefcase-name/{id}', ['middleware' => 'auth', 'as' => 'briefcasename', 'uses' => 'AjaxController@briefcaseName']);
Route::post('get-collection-briefcases/{group}', ['middleware' => ['auth', 'topusers'], 'as' => 'getcollectionbriefcases', 'uses' => 'AjaxController@getCollectionBriefcases']);
Route::post('get-collection-permissions/{group}', ['middleware' => ['auth', 'topusers'], 'as' => 'getcollectionpermissions', 'uses' => 'AjaxController@getCollectionPermissions']);
Route::any('get-categories', ['as' => 'getcategories', 'uses' => 'AjaxController@getCategories']);
Route::any('get-subcategories', ['as' => 'getsubcategories', 'uses' => 'AjaxController@getSubcategories']);
Route::any('render-search', ['as' => 'render_search', 'uses' => 'AjaxController@renderSearch']);
Route::any('tour-search', ['as' => 'tour_search', 'uses' => 'AjaxController@tourSearch']);
Route::any('animation-search', ['as' => 'animation_search', 'uses' => 'AjaxController@animationSearch']);
Route::any('get-vimeo', ['as' => 'get_vimeo', 'uses' => 'AjaxController@getVimeo']);



/*
 |--------------------------------------------------------------------------
 | Datatables
 |--------------------------------------------------------------------------
 */

Route::post('ajax-table-group', ['as' => 'datatableGroup', 'uses' => 'GroupController@dataTable']);
Route::post('ajax-table-briefcase', ['as' => 'datatableBriefcase', 'uses' => 'BriefcaseController@dataTable']);
Route::post('ajax-table-user',    ['as' => 'datatableUser', 'uses' => 'UserController@dataTable']);
Route::post('ajax-table-animation', ['as' => 'datatableAnimation', 'uses' => 'AnimationController@dataTable']);
Route::post('ajax-table-tour', ['as' => 'datatableTour', 'uses' => 'TourController@dataTable']);
Route::post('ajax-table-maincategory', ['as' => 'datatableMaincategory', 'uses' => 'MaincategoryController@dataTable']);
Route::post('ajax-table-category',  ['as' => 'datatableCategory', 'uses' => 'CategoryController@dataTable']);
Route::post('ajax-table-subcategory',  ['as' => 'datatableSubcategory', 'uses' => 'SubcategoryController@dataTable']);
Route::post('ajax-table-render',  ['as' => 'datatableRender', 'uses' => 'RenderController@dataTable']);
Route::post('ajax-table-portfolios',  ['as' => 'datatablePortfolios', 'uses' => 'PortfolioController@dataTable']);



/*
 |--------------------------------------------------------------------------
 | MIGRATION
 |--------------------------------------------------------------------------
 */

Route::get('migrate-renders', ['middleware' => ['auth', 'topusers'], 'as' => 'migrate_renders', 'uses' => 'MigratorController@renders']);
Route::get('migrate-animations', ['middleware' => ['auth', 'topusers'], 'as' => 'migrate_animations', 'uses' => 'MigratorController@animations']);
Route::get('migrate-tours', ['middleware' => ['auth', 'topusers'], 'as' => 'migrate_tours', 'uses' => 'MigratorController@tours']);
Route::get('migrate-users', ['middleware' => ['auth', 'topusers'], 'as' => 'migrate_users', 'uses' => 'MigratorController@users']);


/*
 |--------------------------------------------------------------------------
 | IMAGES
 |--------------------------------------------------------------------------
 */

Route::group(['prefix' => 'thumb'], function ()
{
    Route::get('create/', ['as'=> "thumbroute", 'uses' => 'ThumbController@empty']);
    Route::get('create/{id}/', ['as'=> "thumb_full", 'uses' => 'ThumbController@create']);
    Route::get('create/{id}/{width}', ['as'=> "thumb_w", 'uses' => 'ThumbController@create']);
    Route::get('create/{id}/{height}', ['as'=> "thumb_h", 'uses' => 'ThumbController@create']);
    Route::get('create/{id}/{width}/{height}', ['as'=> "thumb_w_h", 'uses' => 'ThumbController@create']);
});


/*
 |--------------------------------------------------------------------------
 | Portfolio Shares
 |--------------------------------------------------------------------------
 */

Route::get('shares/landscape/{portfolio}', ['as'=> "share_landscape", 'uses' => 'SharesController@landscape']);
Route::get('shares/portrait/{portfolio}', ['as'=> "share_portrait", 'uses' => 'SharesController@portrait']);
Route::get('shares/html/{portfolio}', ['as'=> "share_html", 'uses' => 'SharesController@html']);
Route::get('shares/mail/{portfolio}', ['as'=> "share_mail", 'uses' => 'SharesController@mail']);


/*
 |--------------------------------------------------------------------------
 | TEST
 |--------------------------------------------------------------------------
 */

Route::get('test', function ()
{
    $index = 1;
    for ($t = 1; $t <= 3; $t++)
    {
        echo 't>'. $t .'-<br>';

        for ($x = 1; $x <= 2; $x++)
        {
            echo 'x>'. $x .'-<br>';
            echo 'index>'. $index .'-<br>';
            $index++;
        }
    }

});