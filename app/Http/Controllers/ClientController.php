<?php

namespace App\Http\Controllers;

use App\Models\Client;
use Illuminate\Http\Request;
use App\Helpers\ApiResponser;
use App\Http\Resources\ClientResource;
use App\Http\Requests\ClientRequest;
use App\Http\Requests\ClientStoreRequest;
use App\Http\Requests\ClientUpdateRequest;


class ClientController extends Controller
{

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(ClientRequest $request)
    {
        $limit   = $request->limit ? $request->limit : 12;
        $page    = $request->page ? $request->page : 1;
        $clients = Client::list($limit, $page)
            ->get()
            ->mapInto(ClientResource::class);
        return $this->success($clients);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \App\Http\Requests\ClientStoreRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(ClientStoreRequest $request)
    {
        $client = Client::create($request->all());

        return $this->success(ClientResource::make($client), 'Cliente creado con éxito.', 201);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Client  $client
     * @return \Illuminate\Http\Response
     */
    public function show(Client $client)
    {
        return $this->success(ClientResource::make($client));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\ClientUpdateRequest  $request
     * @param  \App\Models\Client  $client
     * @return \Illuminate\Http\Response
     */
    public function update(ClientUpdateRequest $request, Client $client)
    {
        $client->fill($request->all());
        if ($client->isDirty()) {
            $client->save();
        }
        return $this->success(ClientResource::make($client), 'Cliente actualizado con éxito.', 201);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Client  $client
     * @return \Illuminate\Http\Response
     */
    public function destroy(Client $client)
    {
        $client->delete();
        return $this->success([], 'Cliente eliminado con éxito.', 202);
    }
}
