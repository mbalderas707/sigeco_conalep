<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Reply extends Model
{
    use HasFactory,SoftDeletes;

    protected $fillable = [
        'remark',
        'turn_id'
    ];

    public function turn()
    {
        return $this->belongsTo(Turn::class);
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
