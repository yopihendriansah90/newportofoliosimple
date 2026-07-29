<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Spatie\MediaLibrary\HasMedia;
use Spatie\MediaLibrary\InteractsWithMedia;
use Spatie\MediaLibrary\MediaCollections\Models\Media;

class Certification extends Model implements HasMedia
{
    use InteractsWithMedia;

    protected $fillable = [
        'title', 'provider', 'type', 'completed_at', 'credential_id',
        'verification_url', 'description', 'sort_order', 'is_active',
    ];

    protected $casts = [
        'completed_at' => 'date',
        'is_active' => 'boolean',
    ];

    public function registerMediaCollections(): void
    {
        $this->addMediaCollection('cover')->singleFile();
        $this->addMediaCollection('certificate')->singleFile();
    }

    public function registerMediaConversions(?Media $media = null): void
    {
        // Certificate files are downloaded in their original format.
    }
}
