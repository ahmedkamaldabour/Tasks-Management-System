<?php

namespace App\Http\Controllers;

use App\DataTables\ClientPhaseDataTable;
use App\Models\Client;
use App\Models\Task;
use Illuminate\Http\Request;


class ClientController extends Controller
{
    public function search(Request $request)
    {
        $searchTerm = $request->query('search');
        $clients = Client::where('name', 'LIKE', '%' . $searchTerm . '%')->get();
        return response()->json($clients);
    }

    public function clientsPhases(ClientPhaseDataTable $dataTable)
    {
        return $dataTable->render('pages.client-phase.index');
    }

    public function previewTask($uuid)
    {
        $task = Task::where('uuid', $uuid)->firstOrFail();
        return view('pages.client-phase.preview', compact('task'));
    }


}
