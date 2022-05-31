<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Comment extends Model
{
    use HasFactory, SoftDeletes;

    protected $fillable = [
        'text'
    ];

    public function turn(){
        return $this->belongsTo(Turn::class);
    }

    public function user(){
        return $this->belongsTo(User::class);
    }

    public function file(){
        return $this->morphOne(File::class, 'fileable');
    }


}
