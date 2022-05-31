<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Turn extends Model
{
    use HasFactory,SoftDeletes;

    protected $fillable = [
        'seen_since',
        'expiration',
    ];

    protected $casts = [
        'seen_since'=>'datetime',
        'expiration'=>'date'
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function document()
    {
        return $this->belongsTo(Document::class);
    }

    public function replies()
    {
        return $this->hasMany(Reply::class);
    }

    public function files()
    {
        return $this->morphMany(File::class,'fileable');
    }

    public function comments(){
        return $this->hasMany(Comment::class);
    }
}
