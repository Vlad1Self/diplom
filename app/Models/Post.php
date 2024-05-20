<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

class Post extends Model
{
    use HasFactory;

    protected $fillable = [
        'title',
        'content',
        'category_id',
        'price',
        'image_path',
    ];
    // In Post.php
    public function categories(): BelongsToMany
    {
        return $this->belongsToMany(Category::class);
    }
}
