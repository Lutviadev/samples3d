<?php

namespace App;

use App\Animation;
use App\Render;
use App\Tour;
use Bican\Roles\Models\Role;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\DB;

class Briefcase extends Model
{
    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'briefcases';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = ['name'];

    /**
     * The attributes excluded from the model's JSON form.
     *
     * @var array
     */
    protected $hidden = [];

    /**
     * Allow timestamps updated automatically
     *
     * @var boolean
     */
    public $timestamps = true;

    /**
     * Allow soft deletes
     *
     * @var array
     */
    protected $dates = ['deleted_at'];

    /**
     * An brifcase belongs to many roles.
     *
     * @return \Illuminate\Database\Eloquent\Relations\belongsToMany
     */
    public function roles()
    {
        return $this->belongsToMany(Role::class);
    }

    /**
     * An brifcase belongs to many roles.
     *
     * @return \Illuminate\Database\Eloquent\Relations\belongsToMany
     */
    public function tours()
    {
        return $this->belongsToMany(Tour::class)->orderBy('id', 'desc');
    }

    /**
     * An brifcase belongs to many roles.
     *
     * @return \Illuminate\Database\Eloquent\Relations\belongsToMany
     */
    public function animations()
    {
        return $this->belongsToMany(Animation::class)->orderBy('id', 'desc');
    }

    /**
     * An brifcase belongs to many roles.
     *
     * @return \Illuminate\Database\Eloquent\Relations\belongsToMany
     */
    public function renders()
    {
        return $this->belongsToMany(Render::class)->orderBy('id', 'desc');
    }
}
