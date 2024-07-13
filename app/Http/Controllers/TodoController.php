<?php

namespace App\Http\Controllers;

use App\Models\Todo;
use Illuminate\Http\Request;
use App\Services\TodoService;
use App\Http\Requests\CreateTodoRequest;
use App\Http\Requests\UpdateTodoRequest;

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
            return response()->json(['error' => false, 'message' => 'Todo created successfully']);
        } else {
            return response()->json(['error' => true, 'message' => 'Something went wrong']);
        }
    }

    public function getTodoList($id)
    {
        $todoListDetails = $this->todoService->getTodoListDetails($id);
        return json_encode($todoListDetails);
    }

    public function update(UpdateTodoRequest $request, Todo $todo)
    {
        $validatedData = $request->validated();
        $created       = $this->todoService->update($validatedData, $todo);
        if ($created) {
            return response()->json(['error' => false, 'message' => 'Todo created successfully']);
        } else {
            return response()->json(['error' => true, 'message' => 'Something went wrong']);
        }
    }

    public function delete(Todo $todo)
    {
        $deletedTodoList = $this->todoService->delete($todo);
        if ($deletedTodoList) {
            return json_encode(['status' => 'success']);
        } else {
            return json_encode(['status' => 'error']);
        }
    }

    public function updateTodoTask(Request $request, $id)
    {
        $deletedTodoList = $this->todoService->updateTodoTask($id, $request->input('status'));
        if ($deletedTodoList) {
            return json_encode(['status' => 'success']);
        } else {
            return json_encode(['status' => 'error']);
        }
    }

    public function searchTodo(Request $request)
    {
        $todoLists = $this->todoService->getSearchResultForTodoRequests($request->query('query'));
        return view('home.partials.todo-list', compact('todoLists'))->render();
    }
}
