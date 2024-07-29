<?php

namespace App\Models;

use App\Models\Category;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Blog extends Model
{
    use HasFactory;
    protected static $unguarded = true;


    protected $guarded = [];

    protected $casts = [
        'keywords' => 'array',
        'tags' => 'array',
    ];

    public function category()
    {
        return $this->belongsTo(Category::class);
    }

    // public function scopeDrafts()
    // {
    //     return $this->where('status', 'draft');
    // }

    // public function scopePublished()
    // {
    //     return $this->where('status', 'published');
    // }
}
