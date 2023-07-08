<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Models\ConductExam;
use App\Models\ExamStatus;
use Carbon\Carbon;

class UpdateExamStatusCommand extends Command
{
    protected $signature = 'exam:update-status';
    protected $description = 'Update the status of scheduled exams';

    public function handle()
    {
        $now = Carbon::now();

        $exams = ConductExam::where('completion_date', '<', $now)->where('status', 1)->get();

        foreach ($exams as $exam) {
            $exams = new ExamStatus();
            $exam->status = 0; // Set status to inactive
            $exam->save();
        }

        $this->info('Exam statuses updated successfully.');
    }
}
