<?php

namespace App\Jobs;

use App\Models\AlertForm;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldBeUnique;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;

class AutoFailStatusJob implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;


    protected $autofail;

    /**
     * Create a new job instance.
     *
     * @return void
     */
    public function __construct(AlertForm $autofail)
    {
        $this->autofail = $autofail;
    }

    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle()
    {

          // Check if a supervisor has updated the audit
          if ($this->autofail->supervisor_id !== null) {
            // Set the status of the audit to pending
            $this->autofail->update(['status' => '2']);
            return;
        }

        // Check if an agent has closed the audit
        if ($this->autofail->agent_id !== null) {
            // Set the status of the audit to completed
            $this->autofail->update(['status' => '3']);
            return;
        }

        // Set the status of the audit to slipping
        $this->autofail->update(['status' => '1']);
    }
}
