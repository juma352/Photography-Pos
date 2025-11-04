<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Photo extends Model
{
    protected $fillable = [
        'title',
        'description',
        'filename',
        'original_filename',
        'alt_text',
        'collection_id',
        'sort_order',
        'is_featured',
        'metadata'
    ];

    protected $casts = [
        'is_featured' => 'boolean',
        'metadata' => 'array',
    ];

    // Relationships
    public function collection()
    {
        return $this->belongsTo(Collection::class);
    }

    // Get image URL
    public function getImageUrlAttribute()
    {
        return asset('Images/' . $this->filename);
    }

    // Get thumbnail URL (you can implement thumbnail generation later)
    public function getThumbnailUrlAttribute()
    {
        return $this->image_url; // For now, same as image_url
    }

    // Scope for featured photos
    public function scopeFeatured($query)
    {
        return $query->where('is_featured', true);
    }
}
