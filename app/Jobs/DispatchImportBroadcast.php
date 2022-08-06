<?php

namespace App\Jobs;

use App\Events\NotifyRecordImportStatus;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldBeUnique;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;

class DispatchImportBroadcast implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    /**
     * Create a new job instance.
     *
     * @return void
     */
    public function __construct(public int $userId,
                                public int $rowNumber,
                                public int $totalRows,
                                public int $previousRecords,
                                public int $newRecords)
    {
        //
    }

    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle()
    {
        NotifyRecordImportStatus::dispatch($this->userId,
            $this->rowNumber,
            $this->totalRows,
            $this->previousRecords,
            $this->newRecords);
    }
}
