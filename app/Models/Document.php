<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Document extends Model
{
    use HasFactory, SoftDeletes;

    protected $fillable = ['folio', 'subject', 'document_date', 'description', 'received_since', 'status_id', 'user_id', 'profile_id'];

    public function scopeCurrentProfile($query)
    {
        $query->where('user_id', auth()->user()->id);
    }

    protected $casts = [
        'document_date' => 'date',
        'received_since' => 'datetime',
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

    public function profile()
    {
        return $this->belongsTo(Profile::class);
    }

    public function files()
    {
        return $this->morphMany(File::class, 'fileable');
    }

    public function scopeTag($query, $tag)
    {
        if ($tag) {
            return $query->whereHas('tags', function ($query) use ($tag) {
                $query->where('tags.id', $tag);
            });
        }
    }

    public function scopeSearch($query, $searchTerm)
    {
        if ($searchTerm)
            return $query->where('folio', 'Like', "%$searchTerm%")
                ->orWhere('subject', 'Like', "%$searchTerm%")
                ->orWhere('description', 'Like', "%$searchTerm%");
    }

    public function ScopeFilterSender($query, $sender)
    {
        if ($sender)
            return $query->whereHas('senders', function ($query) use ($sender) {
                $query->whereIn('senders.id', $sender);
            });
    }

    public function ScopeFilterStatus($query, $statoos)
    {
        if ($statoos)
            return $query->whereIn('status_id', $statoos);
    }
}
