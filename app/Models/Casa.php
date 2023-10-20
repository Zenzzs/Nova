<?php

namespace App\Models;

use Spatie\MediaLibrary\MediaCollections\Models\Media;
use Spatie\Sluggable\HasSlug;
use Spatie\Sluggable\SlugOptions;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Spatie\Image\Manipulations;
use Spatie\MediaLibrary\HasMedia;
use Spatie\MediaLibrary\InteractsWithMedia;

class Casa extends Model implements HasMedia
{
    use InteractsWithMedia;
    use HasFactory;
    protected $guarded = [];


    use HasSlug;


    // relacion muchos a unos

    public function user()
    {
        return $this->belongsTo('App\Models\User');
    }


    public function comments()
    {
        return $this->hasMany('App\Models\Comment');
    }

    //relacion muchos a muchis


    public function caracteristicas()
    {
        return $this->hasOne('App\Models\Caracteristica');
    }

    public function getSlugOptions(): SlugOptions
    {
        return SlugOptions::create()
            ->generateSlugsFrom('name')
            ->saveSlugsTo('slug');
    }

    public function getRouteKeyName()
    {
        return 'slug';
    }
    public function registerMediaConversions(Media $media = null): void
    {
        $this->addMediaConversion('thumb')
            ->width(360)
            ->height(240)
            ->sharpen(10);
        $this->addMediaConversion('collapse')
            ->width(600)
            ->height(600)
            ->sharpen(10);
    }


}
