<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Post extends Model
{
    use HasFactory;

    protected $fillable = [
        'title',
        'content',
        'is_draft',
        'published_at',
    ];

    protected $casts = [
        'published_at' => 'datetime',
        'is_draft' => 'boolean',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
