<?php namespace App;

use Illuminate\Database\Eloquent\Model;

class Product extends Model {

    /**
	 * The database table used by the model.
	 *
	 * @var string
	 */
	protected $table = 'products';

	/**
	 * The attributes that are mass assignable.
	 *
	 * @var array
	 */
	protected $fillable = [];

	/**
	 * The attributes excluded from the model's JSON form.
	 *
	 * @var array
	 */
	protected $hidden = ['status', 'type'];


    public function scopeActive($query) {
        $now = date("Y-m-d H:i:s");

        return $query->where('status', 0);
    }

}
