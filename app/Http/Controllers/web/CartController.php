<?php

namespace App\Http\Controllers\web;

use App\Http\Controllers\Controller;
use App\Models\Cart;
use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CartController extends Controller
{
    public function add($productId)
    {
        $user = Auth::user();
        if ($user->cart == null) {
            Cart::create([
                'user_id' => $user->id,
            ]);
        }
        $cart = $user->cart;
        $totalPrice = $cart->total_price;
        $productPrice = Product::findOrFail($productId)->price;
        $totalPrice += $productPrice;
        $cart->update([
            'total_price' => $totalPrice
        ]);
        if ($cart->products()->where('product_id', $productId)->first() == null) {
            $cart->products()->attach($productId);
        } else {
            $productsCount = $cart->products()->where('product_id', $productId)->first()->pivot->count;


            $productsCount += 1;
            $cart->products()->updateExistingPivot($productId, [
                'count' => $productsCount
            ]);
        }

        return redirect()->back();
    }
    public function show($id)
    {
        $cart = Cart::findOrFail($id);
        $products = $cart->products()->get();
        return view('carts.show', [
            'totalPrice' => $cart->total_price,
            'products' => $products,
            'tittle' => 'Cart'
        ]);
    }
    public function dropFromCart($id)
    {

        $user = Auth::user();
        $cart = $user->cart;
        $totalPrice = $cart->total_price;
        $productPrice = Product::findOrFail($id)->price;
        $totalPrice -= $productPrice;
        $cart->update([
            'total_price' => $totalPrice
        ]);
        $productsCount = $cart->products()->where('product_id', $id)->first()->pivot->count;
        if ($productsCount == 1) {
            $cart->products()->detach($id);
            return redirect()->back();
        } else {
            $productsCount -= 1;
            $cart->products()->updateExistingPivot($id, [
                'count' => $productsCount
            ]);
            return redirect()->back();
        }
    }
    public function clearCart()
    {
        $user = Auth::user();
        $cart = $user->cart;
        $cart->products()->detach();
        $cart->update([
            'total_price'=>0
        ]);

        return redirect(url('/index'));
    }
}
