<?php

namespace App\Http\Traits;

use App\Models\Client;

trait TaskTrait
{
    public function dataNeededForTask($task = null)
    {
        $users = $this->userModel->get(['id', 'name']);
        $phases = $this->phaseModel->orderBy('step')->get(['id', 'name']);
        $statuses = $this->statusModel->get(['id', 'name']);
        $clients = $this->clientModel->get(['id', 'name']);
        return compact('task', 'users', 'phases', 'statuses', 'clients');
    }
    private function getClient($request)
    {
        $client = [];
        if ($request->client_id == null || Client::where('name', $request->client_name)->first() == null) {
            $client = $this->clientModel::create(
                [
                    'name' => $request->client_name,
                    'phone' => $request->client_phone,
                ]
            );
        }
        return $client;
    }
}
