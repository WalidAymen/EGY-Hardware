<?php

namespace App\Http\Controllers\api;

use App\Http\Controllers\Controller;
use App\Http\Resources\CartResource;
use App\Models\Cart;
use App\Models\Product;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CartController extends Controller
{
    public function add($productId,Request $request)
    {
        $user = auth()->user();
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

        return response()->json(['msg' => 'prodect added to cart successfully'], 200);
    }
    public function show()
    {
        $user=Auth::user();
        if ($user == null) {
            return response()->json(['msg' => '404 user not found'], 404);
        }
        $cart = $user->cart;
        if ($cart == null) {
            return response()->json(['msg' => '404 cart not found'], 404);
        }
        return new CartResource($cart);
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
            return response()->json(['msg' => 'prodect deleted from cart successfully'], 200);
        } else {
            $productsCount -= 1;
            $cart->products()->updateExistingPivot($id, [
                'count' => $productsCount
            ]);
            return response()->json(['msg' => 'prodect deleted from cart successfully'], 200);
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

        return response()->json(['msg' => 'cleared cart successfully'], 200);
    }
}
