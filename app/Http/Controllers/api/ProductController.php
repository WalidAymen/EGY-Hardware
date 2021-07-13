<?php

namespace App\Http\Controllers\api;

use App\Http\Controllers\Controller;
use App\Http\Resources\ProductResource;
use App\Models\Brand;
use App\Models\Cat;
use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Validator;

class ProductController extends Controller
{
    public function index()
    {
        $products = Product::all();
        return ProductResource::collection($products);
    }

    public function show($id)
    {
        $product = Product::find($id);
        if ($product != null) {
            return new ProductResource($product);
        }
        return response()->json(['msg' => '404 not found'], 404);
    }
    public function addProduct(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'name' => 'required|string|max:255',
            'model' => 'nullable|string|max:255',
            'discreption' => 'nullable|string|max:255',
            'stock' => 'required|string|max:50|in:in Stock,out of stock',
            'price' => 'required|numeric|max:999999.99',
            'sale_price' => 'nullable|numeric|max:999999.99',
            'brand_id' => 'required|numeric',
            'category_id' => 'required|numeric',
            'img' => 'required|image|max:20480|mimes:png,jpg,jpeg'
        ]);
        if ($validator->fails()) {
            return response()->json(['errors' => $validator->errors()], 406);
        }
        $imgPath = Storage::disk('uploads')->put("products", $request->img);
        $product=Product::create([
            'name' => $request->name,
            'img' => $imgPath,
            'price' => $request->price,
            'sale_price' => $request->sale_price,
            'discreption' => $request->discreption,
            'brand_id' => $request->brand_id,
            'cat_id' => $request->category_id,
            'model' => $request->model,
            'stock' => $request->stock,
        ]);
        return response()->json(['msg' => 'created successfully','product'=>new ProductResource($product)], 201);
    }
    public function editProduct(Request $request, $id)
    {
        $product = Product::find($id);
        if ($product == null) {
            return response()->json(['msg' => '404 not found'], 404);
        }
        $validator = Validator::make($request->all(), [
            'name' => 'required|string|max:255',
            'model' => 'nullable|string|max:255',
            'discreption' => 'nullable|string|max:255',
            'stock' => 'required|string|max:50|in:in Stock,out of stock',
            'price' => 'required|numeric|max:999999.99',
            'sale_price' => 'nullable|numeric|max:999999.99',
            'brand_id' => 'required|numeric',
            'category_id' => 'required|numeric',
            'img' => 'required|image|max:20480|mimes:png,jpg,jpeg'
        ]);
        if ($validator->fails()) {
            return response()->json(['errors' => $validator->errors()], 406);
        }
        if ($request->img == null) {
            $imgPath = $product->img;
        } else {
            Storage::disk('uploads')->delete($product->img);
            $imgPath = Storage::disk('uploads')->put("products", $request->img);
        }
        $product->update([
            'name' => $request->name,
            'img' => $imgPath,
            'price' => $request->price,
            'sale_price' => $request->sale_price,
            'discreption' => $request->discreption,
            'brand_id' => $request->brand_id,
            'cat_id' => $request->category_id,
            'model' => $request->model,
            'stock' => $request->stock,
        ]);
        return response()->json(['msg' => 'updated successfully','product'=>new ProductResource($product)], 200);
    }

    public function deleteProduct($id)
    {
        $product = Product::find($id);
        if ($product == null) {
            return response()->json(['msg' => '404 not found'], 404);
        }
        if ($product->carts()->first() != null && $product->orders()->first() != null) {
            return response()->json(['msg' => 'product is in carts/orders cannot be deleted'], 406);
        }
        Storage::disk('uploads')->delete($product->img);
        $product->delete();

        return response()->json(['msg' => 'deleted successfully'], 200);

    }
}
