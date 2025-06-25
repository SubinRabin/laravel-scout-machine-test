<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Laravel\Scout\Searchable;

class Faq extends Model
{
    use HasFactory;
    use Searchable;

    protected $fillable = ['question', 'answer'];

    public function toSearchableArray(): array
    {
        return [
            'type' => 'faq',
            'question' => $this->question,
            'answer' => $this->answer,
        ];
    }
}
