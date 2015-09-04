<?php

namespace App;

use App\Animation;
use App\Image;
use App\Tour;
use App\User;
use Illuminate\Database\Eloquent\Model;

class Portfolio extends Model
{
        /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'portfolios';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = ['title', 'user_id', 'phase1', 'phase2', 'color', 'social', 'slug'];

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
     * An portfolio is owned by a user.
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    /**
     * portfolios get associated many images
     *
     * @return \Illuminate\Database\Eloquent\Relations\belongsToMany
     */
    public function rendersimages()
    {
        return $this->belongsToMany(Image::class, 'portfolio_image_render')->withTimestamps();
    }

    /**
     * portfolios get associated many tours
     *
     * @return \Illuminate\Database\Eloquent\Relations\belongsToMany
     */
    public function toursimages()
    {
        return $this->belongsToMany(Image::class, 'portfolio_image_tour')->withTimestamps();
    }

    /**
     * portfolios get associated many animations
     *
     * @return \Illuminate\Database\Eloquent\Relations\belongsToMany
     */
    public function animationsimages()
    {
        return $this->belongsToMany(Image::class, 'animation_image_portfolio')->withTimestamps();
    }
}
