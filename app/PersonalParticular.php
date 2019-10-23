<?php

namespace App;

use App\User;
use Illuminate\Database\Eloquent\Model;

class PersonalParticular extends Model
{
    protected $fillable = [
        'user_id',
        'firstname',
        'lastname',
        'fullname',
        'image',
        'age',
        'place_birth',
        'sex',
        'religion',
        'occupation',
        'address',
        'telephone',
        'mobilephone',
        'email',
        'birth',
        'citizenship',
        'marital_status',
        'spouse',
        'names_ages_of_children',
    ];

    public function user() {

        return $this->belongsTo(User::class);

    }
}
