<?php

namespace App\Http\Controllers\web;

use App\Http\Controllers\Controller;
use App\Models\Brand;
use App\Models\Cart;
use App\Models\Cat;
use App\Models\Order;
use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

class ProductController extends Controller
{
    public function index()
    {

        $user = Auth::user();
        if ($user != null && $user->cart == null) {
            Cart::create([
                'user_id' => $user->id
            ]);
        }
        $products = Product::orderBy('id', 'desc')->paginate(9);
        return view('products.multi', [
            'products' => $products,
            'tittle' => 'EGY-Hardware'
        ]);
    }

    public function search(Request $request)
    {
        $user = Auth::user();
        if ($user != null && $user->cart == null) {
            Cart::create([
                'user_id' => $user->id
            ]);
        }
        if ($request->keyword != null) {
            $products = Product::where('name', 'like', '%' . $request->keyword . '%')->orderBy('id', 'desc')->paginate(9);
            return view('products.multi', [
                'products' => $products,
                'tittle' => $request->keyword
            ]);
        }
        return redirect()->back();
    }
    public function show($id)
    {
        $user = Auth::user();
        if ($user != null && $user->cart == null) {
            Cart::create([
                'user_id' => $user->id
            ]);
        }
        $product = Product::find($id);
        if ($product != null) {
            $brandProducts = Product::inRandomOrder()->where('brand_id', '=', $product->brand->id)->where('id', '!=', $id)->limit(6)->get();
            $productsBrandCount = count($brandProducts);
            $catProducts = Product::inRandomOrder()->where('cat_id', '=', $product->cat->id)->limit(6)->get();
            $productsCatCount = count($catProducts);
            return view('products.single', [
                'product' => $product,
                'brandProducts' => $brandProducts,
                'productsBrandCount' => $productsBrandCount,
                'catProducts' => $catProducts,
                'productsCatCount' => $productsCatCount
            ]);
        }
        return redirect(url('/index'));
    }
    public function adminAll()
    {
        $cats = Cat::all();
        $brands = Brand::all();
        $products = Product::orderBy('id', 'desc')->paginate(12);
        return view('DashBoard.Products.allProducts', [
            'products' => $products,
            'cats' => $cats,
            'brands' => $brands,
        ]);
    }
    public function filter(Request $request)
    {
        $cats = Cat::all();
        $brands = Brand::all();
        if ($request->keyword != null) {
            if ($request->brand == 'All' && $request->cat == 'All') {
                $products = Product::where('name', 'like', "%" . $request->keyword . "%")->orderBy('id', 'desc')->paginate(12);
            } elseif ($request->brand == 'All' && $request->cat != 'All') {
                $cat = Cat::where('name', $request->cat)->first();
                $products = Product::where('name', 'like', "%" . $request->keyword . "%")->where('cat_id', $cat->id)->orderBy('id', 'desc')->paginate(12);
            } elseif ($request->brand != 'All' && $request->cat == 'All') {
                $brand = Brand::where('name', $request->brand)->first();
                $products = Product::where('name', 'like', "%" . $request->keyword . "%")->where('brand_id', $brand->id)->orderBy('id', 'desc')->paginate(12);
            } else {
                $cat = Cat::where('name', $request->cat)->first();
                $brand = Brand::where('name', $request->brand)->first();
                $products = Product::where('name', 'like', "%" . $request->keyword . "%")->where('brand_id', $brand->id)->where('cat_id', $cat->id)->orderBy('id', 'desc')->paginate(12);
            }
        } else {
            if ($request->brand == 'All' && $request->cat == 'All') {
                $products = Product::orderBy('id', 'desc')->paginate(12);
            } elseif ($request->brand == 'All' && $request->cat != 'All') {
                $cat = Cat::where('name', $request->cat)->first();
                $products = Product::where('cat_id', $cat->id)->orderBy('id', 'desc')->paginate(12);
            } elseif ($request->brand != 'All' && $request->cat == 'All') {
                $brand = Brand::where('name', $request->brand)->first();
                $products = Product::where('brand_id', $brand->id)->orderBy('id', 'desc')->paginate(12);
            } else {
                $cat = Cat::where('name', $request->cat)->first();
                $brand = Brand::where('name', $request->brand)->first();
                $products = Product::where('brand_id', $brand->id)->where('cat_id', $cat->id)->orderBy('id', 'desc')->paginate(12);
            }
        }
        return view('DashBoard.Products.allProducts', [
            'products' => $products,
            'cats' => $cats,
            'brands' => $brands,
            'sbrand' => $request->brand,
            'scat' => $request->cat,
            'keyword' => $request->keyword,

        ]);
    }
    public function adminSearch(Request $request)
    {
        $cats = Cat::all();
        $brands = Brand::all();
        if ($request->brand == 'All' && $request->cat == 'All') {
            $products = Product::where('name', 'like', "%" . $request->keyword . "%")->orderBy('id', 'desc')->paginate(12);
        } elseif ($request->brand == 'All' && $request->cat != 'All') {
            $cat = Cat::where('name', $request->cat)->first();
            $products = Product::where('name', 'like', "%" . $request->keyword . "%")->where('cat_id', $cat->id)->orderBy('id', 'desc')->paginate(12);
        } elseif ($request->brand != 'All' && $request->cat == 'All') {
            $brand = Brand::where('name', $request->brand)->first();
            $products = Product::where('name', 'like', "%" . $request->keyword . "%")->where('brand_id', $brand->id)->orderBy('id', 'desc')->paginate(12);
        } else {
            $cat = Cat::where('name', $request->cat)->first();
            $brand = Brand::where('name', $request->brand)->first();
            $products = Product::where('name', 'like', "%" . $request->keyword . "%")->where('brand_id', $brand->id)->where('cat_id', $cat->id)->orderBy('id', 'desc')->paginate(12);
        }


        return view('DashBoard.Products.allProducts', [
            'products' => $products,
            'cats' => $cats,
            'brands' => $brands,
            'keyword' => $request->keyword,
            'sbrand' => $request->brand,
            'scat' => $request->cat,
        ]);
    }
    public function addProductForm()
    {
        $cats=Cat::all();
        $brands=Brand::all();
        return view('DashBoard.Products.addProduct',[
            'brands'=>$brands,
            'cats'=>$cats,
        ]);
    }
    public function addProduct(Request $request)
    {

       // dd(Storage::disk('uploads'));

        $request->validate([
            'name'=>'required|string|max:255',
            'model'=>'nullable|string|max:255',
            'discreption'=>'nullable|string|max:255',
            'price'=>'required|numeric|max:999999.99',
            'sale_price'=>'nullable|numeric|max:999999.99',
            'brand'=>'required|numeric',
            'category'=>'required|numeric',
            'image'=>'required|image|max:20480|mimes:png,jpg,jpeg'
        ]);
        if ($request->stock == 'on') {
            $stock='in Stock';
        }else
        {
            $stock='out of stock';

        }
        $imgPath=Storage::disk('uploads')->put("products",$request->image);
        Product::create([
            'name'=>$request->name,
            'img'=>$imgPath,
            'price'=>$request->price,
            'sale_price'=>$request->sale_price,
            'discreption'=>$request->discreption,
            'brand_id'=>$request->brand,
            'cat_id'=>$request->category,
            'model'=>$request->model,
            'stock'=>$stock,
        ]);
        return redirect(url("/admin/allproducts"));
    }
    public function editProductForm($id)
    {
        $product=Product::findOrFail($id);
        $cats=Cat::all();
        $brands=Brand::all();
        return view('DashBoard.Products.editProduct',[
            'product'=>$product,
            'brands'=>$brands,
            'cats'=>$cats,
        ]);
    }
    public function editProduct(Request $request,$id)
    {
        $product=Product::findOrFail($id);
        $request->validate([
            'name'=>'required|string|max:255',
            'model'=>'nullable|string|max:255',
            'discreption'=>'nullable|string|max:255',
            'price'=>'required|numeric|max:999999.99',
            'sale_price'=>'nullable|numeric|max:999999.99',
            'brand'=>'required|numeric',
            'category'=>'required|numeric',
            'image'=>'nullable|image|max:20480|mimes:png,jpg,jpeg'
        ]);
        if ($request->stock == 'on') {
            $stock='in Stock';
        }else
        {
            $stock='out of stock';

        }
        if ($request->image == null) {
            $imgPath=$product->img;
        }
        else{
            Storage::disk('uploads')->delete($product->img);
            $imgPath=Storage::disk('uploads')->put("products", $request->image);
        }
        $product->update([
            'name'=>$request->name,
            'img'=>$imgPath,
            'price'=>$request->price,
            'sale_price'=>$request->sale_price,
            'discreption'=>$request->discreption,
            'brand_id'=>$request->brand,
            'cat_id'=>$request->category,
            'model'=>$request->model,
            'stock'=>$stock,
        ]);
        return redirect(url("/admin/allproducts"));
    }

    public function deleteProduct($id)
    {
        $product=Product::findOrFail($id);
        if ($product->carts()->first() != null && $product->orders()->first() != null) {
            $cats=Cat::all();
            $brands=Brand::all();
            $products = Product::orderBy('id', 'desc')->paginate(12);

            return view('DashBoard.Products.allProducts',[
                'brands'=>$brands,
                'products'=>$products,
                'cats'=>$cats,
                'custom_error'=>"This product is in order/cart you can't delete it"
            ]);
        }

        $product->delete();

        return redirect()->back();
    }

}
