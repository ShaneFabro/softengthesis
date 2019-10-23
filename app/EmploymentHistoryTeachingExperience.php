<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class EmploymentHistoryTeachingExperience extends Model
{
    protected $fillable = [
        'user_id',
        'institution',
        'subject_taught',
        'period_of_employment_from',
        'period_of_employment_to',
        'academic_rank',
        'validate'
    ];

    public function user() {

        return $this->belongsTo(User::class);

    }
}
