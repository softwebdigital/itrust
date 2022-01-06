<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Support\Str;
//use Spatie\Sluggable\HasSlug;
//use Spatie\Sluggable\SlugOptions;

class Blog extends Model
{
    use HasFactory, SoftDeletes;//, HasSlug;


    protected $guarded = [];


    public function comments(): HasMany
    {
        return $this->hasMany(Comment::class, 'post_id', 'id')->orderBy('created_at', 'DESC');
    }

    public static function getSlug($title): string
    {
        $i = 0;
        do {
            $slug = Str::slug($title).($i == 0 ? null : '-'.$i);
            $i++;
        } while (self::query()->where('slug', $slug)->first());
        return $slug;
    }

    /**
     * Get the options for generating the slug.
     */
//    public function getSlugOptions() : SlugOptions
//    {
//        return SlugOptions::create()
//            ->generateSlugsFrom('title')
//            ->saveSlugsTo('slug');
//    }
}
