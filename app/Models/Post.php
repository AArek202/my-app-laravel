<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\SoftDeletes;
use Cviebrock\EloquentSluggable\Sluggable;


class Post extends Model
{
    use HasFactory;
    use SoftDeletes;
    use Sluggable;

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    protected $fillable = [
        'title',
        'content',
        'user_id',
        'image'
    ];

    public function sluggable(): array
    {
        return [
            'slug' => [
                'source' => 'title'
            ]
        ];
    }

    public function getRouteKeyName(): string
    {
        return 'slug';
    }
}
