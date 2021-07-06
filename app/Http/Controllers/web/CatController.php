<?php

namespace App\Http\Controllers\web;

use App\Http\Controllers\Controller;
use App\Models\Cat;
use App\Models\Product;
use Illuminate\Http\Request;

class CatController extends Controller
{
    public function show($id)
    {
        $cat=Cat::find($id);
        if ($cat!=null) {
            $products=Product::where('cat_id', '=', $id)->paginate(9);
            return view('products.multi', [
            'products'=>$products,
            'tittle'=>$cat->name
        ]);
        }
        return redirect(url('/index'));
    }
    public function all()
    {
        $cats = Cat::all();
        return view('DashBoard.Cats.allCats', [
            'cats' => $cats
        ]);
    }
    public function add(Request $request)
    {
        $request->validate([
            'name'=>'unique:cats,name'
        ]);
        Cat::create([
            'name' => $request->name
        ]);
        return redirect()->back();

    }
    public function edit($id, Request $request)
    {
        $cat = Cat::findOrFail($id);
        $request->validate([
            'name'=>"unique:cats,name,$cat->id"
        ]);
        $cat->update([
            'name' => $request->name
        ]);
        return redirect()->back();

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
        return redirect()->back();
    }
    public function search(Request $request)
    {
        if ($request->keyword ==null) {
            $cats = Cat::all();
            return view('DashBoard.Cats.allCats', [
                'cats' => $cats,
                'keyword'=>$request->keyword
            ]);
        }
        $cats = Cat::where('name','like',"%".$request->keyword."%")->get();
            return view('DashBoard.Cats.allCats', [
                'cats' => $cats,
                'keyword'=>$request->keyword
            ]);
    }

}
