<?php

namespace App\View\Components;

use App\Models\Cart;
use App\Models\Cat;
use Illuminate\Support\Facades\Auth;
use Illuminate\View\Component;

class Header extends Component
{
    /**
     * Create a new component instance.
     *
     * @return void
     */
    public function __construct()
    {
        //
    }

    /**
     * Get the view / contents that represent the component.
     *
     * @return \Illuminate\Contracts\View\View|\Closure|string
     */
    public function render()
    {
        $user=Auth::user();
        if($user!=null&&$user->cart==null)
        {
            Cart::create([
            'user_id'=>$user->id
        ]);
        }
        if($user!=null)
        {
            $cart=$user->cart;
            $cats=Cat::all();
            return view('components.header',[
                'cats'=>$cats,
                'cart'=>$cart,
                'user'=>$user
            ]);
        }
        $cats=Cat::all();
            return view('components.header',[
                'cats'=>$cats,
            ]);
    }
}
