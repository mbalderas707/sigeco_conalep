<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Department extends Model
{
    use HasFactory,SoftDeletes;

    protected $fillable = [
        'name',
        'acronym'
    ];

    public function positions()
    {
        return $this->hasMany(Position::class);
    }

    public function profile()
    {
        return $this->morphOne(Profile::class,'profilable');
    }
}
