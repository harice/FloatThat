<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Winner extends Model {

    protected $table = 'winners';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'user_id', 'float_id'
    ];

    /**
     * The attributes excluded from the model's JSON form.
     *
     * @var array
     */
    protected $hidden = [];

}
