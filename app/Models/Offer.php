<?php

namespace App\Models;

use Spatie\MediaLibrary\HasMedia;
use Illuminate\Database\Eloquent\Model;
use Spatie\MediaLibrary\InteractsWithMedia;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

class Offer extends Model implements HasMedia
{
    use HasFactory;
    use SoftDeletes;
    use InteractsWithMedia;

    public const PLACEHOLDER_IMAGE_PATH = 'images/placeholder.jpeg';

    protected $fillable = [
        'title',
        'price',
        'description',
        'author_id',
        'status',
        'deleted_by',
        'deleted_at'
    ];

    public function author(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    public function categories(): BelongsToMany
    {
        return $this->belongsToMany(Category::class);
    }

    public function locations(): BelongsToMany
    {
        return $this->belongsToMany(Location::class);
    }

    public function getImageUrlAttribute(): string
    {
        return $this->hasMedia()
            ? $this->getFirstMediaUrl()
            : self::PLACEHOLDER_IMAGE_PATH;
    }
}
