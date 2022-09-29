<?php

namespace App\View\Components;

use Illuminate\View\Component;
use Jackiedo\Cart\Facades\Cart;
use App\Models\Wishlist;
use Session;

class HeaderComponent extends Component
{
    /**
     * Create a new component instance.
     *
     * @return void
     */
    public $cartcount = '';
    public function __construct()
    {
        $cartcount = Cart::name('shopping')->getItems();
        $this -> cartcount = $cartcount;
    }

    /**
     * Get the view / contents that represent the component.
     *
     * @return \Illuminate\Contracts\View\View|\Closure|string
     */
    public function render()
    {
        return view('components.header-component');
    }
}
