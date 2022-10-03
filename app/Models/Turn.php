<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Turn extends Model
{
    use HasFactory,SoftDeletes;

    protected $fillable = [
        'instruction_id',
        'seen_since',
        'additional_instructions',
        'expiration',
        'concluded',
        'document_id'
    ];

    protected $casts = [
        'seen_since'=>'datetime',
        'expiration'=>'date',
        'concluded'=>'boolean'
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

    /*public function files()
    {
        return $this->morphMany(File::class,'fileable');
    }*/

    public function comments(){
        return $this->hasMany(Comment::class)->whereNull('parent_id');
    }

    public function instruction(){
        return $this->belongsTo(Instruction::class);
    }

    public function profiles(){
        return $this->belongsToMany(Profile::class);
    }
}
