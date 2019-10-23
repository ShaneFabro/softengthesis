<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class UseOfTechnology extends Model
{
    protected $fillable = [
        'subjects_taught',
        'user_id',
        'yes_no',
        'nature_it_used',
        'validate'
    ];

    public function user() {

        return $this->belongsTo(User::class);

    }
}
