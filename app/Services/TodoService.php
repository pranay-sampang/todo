<?php

namespace App\Services;

use App\Models\Todo;
use App\Models\TodoTask;

class TodoService
{
    public function create($todoDetails)
    {
        $tasks = $todoDetails['task'];
        $todo  = Todo::create($todoDetails);
        foreach ($tasks as $task) {
            TodoTask::create([
                'todo_id' => $todo->id,
                'task'    => $task,
                'status'  => 'pending',
            ]);
        }
        return $todo;
    }

    public function getTodoList()
    {
        $todo = Todo::with('todoTask')
            ->latest()
            ->get();
        return $todo;
    }

    public function getTodoListDetails($id)
    {
        $todoDetails = Todo::with('todoTask')
            ->where('id', $id)
            ->latest()
            ->get();
        return $todoDetails;
    }

    public function update($todoDetails, $todo)
    {
        $todo->update($todoDetails);
        Todotask::where('todo_id', $todo->id)->delete();
        $tasks = $todoDetails['task'];
        foreach ($tasks as $task) {
            TodoTask::create([
                'todo_id' => $todo->id,
                'task'    => $task,
                'status'  => 'pending',
            ]);
        }
        return $todo;
    }

    public function delete($todo)
    {
        return $todo->delete();
    }
}
