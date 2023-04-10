<?php

namespace App\Jobs;

use App\Models\ExamStatus;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldBeUnique;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;


class ExamStatusJob implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    protected $exam;

    /**
     * Create a new job instance.
     *
     * @return void
     */
    public function __construct(ExamStatus $exam)
    {
        $this->exam = $exam;
    }


    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle()
    {

        if (now() > $this->exam->end_time) {
            // Set the status of the exam to inactive
            $this->exam->update(['status' => 'inactive']);
        }
    }
}
