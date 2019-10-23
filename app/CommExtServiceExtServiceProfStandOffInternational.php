<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class CommExtServiceExtServiceProfStandOffInternational extends Model
{
    protected $fillable = [
        'user_id',
        'inclusive_years_from',
        'inclusive_years_to',
        'title',
        'position',
        'validate'
    ];

    public function user() {

        return $this->belongsTo(User::class);

    }
}
