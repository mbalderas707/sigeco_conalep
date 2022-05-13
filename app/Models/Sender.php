<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Sender extends Model
{
    use HasFactory, SoftDeletes;

    protected $fillable = [
        'name',
        'position',
        'company_id'
    ];

    public function documents()
    {
        return $this->belongsToMany(Document::class);
    }

    public function company()
    {
        return $this->belongsTo(Company::class);
    }
}


