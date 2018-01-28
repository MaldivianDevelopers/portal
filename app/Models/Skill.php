<?php

namespace App\Models;

use App\User;
use Illuminate\Database\Eloquent\Model;

class Skill extends Model
{

    protected $fillable = ['name', 'type', 'slug'];

    public function users() {
        return $this->belongsToMany(User::class);
    }
}
