<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Services\TodoService;
use App\Http\Requests\CreateTodoRequest;

class TodoController extends Controller
{
    private $todoService;

    public function __construct(TodoService $todoService)
    {
        $this->todoService = $todoService;
    }

    public function store(CreateTodoRequest $request)
    {
        $validatedData = $request->validated();
        $created       = $this->todoService->create($validatedData);
        if ($created) {
            return redirect()->route('index');
        }
    }

    public function getTodoList($id)
    {
        $todoListDetails = $this->todoService->getTodoListDetails($id);
        return json_encode($todoListDetails);
    }
}
