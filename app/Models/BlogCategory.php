<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class BlogCategory extends Model
{
    use HasFactory;

    protected static $unguarded = true;
    public $timestamps = false;

    public function blogs()
    {
        return $this->hasMany(Blog::class);
    }
}
