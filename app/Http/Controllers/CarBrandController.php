<?php

namespace App\Http\Controllers;

use App\Models\CarBrand;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class CarBrandController extends Controller
{
    public function __construct(CarBrand $brand) {
        $this->brand = $brand;
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $brands = $this->brand->all();
        return response()->json($brands, 200);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {

        $request->validate($this->brand->rules(), $this->brand->feedback());
        
        $image = $request->file('image');
        $urn_image = $image->store('img/car_brands', 'public');
        $name = $request->name;

        // dd($urn_image);

        $brand = $this->brand->create([
            'name' => $name,
            'image' => $urn_image,
        ]);

        return response()->json($brand, 201);
    }

    /**
     * Display the specified resource.
     *
     * @param  Integer
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $brand = $this->brand->find($id);
        if (!$brand) return response()->json(['error' => 'item not found'], 404);
        return response()->json($brand, 200);
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
        $brand = $this->brand->find($id);
        if (!$brand) return response()->json(['error' => 'update failed, item not found'], 404);

        $dinamic_rules = array();

        if ($request->method() === 'PATCH') {
            foreach($brand->rules() as $key => $value) {
                if (array_key_exists($key, $request->all())){
                    $dinamic_rules[$key] = $value;
                }
            }
        } else {
            $dinamic_rules = $brand->rules();
        }

        $name = $request->name;
        $image = $request->file('image');

        // delete old image on disk
        if ($image) {
            Storage::disk('public')->delete($brand->image);
        }

        $image_urn = $image->store('img/car_brands', 'public');

        $request->validate($dinamic_rules, $brand->feedback());
        
        $brand->update([
            'name' => $name,
            'image' => $image_urn,
        ]);

        return response()->json($brand, 200);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  Integer
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $brand = $this->brand->find($id);
        if (!$brand) return response()->json(['error' => 'deletion failed, item not found'], 404);

        // delete image on disk if isset
        if ($brand->image) {
            Storage::disk('public')->delete($brand->image);
        }

        $brand->delete();
        return response()->json(['msg' => 'the tag has been successfully removed'], 200);
    }
}
