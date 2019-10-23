<?php

namespace App;

use App\User;
use Illuminate\Database\Eloquent\Model;

class AcademicDegree extends Model
{
    protected $fillable = [
        'user_id',
        'degree',
        'school',
        'year_graduated',
        'validate'
    ];

    public function user() {

        return $this->belongsTo(User::class);

    }
}
