<?php

namespace App\Models;
use App\Events\ModelCreated;


use Illuminate\Database\Eloquent\Model;
use Kalnoy\Nestedset\NodeTrait;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Notifications\Notifiable;
class Comment extends Model
{
    use NodeTrait, HasFactory, Notifiable;


    // déclenche évenement
    protected $dispatchesEvents = [
        'created' => ModelCreated::class,
    ];
   
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'body', 
        'post_id', 
        'user_id', 
    ];

    public function user()
    {
     return $this->belongsTo(User::class);
    }
    public function post()
    {
     return $this->belongsTo(Post::class);
    }
}
