<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Laravel\Scout\Searchable;

class Page extends Model
{
    use HasFactory;
    use Searchable;

    protected $fillable = ['title', 'content'];

    public function toSearchableArray(): array
    {
        return [
            'type' => 'page',
            'title' => $this->title,
            'content' => $this->content,
        ];
    }
}
