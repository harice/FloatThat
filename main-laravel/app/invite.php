<?php namespace App;

use Illuminate\Database\Eloquent\Model;

class Invite extends Model {
    protected $table = 'invites';

    protected $fillable = [
        'user_id', 'float_id', 'sent_by', 'code',
        'email_address', 'accepted', 'declined'
    ];

    protected $hidden = ['status', 'type'];
}
