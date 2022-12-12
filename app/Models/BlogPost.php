<?php

namespace App\Models;

use App\Events\MailEvent;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Author;
use App\Models\Comment;
use Illuminate\Database\Eloquent\SoftDeletes;

class BlogPost extends Model
{
    use HasFactory, SoftDeletes;
    protected $table = 'blog_posts';
    protected $fillable = ['author_id', 'title', 'content', 'created_at', 'updated_at'];
//    protected $hidden = ['created_at', 'updated_at'];
    protected $hidden = [];
    public $timestamps = true;

    protected $dispatchesEvents = [
        'created' => MailEvent::class,
        'updated' => MailEvent::Class,
    ];

    public function format(): array
    {
        return [
            'head' => $this->title,
            'body' => $this->content,
            'created_by' => $this->author->name,
            'comments' => $this->comments,
        ];
    }

    public function getComments($comments)
    {
        foreach ($comments as $comment) {
            return $comment;
        }
    }

    public function author(): \Illuminate\Database\Eloquent\Relations\BelongsTo
    {
        return $this->belongsTo(Author::class, 'author_id', 'id');
    }

    public function comments(): \Illuminate\Database\Eloquent\Relations\HasMany
    {
        return $this->hasMany(Comment::class, 'post_id', 'id');
    }

    public function scopeLatest($query)
    {
        return $query->orderBy(static::CREATED_AT,'desc');
    }

    public function scopeMostCommented($query)
    {
        return $query->withCount('comments')->orderBy('comments_count','desc')->take(6)->get();
    }

    public static function boot()
    {
        parent::boot();
        static::updating(function (BlogPost $post){

        });

        static::deleting(function (BlogPost $post) {
            $post->comments()->delete();
            $post->images()->delete();
        });
        static::restoring(function (BlogPost $post) {
            $post->comments()->restore();
        });
    }


    public function image(): \Illuminate\Database\Eloquent\Relations\MorphOne
    {
        return $this->morphOne(Images::class,'imageable');
    }
}
