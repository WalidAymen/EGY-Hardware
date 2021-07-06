<?php

namespace App\Http\Controllers\web;

use App\Http\Controllers\Controller;
use App\Models\Governorates;
use App\Models\Order;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class OrderController extends Controller
{
    public function show($id)
    {
        $user=Auth::user();
        if ($user->orders->where('id',$id)->first() !=null ) {
            $order = Order::findOrFail($id);
            $products = $order->products()->get();
        return view('orders.show', [
            'order'=>$order,
            'products' => $products,
            'tittle' => 'order'
        ]);
        }
        return redirect(url('showorders'));

    }
    public function checkOut()
    {
        $user = Auth::user();
        $cart = $user->cart;
        $products = $cart->products()->get();

        return view('orders.ceckOut', [
            'products' => $products,
            'user' => $user
        ]);
    }
    public function confirmOrderView()
    {
        $user = Auth::user();
        if ($user->address != null && $user->city != null && $user->phone != null) {
            $cart = $user->cart;
            $products = $cart->products()->get();
            $gov = Governorates::where('name', "$user->city")->first();
            $shipping = $gov->shipping_cost;
            $totalPrice = $cart->total_price + $shipping;
            return view('orders.confirmOrder', [
                'products' => $products,
                'user' => $user,
                'shipping' => $shipping,
                'totalPrice' => $totalPrice,
                'orderPrice' => $cart->total_price
            ]);
        }
        return redirect(url('/orderchangeaddress'));
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
            $order=Order::create([
                'user_id'=>$user->id,
                'total_price'=>$totalPrice,
            ]);
            foreach ($products as $product) {
                $order->products()->attach($product->id);
                $order->products()->updateExistingPivot($product->id, [
                    'count' => $product->pivot->count
                ]);
            }
            $cart->products()->detach();
            $cart->update([
                'total_price'=>0
            ]);
            return redirect(url('/showorders'));
        }
        return redirect(url('/orderchangeaddress'));
    }
    public function changeAddressForm()
    {
        $user = Auth::user();
        $govs = Governorates::all();
        return view('orders.modifAddress', [
            'user' => $user,
            'govs' => $govs
        ]);
    }
    public function changeAddress(Request $request)
    {
        $user = User::findOrFail(Auth::user()->id);
        $request->validate([
            'city' => 'required|string|max:255',
            'address' => 'required|string|max:255',
            'phone' => 'required|string|max:255',
        ]);
        $user->update([
            'city' => $request->city,
            'address' => $request->address,
            'phone' => $request->phone,
        ]);
        return redirect(url('/confirmorder'));
    }
    public function return($id)
    {
        $order=Order::findOrFail($id);
        $order->update([
            'status'=>'request return'
        ]);
        return redirect(url('/profile'));
    }
    public function allOrders()
    {
        $orders=Order::orderBy('id','DESC')->get();

        return view('DashBoard.Orders.allOrders',[
            'orders'=>$orders
        ]);
    }
    public function pindingOrders()
    {
        $orders=Order::where('status','pending')->get();

        return view('DashBoard.Orders.pindingOrders',[
            'orders'=>$orders
        ]);
    }
    public function returnOrders()
    {
        $orders=Order::where('status','request return')->get();


        return view('DashBoard.Orders.returnOrders',[
            'orders'=>$orders
        ]);
    }
    public function delete($id)
    {
        $order=Order::findOrFail($id);
        $order->products()->detach();
        $order->delete();
        return redirect()->back();
    }
    public function update($id,Request $request)
    {
        $order=Order::findOrFail($id);
        $order->update([
            'status'=>$request->status
        ]);
        return redirect()->back();
    }


}
