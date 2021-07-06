<?php

namespace App\View\Components;

use App\Models\Brand;
use App\Models\Cat;
use Illuminate\View\Component;

class SideBar extends Component
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
        $brands=Brand::all();
        $cats=Cat::all();
        return view('components.side-bar',[
            'brands'=>$brands,
            'cats'=>$cats,
        ]);
    }
}
