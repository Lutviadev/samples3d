<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\User;

class Profile extends Model
{
    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'profiles';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
    	'firstname',
    	'lastname',
    	'phone',
    	'companyaddress',
    	'facebook',
    	'twitter',
    	'linkedin',
    	'web',
    	'company',
    	'companymail',
    	'companyphone',
    ];

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
     * An profile is owned by a user.
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function user()
    {
        return $this->belongsTo(User::class);
    }

}
