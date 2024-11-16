<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class News extends Model
{
    use HasFactory;
    protected $guarded = [];
    public function categories()
    {
        return $this->belongsTo(Category::class);
    }
    
    public function user()
    {
        return $this->belongsTo(User::class, 'user_id');
    }

    public function notifications()
    {
        return $this->hasMany(Notification::class);
    }

    public function comments()
    {
        return $this->hasMany(Comment::class);
    }

    public function tags()
    {
        return $this->belongsToMany(Tag::class, 'news_tag');
    }

    function news_albums()
    {
        return $this->hasMany(NewsAlbum::class)->orderBy('orderby', 'asc');
    }

    function primary_image()
    {
        return $this->hasMany(NewsAlbum::class)
            ->select('news_id', 'name', 'primary')->where('primary', true);
    }  
}
