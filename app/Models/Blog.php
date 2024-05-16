<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Blog extends Model
{
    use HasFactory;
    protected static $unguarded = true;

    public function category()
    {
        return $this->belongsTo(BlogCategory::class);
    }

    public function scopeDrafts()
    {
        return $this->where('status', 'draft');
    }

    public function scopePublished()
    {
        return $this->where('status', 'published');
    }
}
