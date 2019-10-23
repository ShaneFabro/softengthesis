<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class NondegreetrainingCulturalEducTravel extends Model
{
    protected $fillable = [
        'user_id',
        'role',
        'seminar_workshop',
        'venue',
        'inclusive_date',
        'validate'
    ];
    
    public function user() {

        return $this->belongsTo(User::class);

    }
}
