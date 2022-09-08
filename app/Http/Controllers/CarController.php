<?php

namespace App\Http\Controllers;

use App\Models\Car;
use App\Repositories\CarRepository;
use Illuminate\Http\Request;



class CarController extends Controller
{
    public function __construct(Car $car){
        $this->car = $car;
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $carRepository = new CarRepository($this->car);

        if ($request->has('filter_model')) {
            $carRepository->selectRelatedAttributes('carModel:id,'.$request->filter_model);
        } else {
            $carRepository->selectRelatedAttributes('carModel');
        }

        if($request->has('search')) {
            $carRepository->selectSearchAttributes($request->search);
        }

        return response()->json($carRepository->get(), 200);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \App\Http\Requests\StoreCarRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $request->validate($this->car->rules());
        $data = $request->all();
        // if (isset($data['image'])) {
        //     // save image on disk and update data attribute image
        //     $data['image'] = $data['image']->store('img/car_models', 'public');
        // }
        $car = $this->car->create($data);
        return response()->json($car, 201);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Car  $car
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $car = $this->car->with('carModel')->find($id);
        if (!$car) return response()->json(['error' => 'item not found'], 404);
        return response()->json($car, 200);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\UpdateCarRequest  $request
     * @param  \App\Models\Car  $car
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $car = $this->car->find($id);
        if (!$car) return response()->json(['error' => 'item not found'], 404);
        $dinamic_rules = array();

        if ($request->method() === 'PATCH') {
            foreach($car->rules() as $key => $value) {
                if (array_key_exists($key, $request->all())){
                    $dinamic_rules[$key] = $value;
                }
            }
        } else {
            $dinamic_rules = $car->rules();
        }

        $request->validate($dinamic_rules);
        $car->update($request->all());
        return response()->json($car, 200);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Car  $car
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $car = $this->car->find($id);
        if (!$car) return response()->json(['error' => 'item not found'], 404);
        $car->delete();
        return response()->json(['msg' => 'the car was successfully removed'], 200);
    }
}
