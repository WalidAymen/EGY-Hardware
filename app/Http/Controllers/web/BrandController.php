<?php

namespace App\Http\Controllers\web;

use App\Http\Controllers\Controller;
use App\Models\Brand;
use App\Models\Product;
use Illuminate\Http\Request;

class BrandController extends Controller
{
    public function show($id)
    {
        $brand = Brand::find($id);
        if ($brand != null) {
            $products = Product::where('brand_id', '=', $id)->paginate(9);
            return view('products.multi', [
                'products' => $products,
                'tittle' => $brand->name
            ]);
        }
        return redirect(url('/index'));
    }
    public function all()
    {
        $brands = Brand::all();
        return view('DashBoard.Brands.allBrands', [
            'brands' => $brands
        ]);
    }
    public function add(Request $request)
    {
        $request->validate([
            'name'=>'unique:brands,name'
        ]);
        Brand::create([
            'name' => $request->name
        ]);
        return redirect()->back();

    }
    public function edit($id, Request $request)
    {
        $brand = Brand::findOrFail($id);
        $request->validate([
            'name'=>"unique:brands,name,$brand->id"
        ]);
        $brand->update([
            'name' => $request->name
        ]);
        return redirect()->back();

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
        return redirect()->back();
    }

    public function search(Request $request)
    {
        if ($request->keyword ==null) {
            $brands = Brand::all();
            return view('DashBoard.Brands.allBrands', [
                'brands' => $brands,
                'keyword'=>$request->keyword
            ]);
        }
        $brands = Brand::where('name','like',"%".$request->keyword."%")->get();
            return view('DashBoard.Brands.allBrands', [
                'brands' => $brands,
                'keyword'=>$request->keyword
            ]);
    }

}
