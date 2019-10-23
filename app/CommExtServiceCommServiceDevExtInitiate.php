<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class CommExtServiceCommServiceDevExtInitiate extends Model
{
    protected $fillable = [
        'user_id',
        'inclusive_date_from',
        'inclusive_date_to',
        'title',
        'role',
        'validate'
    ];

    public function user() {

        return $this->belongsTo(User::class);

    }
}