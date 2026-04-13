<?php

namespace App\Observers;

use App\Models\Task;

class TaskObserver
{
    /**
     * When a task is created or updated
     */
    public function saved(Task $task)
    {
        if ($task->project) {
            $task->project->refresh();               // reload fresh project with tasks
            $task->project->projectProgress();    // update status + progress
        }
    }

    /**
     * When a task is deleted
     */
    public function deleted(Task $task)
    {
        if ($task->project) {
            $task->project->refresh();
            $task->project->projectProgress();
        }
    }
}
