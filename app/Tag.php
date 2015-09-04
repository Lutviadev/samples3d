<?php

namespace App;

use App\Animation;
use App\Image;
use App\Tour;
use Illuminate\Database\Eloquent\Model;

class Tag extends Model
{
    
    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'tags';

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
     * Tags get associated many animations
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsToMany 
     */
    public function animantions()
    {
    	return $this->belongsToMany(Animation::class);
    }

    /**
     * Tags get associated many images
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsToMany 
     */
    public function images()
    {
        return $this->belongsToMany(Image::class);
    }

    /**
     * Tags get associated many tours
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsToMany 
     */
    public function tours()
    {
        return $this->belongsToMany(Tour::class);
    }
    
}