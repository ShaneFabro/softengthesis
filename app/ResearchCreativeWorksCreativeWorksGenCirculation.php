<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ResearchCreativeWorksCreativeWorksGenCirculation extends Model
{
    protected $fillable = [
        'user_id',
        'nature_of_publication',
        'date_publication',
        'role_comments',
        'validate'
    ];

    public function user() {

        return $this->belongsTo(User::class);

    }
}
