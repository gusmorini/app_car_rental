<?php

namespace App\Http\Controllers;

use App\Models\Client;
use App\Repositories\ClientRepository;
use Illuminate\Http\Request;

class ClientController extends Controller
{
    public function __construct(Client $client){
        $this->client = $client;
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $clientRepository = new ClientRepository($this->client);

        // if ($request->has('filter_model')) {
        //     $clientRepository->selectRelatedAttributes('carModel:id,'.$request->filter_model);
        // } else {
        //     $clientRepository->selectRelatedAttributes('carModel');
        // }

        if($request->has('search')) {
            $clientRepository->selectSearchAttributes($request->search);
        }

        return response()->json($clientRepository->get(), 200);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \App\Http\Requests\StoreClientRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $clientRepository = new ClientRepository($this->client);
        $clientRepository->validateAttributes($request);
        $data = $clientRepository->saveAttributes($request->all());
        return response()->json($data, 201);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Client  $client
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $clientRepository = new ClientRepository($this->client);
        $clientRepository->getById($id);
        if (!$clientRepository->model) return response()->json(['error' => 'item not found'], 404);
        return response()->json($clientRepository, 200);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\UpdateClientRequest  $request
     * @param  \App\Models\Client  $client
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $clientRepository = new ClientRepository($this->client);
        $clientRepository->getById($id);
        if (!$clientRepository->model) return response()->json(['error' => 'item not found'], 404);
        $clientRepository->validateAttributes($request);
        $clientRepository->updateAttributes($request->all());
        return response()->json($clientRepository, 200);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  Integer
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $clientRepository = new ClientRepository($this->client);
        $clientRepository->getById($id);
        if (!$clientRepository->model) return response()->json(['error' => 'item not found'], 404);
        $clientRepository->destroy();
        return response()->json(['msg' => 'the client was successfully removed'], 200);
    }
}
