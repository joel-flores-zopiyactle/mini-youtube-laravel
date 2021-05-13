<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class videos extends Model
{
    use HasFactory;

    protected $fillable = [
        'title',
        'description',
        'image',
        'video_path',
    ];

    public function comments()
    {
        return $this->hasMany(comments::class);
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }

}
