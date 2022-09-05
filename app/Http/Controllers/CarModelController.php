<?php

namespace App\Http\Controllers;

use App\Models\CarModel;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class CarModelController extends Controller
{
    public function __construct(CarModel $model){
        $this->model = $model;
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $model = $this->model->with('carBrand')->get();
        return response()->json($model, 200);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $request->validate($this->model->rules());
        $data = $request->all();
        if (isset($data['image'])) {
            // save image on disk and update data attribute image
            $data['image'] = $data['image']->store('img/car_models', 'public');
        }
        $model = $this->model->create($data);
        return response()->json($model, 201);
    }

    /**
     * Display the specified resource.
     *
     * @param  Integer
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $model = $this->model->with('carBrand')->find($id);
        if (!$model) return response()->json(['error' => 'item not found'], 404);
        return response()->json($model, 200);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  Integer
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $model = $this->model->find($id);
        if (!$model) return response()->json(['error' => 'update failed, item not found'], 404);

        $dinamic_rules = array();

        if ($request->method() === 'PATCH') {
            foreach($model->rules() as $key => $value) {
                if (array_key_exists($key, $request->all())){
                    $dinamic_rules[$key] = $value;
                }
            }
        } else {
            $dinamic_rules = $model->rules();
        }

        $request->validate($dinamic_rules);
        
        $data = $request->all();

        if (isset($data['image'])) {
            // delete old image on disk
            Storage::disk('public')->delete($model->image);
            // save image on disk and urn image on data
            $data['image'] = $data['image']->store('img/car_models', 'public');
        }

        $model->update($data);
        return response()->json($model, 200);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  Integer
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $model = $this->model->find($id);
        if (!$model) return response()->json(['error' => 'deletion failed, item not found'], 404);

        // delete image on disk if isset
        if ($model->image) {
            Storage::disk('public')->delete($model->image);
        }

        $model->delete();
        return response()->json(['msg' => 'the template was successfully removed'], 200);
    }
}
