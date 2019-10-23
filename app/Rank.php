<?php

namespace App;

use App\User;
use Illuminate\Database\Eloquent\Model;

class Rank extends Model
{
    protected $fillable = ['name'];

    public function users() {

        return $this->hasMany(User::class);

    }
}
