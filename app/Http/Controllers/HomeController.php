<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Services\TodoService;

class HomeController extends Controller
{
    private $todoService;

    public function __construct(TodoService $todoService)
    {
        $this->todoService = $todoService;
    }

    public function index()
    {
        $todoLists = $this->todoService->getTodoList();
        return view(
            'home.index',
            [
                'todoLists' => $todoLists
            ]
        );
    }
}
