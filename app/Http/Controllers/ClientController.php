<?php

namespace App\Http\Controllers;

;
use App\Client;
use App\Http\Requests\ClientStoreRequest;
use App\Http\Requests\ClientUpdateRequest;
use Illuminate\Http\Request;

class ClientController extends Controller
{

    public function index()
    {

        return response()->json(  [
            'title' =>'Listado de Clientes',
            'clients'  => Client::query()->latest()->paginate(5)
        ]);
    }


    public function create()
    {
        return 'Formulario Crear Cliente';
    }

    public function store(ClientStoreRequest $request)
    {
        Client::create($request->validated());
        //return $request;
    }

    public function show(Client $client)
    {
        return $client;
    }

    public function edit(Client $client)
    {
        return 'Formulario Editar Cliente';
    }

    public function update(ClientUpdateRequest $request, Client $client)
    {
        $client->update($request->validated());
    }

    public function destroy(Client $client)
    {
        $client->delete();
    }
}
