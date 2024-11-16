<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class NewsAlbum extends Model
{
    use HasFactory;
    protected $guarded = [];
    protected $table = 'news_albums';
    protected $fillable = [
        'id',
        'news_id',
        'name',
        'primary',
        'orderby'
    ];
    function news()
    {
        return $this->belongsTo(News::class, 'news_id');
    }
}
