<?php

namespace App\Http\Controllers\Site;

use App\Http\Controllers\Controller;
use App\Http\Requests\Site\CartRequest;
use App\Services\Site\CartService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;

//use Session;

class CartController extends Controller
{
    protected $cartService;

    public function __construct(CartService $cartService)
    {
        $this->cart = $cartService;
    }

    public function index(Request $request)
    {
        $nav = 'Cart';
        $sub_nav = '';
        $data = $this->cart->List();
        return view('site.cart.list', compact('nav', 'sub_nav'), $data);

    }

    public function cartAdd(CartRequest $request)
    {
        $message = $this->cart->cartAdd($request->validated());
        return redirect()->route('cart')->withMessage($message);

    }

    public function delete($id)
    {
        $message = $this->cart->delete($id);
        return redirect()->route('cart')->withMessage($message);

    }

    public function stripe()
    { 
        $nav = 'Cart';
        $sub_nav = '';
        $data = array();
        return view('site.cart.stripe', compact('nav', 'sub_nav'), $data);

    }

    public function stripePost(Request $request)
    {
       return  $this->cart->stripePost($request);
    }

    public function success()
    {
        $nav = 'Cart';
        $sub_nav = '';
        return view('site.cart.success', compact('nav', 'sub_nav'));
    }


}
