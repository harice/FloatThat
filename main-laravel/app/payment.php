<?php namespace App;

use Illuminate\Database\Eloquent\Model;
use Auth;

class Payment extends Model {

    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'payments';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'user_id', 'float_id', 'authorization',
        'success', 'amount', 'status', 'type'
    ];

    /**
     * The attributes excluded from the model's JSON form.
     *
     * @var array
     */
    protected $hidden = [];

    public function scopeAuthorized($query) {
        return $query->where('success', true)
            ->where('status', 'AUTHORIZED')
            ->where('type', 0);
    }

}
