<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Notifications\Notifiable;
use App\Events\ModelCreated;
class Post extends Model
{
    use HasFactory, Notifiable;

    // déclenche évenement
    protected $dispatchesEvents = [
        'created' => ModelCreated::class,
    ]; 
    protected $fillable = [
        'title', 
        'slug', 
        'seo_title', 
        'excerpt', 
        'body', 
        'meta_description', 
        'meta_keywords', 
        'active', 
        'image', 
        'user_id',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function categories()
    {
        return $this->belongsToMany(Category::class);
    }

    public function tags()
    {
        return $this->belongsToMany(Tag::class);
    }

    public function comments()
    {
        return $this->hasMany(Comment::class);
    }

    public function validComments()
    {
      return $this->comments()->whereHas('user', function ($query) {
          $query->whereValid(true);
       });
    }

    
}
