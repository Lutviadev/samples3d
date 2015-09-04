<?php

namespace App;

use App\Animation;
use App\Render;
use App\Tag;
use App\Tour;
use Illuminate\Database\Eloquent\Model;

class Image extends Model
{
        /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'images';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = ['title','description','path'];

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
     * Image belongs to one Render
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function render()
    {
        return $this->belongsToMany(Render::class)->withTimestamps();
    }

    /**
     * Image belongs to one Tour
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function tour()
    {
        return $this->belongsToMany(Tour::class)->withTimestamps();
    }

    /**
     * Image belongs to one Tour
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function animation()
    {
        return $this->belongsToMany(Animation::class)->withTimestamps();
    }

    /**
     * Image get associated many Tags
     *
     * @return \Illuminate\Database\Eloquent\Relations\belongsToMany 
     */
    public function tags()
    {
    	return $this->belongsToMany(Tag::class)->withTimestamps();
    }

}