<?php

namespace App\Models;
use Illuminate\Database\Eloquent\Factories\HasFactory;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Storage;

class Post extends Model
{
    use HasFactory;

    protected $fillable =[
        'image',
        'title',
        'content',
        'slug',
        'category_id',
        'user_id',
        'published_at',
    ];

    public function category() {
        return $this->belongsTo(Category::class);
    }

    public function user() {
        return $this->belongsTo(User::class);
    }

    public function readTime($wordsPerMinute = 100) {
        $words_count = str_word_count(strip_tags($this->content));
        $minutes = $words_count / $wordsPerMinute;
        return max(1, round($minutes));
    }

    public function claps() {
        return $this->hasMany(Clap::class);
    }

    public function imageUrl() {
        if($this->image) {
            return Storage::url($this->image);
        }
        return null;
    }
}
