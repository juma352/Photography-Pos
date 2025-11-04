<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;

class Collection extends Model
{
    protected $fillable = [
        'title',
        'description',
        'slug',
        'cover_image',
        'is_active',
        'sort_order'
    ];

    protected $casts = [
        'is_active' => 'boolean',
    ];

    // Relationships
    public function photos()
    {
        return $this->hasMany(Photo::class)->orderBy('sort_order');
    }

    // Automatically generate slug from title
    protected static function boot()
    {
        parent::boot();
        
        static::creating(function ($collection) {
            if (empty($collection->slug)) {
                $collection->slug = Str::slug($collection->title);
            }
        });
    }

    // Scope for active collections
    public function scopeActive($query)
    {
        return $query->where('is_active', true);
    }

    // Get cover image URL
    public function getCoverImageUrlAttribute()
    {
        if ($this->cover_image) {
            return asset('Images/' . $this->cover_image);
        }
        
        // Fallback to first photo in collection
        $firstPhoto = $this->photos()->first();
        return $firstPhoto ? $firstPhoto->image_url : asset('Images/default-collection.jpg');
    }
}
