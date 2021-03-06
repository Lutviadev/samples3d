<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Maincategory extends Model
{
    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'maincategories';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = ['maincategory_id','name'];

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
     * Get renders
     *
     * @return \Illuminate\Database\Eloquent\Relations\hasMany
     */
    public function renders()
    {
        return $this->hasMany(Render::class);
    }
}