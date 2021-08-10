<?php

namespace App\Http\Controllers;

use App\Http\Requests\ClientCreateRequest;
use App\Services\ClientService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\View;
use Illuminate\Support\MessageBag;

class ClientController extends Controller {

    private $clientService;

    public function __construct(ClientService $clientService) {
        $this->clientService = $clientService;
    }

    public function findClientById(Request $request) {
        $result = $this->clientService->findClientsByNameOrId($request->route()->parameters());

        if ($result instanceof MessageBag) {
            return response()->json($result, 400);
        }

        return response()->json($result);
    }

    public function findClientByParam(Request $request) {
        $result = $this->clientService->findClientsByNameOrId($request->route()->parameters());

        if ($result instanceof MessageBag) {
            return response()->json($result, 400);
        }

        return response()->json($result);
    }

    public function createClient(ClientCreateRequest $request) {
        $data = $request->only([
            "first_name",
            "middle_name",
            "last_name",
            "phone",
        ]);

        $result = $this->clientService->saveClientData($data);

        if ($result instanceof MessageBag) {
            Session::flash('error', 'Client creation failed!');
            return View::make('partials/flash_message');
        }

        Session::flash('success', 'Client created successfully!');
        return View::make('partials/flash_message');
    }
}
