<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class EmploymentHistoryAdminisExperience extends Model
{
    protected $fillable = [
        'user_id',
        'institution',
        'period_of_employment_from',
        'period_of_employment_to',
        'position_title',
        'validate'
    ];

    public function user() {

        return $this->belongsTo(User::class);

    }
}
