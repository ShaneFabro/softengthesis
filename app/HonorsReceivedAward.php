<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class HonorsReceivedAward extends Model
{
    protected $fillable = [
        'user_id',
        'from',
        'to',
        'nature_gov_exam',
        'grade',
        'validate'
    ];

    public function user() {

        return $this->belongsTo(User::class);

    }
}
