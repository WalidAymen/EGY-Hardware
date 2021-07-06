<?php

namespace App\View\Components;

use App\Models\Cat;
use Illuminate\Support\Facades\Auth;
use Illuminate\View\Component;

class Footer extends Component
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
        $cats=Cat::limit(5)->get();
        return view('components.footer',[
            'user'=>$user,
            'cats'=>$cats,
        ]);
    }
}
