<?php

namespace App\Models;

use Illuminate\Console\Concerns\InteractsWithIO;
use Illuminate\Database\Eloquent\Factories\HasFactory;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Storage;
use Spatie\MediaLibrary\HasMedia;
use Spatie\MediaLibrary\InteractsWithMedia;
use Spatie\MediaLibrary\MediaCollections\Models\Media;
use Spatie\Sluggable\HasSlug;
use Spatie\Sluggable\SlugOptions;

class Post extends Model implements HasMedia
{
    use HasFactory;
    use InteractsWithMedia;
    use HasSlug;

    protected $fillable =[
        // 'image',
        'title',
        'content',
        'slug',
        'category_id',
        'user_id',
        'published_at',
    ];

    public function registerMediaConversions(?Media $media = null): void
    {
        $this
            ->addMediaConversion('preview')
            ->width(400);
        $this
            ->addMediaConversion('large')
            ->width(1280);
    }

    public function registerMediaCollections(): void
    {
        $this->addMediaCollection('default')
            ->singleFile();
    }

    /**
     * Get the options for generating the slug.
     */
    public function getSlugOptions() : SlugOptions
    {
        return SlugOptions::create()
            ->generateSlugsFrom('title')
            ->saveSlugsTo('slug');
    }

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

    public function imageUrl($conversionName = '') {
        return $this->getFirstMedia()?->getUrl($conversionName);
    }
}
