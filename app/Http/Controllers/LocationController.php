<?php

namespace App\Http\Controllers;

// use App\Http\Requests\StoreLocationRequest;
// use App\Http\Requests\UpdateLocationRequest;
use App\Models\Location;
use App\Repositories\LocationRepository;
use Illuminate\Http\Request;


class LocationController extends Controller
{
    public function __construct(Location $location){
        $this->location = $location;
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $location = new LocationRepository($this->location);

        $location->selectRelatedAttributes('client');
        $location->selectRelatedAttributes('car');


        if($request->has('search')) {
            $location->selectSearchAttributes($request->search);
        }

        return response()->json($location->get(), 200);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \App\Http\Requests\StoreLocationRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $location = new LocationRepository($this->location);
        $location->validateAttributes($request);
        $data = $location->saveAttributes($request->all());
        return response()->json($data, 201);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Location  $location
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $location = new LocationRepository($this->location);
        $location->selectRelatedAttributes('car');
        $location->selectRelatedAttributes('client');
        $location->getById($id);
        if (!$location->model) return response()->json(['error' => 'item not found'], 404);
        return response()->json($location, 200);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\UpdateLocationRequest  $request
     * @param  \App\Models\Location  $location
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $location = new LocationRepository($this->location);
        $location->getById($id);
        if (!$location->model) return response()->json(['error' => 'item not found'], 404);
        $location->validateAttributes($request);
        $location->updateAttributes($request->all());
        return response()->json($location, 200);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Location  $location
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $location = new LocationRepository($this->location);
        $location->getById($id);
        if (!$location->model) return response()->json(['error' => 'item not found'], 404);
        $location->destroy();
        return response()->json(['msg' => 'the location was successfully removed'], 200);
    }
}
