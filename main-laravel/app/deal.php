<?php namespace App;

use Illuminate\Database\Eloquent\Model;
use Auth;

class Deal extends Model {

    /**
	 * The database table used by the model.
	 *
	 * @var string
	 */
	protected $table = 'deals';

	/**
	 * The attributes that are mass assignable.
	 *
	 * @var array
	 */
	protected $fillable = [
        'user_id',
        'name', 'description','ods', 'image_path', 'price', 'completed', 'from_product',
        'start_date', 'end_date',
        'status', 'type'
    ];

	/**
	 * The attributes excluded from the model's JSON form.
	 *
	 * @var array
	 */
    protected $hidden = ['status', 'type'];

    public function scopeActive($query) {
        $now = date("Y-m-d H:i:s");

        return $query->where('start_date', '>', $now)
            ->where('end_date', '<', $now);
    }

    public function scopeOpen($query) {
        return $query->where('type', 0)
            ->where('status', 0)
            ->where('completed', 0);

    }

    public function scopeUserDeals($query) {
        return $query->where('user_id', Auth::user()->id);
    }

}
