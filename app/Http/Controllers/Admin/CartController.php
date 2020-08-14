<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Product;
use Illuminate\Http\Request;
use Auth;
use App\Models\Cart;
use App\Models\Cart_detail;
use Session;

class CartController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $this->data['carts'] = Cart::where('user_id', Auth::user()->id)->get();
        $cart_ids[] = 0;
        foreach ($this->data['carts'] as $cart) {
            $cart_ids[] = $cart->id;
        }
        $this->data['cart_details'] = Cart_detail::whereIn('cart_id', $cart_ids)->get();

        return view('user.cart', $this->data);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $cart_detail = Cart_detail::findOrfail($id);
        $cart_detail['quantity'] = 0;
        $cart_detail->save();
        $cart_detail->delete();
        return redirect()->back();
    }

    public function add($id)
    {
        $product = Product::findOrFail($id);

        $cart = Cart::where([
            ['user_id', '=', Auth::user()->id],
            ['store_id', '=', $product->store_id]
        ])->first();

        if ($cart !== null) {
            $cart = $cart->id;
        } else {
            $cart['user_id'] = Auth::user()->id;
            $cart['store_id'] = $product->store_id;
            $cart = Cart::create($cart)->id;
        }

        // return $cart;

        $cart_detail['cart_id'] = $cart;
        $cart_detail['product_id'] = $product->id;

        $cart_detail['quantity'] = Cart_detail::where('cart_id', $cart)->where('product_id', $product->id)->first();
        // return $cart_detail['quantity'];

        if ($cart_detail['quantity'] !== null) {
            $cart_detail = Cart_detail::findOrFail($cart_detail['quantity']->id);
            $quantity_now = (int)$cart_detail['quantity'];
            $quantity_now += 1;
            $cart_detail['quantity'] = $quantity_now;
            $cart_detail->save();
        } else {
            $cart_detail['quantity'] = 1;
            Cart_detail::create($cart_detail);
        }

        return redirect()->route('carts.index');
    }

    public function increment_quantity($id)
    {
        $params = Cart_detail::findOrFail($id);
        $quantity_now = (int)$params['quantity'];
        $quantity_now += 1;
        $params['quantity'] = $quantity_now;
        $params->save();

        return redirect()->back();
    }

    public function decrement_quantity($id)
    {
        $params = Cart_detail::findOrFail($id);
        $quantity_now = (int)$params['quantity'];
        $quantity_now -= 1;
        $params['quantity'] = $quantity_now;
        $params->save();

        return redirect()->back();
    }
}
