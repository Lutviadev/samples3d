<?php

namespace App;

use App\Image;
use App\Tag;
use Illuminate\Database\Eloquent\Model;

class Animation extends Model
{
    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'animations';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = ['title', 'vimeo'];

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
     * Animation get associated tags
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function tags()
    {
    	return $this->belongsToMany(Tag::class)->withTimestamps();;
    }

    /**
     * Animation belongs to many Briefcases
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsToMany
     */
    public function briefcases()
    {
        return $this->belongsToMany(Briefcase::class)->withTimestamps();
    }

    /**
     * Animation get associated many images
     *
     * @return \Illuminate\Database\Eloquent\Relations\belongsToMany
     */
    public function images()
    {
        return $this->belongsToMany(Image::class)->withTimestamps();
    }
}
