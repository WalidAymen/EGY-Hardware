<?php

namespace App\Http\Controllers\api;

use App\Http\Controllers\Controller;
use App\Http\Resources\CatResource;
use App\Http\Resources\ProductResource;
use App\Models\Cat;
use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class CatController extends Controller
{
    public function show($id)
    {
        $cat=Cat::find($id);
        if ($cat!=null) {
            $products=Product::where('cat_id', '=', $id)->paginate(9);
            return ProductResource::collection($products);
        }
        return response()->json(['msg' => '404 not found'], 404);
    }
    public function all()
    {
        $cats = Cat::all();
        return CatResource::collection($cats);

    }
    public function add(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'name'=>'unique:cats,name'
        ]);
        if ($validator->fails()) {
            return response()->json(['errors' => $validator->errors()], 406);
        }
        $cat=Cat::create([
            'name' => $request->name
        ]);
        return response()->json(['msg' => 'created successfully','category'=>new CatResource($cat)], 201);

    }
    public function edit($id, Request $request)
    {
        $cat = Cat::findOrFail($id);
        $validator = Validator::make($request->all(), [
            'name'=>"unique:cats,name,$cat->id"
        ]);
        if ($validator->fails()) {
            return response()->json(['errors' => $validator->errors()], 406);
        }
        $cat->update([
            'name' => $request->name
        ]);
        return response()->json(['msg' => 'updated successfully','category'=>new CatResource($cat)], 200);

    }
    public function delete($id)
    {
        if ((Cat::where('name','No Category')->first())==null)
        {
            Cat::create([
                'name' => 'No Category'
            ]);
        }
        $newCat=Cat::where('name','No Category')->first();
        $cat = Cat::findOrFail($id);
        foreach ($cat->products as $product) {
            $product->update([
                'cat_id'=>$newCat->id
            ]);
        }
        $cat->delete();
        return response()->json(['msg' => 'deleted successfully'], 200);
    }
}
