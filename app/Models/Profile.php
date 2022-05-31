<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Profile extends Model
{
    use HasFactory, SoftDeletes;

    public function users(){
        return $this->belongsToMany(User::class);
    }

    public function turns(){
        return $this->belongsToMany(Turn::class);
    }

    public function profilable(){
        return $this->morphTo();
    }

    public function documents(){
        return $this->hasMany(Document::class);
    }
}
