<?php

namespace App\Http\Controllers\api;

use App\Http\Controllers\Controller;
use App\Http\Resources\BrandResource;
use App\Http\Resources\ProductResource;
use App\Models\Brand;
use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class BrandController extends Controller
{
    public function show($id)
    {
        $brand = Brand::find($id);
        if ($brand != null) {
            $products = Product::where('brand_id', '=', $id)->get();
            return ProductResource::collection($products);
        }
        return response()->json(['msg' => '404 not found'], 404);

    }
    public function all()
    {
        $brands = Brand::all();
        return BrandResource::collection($brands);

    }
    public function add(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'name'=>'unique:brands,name'
        ]);
        if ($validator->fails()) {
            return response()->json(['errors' => $validator->errors()], 406);
        }
        $brand=Brand::create([
            'name' => $request->name
        ]);
        return response()->json(['msg' => 'created successfully','brand'=>new BrandResource($brand)], 201);

    }
    public function edit($id, Request $request)
    {
        $brand = Brand::findOrFail($id);
        $validator = Validator::make($request->all(), [
            'name'=>"unique:brands,name,$brand->id"
        ]);
        if ($validator->fails()) {
            return response()->json(['errors' => $validator->errors()], 406);
        }
        $brand->update([
            'name' => $request->name
        ]);
        return response()->json(['msg' => 'updated successfully','brand'=>new BrandResource($brand)], 200);

    }
    public function delete($id)
    {
        if ((Brand::where('name','No Brand')->first())==null)
        {
            Brand::create([
                'name' => 'No Brand'
            ]);
        }
        $newBrand=Brand::where('name','No Brand')->first();
        $brand = Brand::findOrFail($id);
        foreach ($brand->products as $product) {
            $product->update([
                'brand_id'=>$newBrand->id
            ]);
        }
        $brand->delete();
        return response()->json(['msg' => 'deleted successfully'], 200);
    }

}
