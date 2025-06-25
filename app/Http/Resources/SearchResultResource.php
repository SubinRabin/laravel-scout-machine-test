<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;
use Illuminate\Support\Str;

class SearchResultResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        return [
            'type' => $this->type ?? class_basename($this->resource),
            'title' => $this->title ?? $this->name ?? $this->question,
            'snippet' => Str::limit(strip_tags($this->body ?? $this->description ?? $this->answer ?? $this->content), 100),
            'link' => url('/' . ($this->type ?? class_basename($this->resource)) . '/' . $this->id),
        ];
    }
}
