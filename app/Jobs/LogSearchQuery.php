<?php
namespace App\Jobs;

use App\Models\SearchLog;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;

class LogSearchQuery implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    public string $query;
    public int|null $userId;

    public function __construct(string $query, ?int $userId = null)
    {
        $this->query = $query;
        $this->userId = $userId;
    }

    public function handle(): void
    {
        SearchLog::create([
            'query' => $this->query,
            'user_id' => $this->userId,
        ]);
    }
}
