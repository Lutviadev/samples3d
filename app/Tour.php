<?php

namespace App;

use App\Image;
use App\Tag;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Auth;

class Tour extends Model
{
    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'tours';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = ['title', 'foldername'];

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
     * Tour get associated many tags
     *
     * @return \Illuminate\Database\Eloquent\Relations\belongsToMany
     */
    public function tags()
    {
    	return $this->belongsToMany(Tag::class)->withTimestamps();
    }

    /**
     * Tour belongs to many Briefcases
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsToMany
     */
    public function briefcases()
    {
        return $this->belongsToMany(Briefcase::class)->withTimestamps();
    }

    /**
     * Tour get associated many images
     *
     * @return \Illuminate\Database\Eloquent\Relations\belongsToMany
     */
    public function images()
    {
        return $this->belongsToMany(Image::class)->withTimestamps();
    }
}