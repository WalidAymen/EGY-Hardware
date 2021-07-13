<?php

namespace App\Http\Controllers\api;

use App\Http\Controllers\Controller;
use App\Http\Resources\OrderResource;
use App\Models\Governorates;
use App\Models\Order;
use App\Models\Product;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;

class OrderController extends Controller
{
    public function show($id)
    {
        $user = Auth::user();
        if ($user->orders->where('id', $id)->first() != null) {
            $order = Order::findOrFail($id);
            $products = $order->products()->get();
            return new OrderResource($order);
        }
        return response()->json(['msg' => '404 order not found'], 404);


    }
    public function confirmOrder()
    {
        $user = Auth::user();
        if ($user->address != null && $user->city != null && $user->phone != null) {
            $cart = $user->cart;
            $products = $cart->products()->get();
            $gov = Governorates::where('name', "$user->city")->first();
            $shipping = $gov->shipping_cost;
            $totalPrice = $cart->total_price + $shipping;
            $order = Order::create([
                'user_id' => $user->id,
                'total_price' => $totalPrice,
            ]);
            foreach ($products as $product) {
                $order->products()->attach($product->id);
                $order->products()->updateExistingPivot($product->id, [
                    'count' => $product->pivot->count
                ]);
            }
            $cart->products()->detach();
            $cart->update([
                'total_price' => 0
            ]);
            return response()->json(['msg' => 'order submitted successfully','order'=>new OrderResource($order)], 200);

        }
        return response()->json(['msg' => 'address and city is requerd to submit order'], 406);

    }
    public function return($id)
    {
        $order = Order::findOrFail($id);
        $order->update([
            'status' => 'request return'
        ]);
        return response()->json(['msg' => 'request order return successfully waitting for admin response'], 200);
    }
    public function allOrders()
    {
        $orders = Order::orderBy('id', 'DESC')->get();

        return OrderResource::collection($orders);
    }
    public function pindingOrders()
    {
        $orders = Order::where('status', 'pending')->get();

        return OrderResource::collection($orders);

    }
    public function returnOrders()
    {
        $orders = Order::where('status', 'request return')->get();


        return OrderResource::collection($orders);

    }
    public function delete($id)
    {
        $order = Order::findOrFail($id);
        $order->products()->detach();
        $order->delete();
        return response()->json(['msg' => 'order deleted successfully'], 200);
    }
    public function update($id, Request $request)
    {
        $order = Order::findOrFail($id);
        $validator = Validator::make($request->all(), [
            'status'=>'string|in:pending,canceled,completed,shipped,declined,request return'
        ]);
        if ($validator->fails()) {
            return response()->json(['errors' => $validator->errors()], 406);
        }
        $order->update([
            'status' => $request->status
        ]);
        return response()->json(['msg' => 'order status updated successfully'], 200);

    }
    public function adminShow($id)
    {
        $order = Order::findOrFail($id);
        $products = $order->products()->get();
        return new OrderResource($order);
    }

    public function drop($orderId, $productId)
    {
        $order = Order::findOrFail($orderId);
        $totalPrice = $order->total_price;
        $productPrice = Product::findOrFail($productId)->price;
        $totalPrice -= $productPrice;
        $order->update([
            'total_price' => $totalPrice
        ]);
        $productsCount = $order->products()->where('product_id', $productId)->first()->pivot->count;
        if ($productsCount == 1) {
            $order->products()->detach($productId);
            return response()->json(['msg' => 'product dropped from order successfully'], 200);
        } else {
            $productsCount -= 1;
            $order->products()->updateExistingPivot($productId, [
                'count' => $productsCount
            ]);
            return response()->json(['msg' => 'product dropped from order successfully'], 200);
        }
    }
}
