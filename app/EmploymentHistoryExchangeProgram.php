<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class EmploymentHistoryExchangeProgram extends Model
{
    protected $fillable = [
        'user_id',
        'institution',
        'inclusive_from',
        'inclusive_to',
        'position_title',
        'validate'
    ];

    public function user() {

        return $this->belongsTo(User::class);

    }
}
