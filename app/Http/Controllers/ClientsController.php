<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Clients;
use JamesDordoy\LaravelVueDatatable\Http\Resources\DataTableCollectionResource;
use App\Http\Requests\ClientsRequest;
use Illuminate\Support\Facades\Hash;
use App\Http\Resources\Clients as ClientsResource;

class ClientsController extends Controller
{
    public function index()
    {
        return view('client.index');
    }

    public function show(Clients $client) {
        return new ClientsResource($client);
    }

    public function getClientsJson() {
        return ClientsResource::collection(Clients::all());
    }

    public function getClients(Request $request)
    {
        $length = $request->input('length');
        $orderBy = $request->input('column'); //Index
        $orderByDir = $request->input('dir', 'asc');
        $searchValue = $request->input('search');
        
        $query = Clients::eloquentQuery($orderBy, $orderByDir, $searchValue);
        $data = $query->paginate($length);
        
        return new DataTableCollectionResource($data);
    }

    public function store(ClientsRequest $request)
    {
        // Create the user
        if (!Clients::create($request->merge(['password' => Hash::make($request->get('password'))])->all())) {
            return json_encode([
                "code" => 402,
                "message" => "Unable to create user"
            ]);
        }

        return json_encode([
            "code" => 200,
            "message" => "Success"
        ]);
    }

    public function delete(Clients $client) {
        return $client->delete();
    }

    public function update(Request $request, Clients $client)
    {
        // Create the user
        $client->update(
            $request->merge(['password' => Hash::make($request->get('password'))])
            ->except([$request->get('password') ? '' : 'password'])
        );

        return json_encode([
            "code" => 200,
            "message" => "Success"
        ]);
    }
}
