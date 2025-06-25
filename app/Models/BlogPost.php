<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Laravel\Scout\Searchable;

class BlogPost extends Model
{
    use HasFactory;
    use Searchable;

    protected $fillable = ['title', 'body', 'tags', 'published_at'];

    public function toSearchableArray(): array
    {
        return [
            'type' => 'blog',
            'title' => $this->title,
            'body' => $this->body,
            'tags' => $this->tags,
            'published_at' => $this->published_at,
        ];
    }
}
