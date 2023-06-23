<?php

namespace App\Http\Controllers;

use App\Http\Traits\HomeTrait;
use function view;

class HomeController extends Controller
{
    use HomeTrait;

    public function index()
    {
        $status = $this->taskStatusStatistics();
        $tasksToDo = $this->tasksToDo();
        $tasksDoing = $this->tasksToDoing();
        return view('index', compact('status', 'tasksToDo', 'tasksDoing'));
    }


}
