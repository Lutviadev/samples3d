<?php

namespace App;

use App\Briefcase;
use App\Image;
use Illuminate\Database\Eloquent\Model;

class Render extends Model
{
        /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'renders';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = ['maincategory_id', 'category_id', 'subcategory_id', 'name' , 'enviroment'];

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
     * Render belongs to many Briefcases
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsToMany
     */
    public function briefcases()
    {
        return $this->belongsToMany(Briefcase::class)->withTimestamps();
    }

    /**
     * Render get associated many images
     *
     * @return \Illuminate\Database\Eloquent\Relations\belongsToMany 
     */
    public function images()
    {
        return $this->belongsToMany(Image::class)->withTimestamps();
    }
}
