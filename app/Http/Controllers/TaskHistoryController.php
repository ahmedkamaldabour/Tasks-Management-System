<?php

namespace App\Http\Controllers;

use App\DataTables\TaskHistoryDataTable;

class TaskHistoryController extends Controller
{
    public function index(TaskHistoryDataTable $dataTable)
    {
        return $dataTable->render('pages.tasks.assignedTasks');
    }

}
