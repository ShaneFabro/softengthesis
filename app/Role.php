<?php

namespace App;

use App\User;
use Illuminate\Database\Eloquent\Model;

class Role extends Model
{
    protected $fillable = ['rolename'];

    public function users() {

        return $this->hasMany(User::class);

    }
}
