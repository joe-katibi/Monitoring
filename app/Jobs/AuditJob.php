<?php

namespace App\Jobs;

use App\Models\Result;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldBeUnique;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;


class AuditJob implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    protected $audit;

    /**
     * Create a new job instance.
     *
     * @return void
     */
    public function __construct(Result $audit)
    {
        $this->audit = $audit;
    }

    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle()
    {
        // Check if a supervisor has updated the audit
        if ($this->audit->supervisor_id !== null) {
            // Set the status of the audit to pending
            $this->audit->update(['status' => '2']);
            return;
        }

        // Check if an agent has closed the audit
        if ($this->audit->agent_id !== null) {
            // Set the status of the audit to completed
            $this->audit->update(['status' => '3']);
            return;
        }

        // Set the status of the audit to slipping
        $this->audit->update(['status' => '1']);
    }
}
