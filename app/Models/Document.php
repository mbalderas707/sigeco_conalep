<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Document extends Model
{
    use HasFactory, SoftDeletes;

    protected $fillable = [
        'folio',
        'subject',
        'document_date',
        'description',
        'received_since',
        'status_id',
        'user_id'
    ];

    protected $casts = [
        'document_date' => 'date',
        'received_since' => 'datetime'
    ];

    public function senders()
    {
        return $this->belongsToMany(Sender::class);
    }

    public function tags()
    {
        return $this->belongsToMany(Tag::class);
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function turns()
    {
        return $this->hasMany(Turn::class);
    }

    public function status()
    {
        return $this->belongsTo(Status::class);
    }
}
