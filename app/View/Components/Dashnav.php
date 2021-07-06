<?php

namespace App\View\Components;

use App\Models\Messages;
use Illuminate\Support\Facades\Auth;
use Illuminate\View\Component;

class Dashnav extends Component
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
        $sMessages=Messages::orderBy('id','DESC')->limit(5)->get();
        return view('components.dashnav',[
            'user'=>$user,
            'messages'=>$sMessages
        ]);
    }
}
