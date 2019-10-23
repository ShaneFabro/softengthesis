<?php

namespace App;

use App\User;
use Illuminate\Database\Eloquent\Model;

class PresentAcademic extends Model
{
    protected $fillable = [
        'user_id',
        'academic_rank',
        'employment_status',
        'year_appointed_in_ust',
        'num_of_years_in_ust',
        'pos_in_ust',
        'validate'
    ];

    public function user() {

        return $this->belongsTo(User::class);

    }
}
