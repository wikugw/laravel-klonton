<?php

namespace App\Http\Controllers;

use App\Models\Category;
use Illuminate\Http\Request;
use App\Models\Product;
use Auth;
use App\Models\Cart;
use App\Models\Cart_detail;
use App\Models\City;
use App\Models\Transaction;
use App\Models\Transaction_detail;
use App\Models\Store;
use App\Models\Address;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        $this->data['products'] = Product::where('is_available', '1')->get();
        $this->data['categories'] = Category::all();
        $this->data['carts'] = Cart::where('user_id', Auth::user()->id)->get();
        // return $this->data['carts'];
        $cart_ids[] = 0;
        foreach ($this->data['carts'] as $cart) {
            $cart_ids[] = $cart->id;
        }
        $this->data['cart_details'] = Cart_detail::whereIn('cart_id', $cart_ids)->get();
        return view('user.shop', $this->data);
    }

    public function category($id)
    {
        $this->data['products'] = Product::where('category_id', $id)->where('is_available', '1')->get();
        $this->data['categories'] = Category::all();
        $this->data['carts'] = Cart::where('user_id', Auth::user()->id)->get();
        $cart_ids[] = 0;
        foreach ($this->data['carts'] as $cart) {
            $cart_ids[] = $cart->id;
        }
        $this->data['cart_details'] = Cart_detail::whereIn('cart_id', $cart_ids)->get();
        return view('user.shop', $this->data);
    }

    public function transactions()
    {
        $this->data['carts'] = Cart::where('user_id', Auth::user()->id)->get();
        $cart_ids[] = 0;
        foreach ($this->data['carts'] as $cart) {
            $cart_ids[] = $cart->id;
        }
        $this->data['cart_details'] = Cart_detail::whereIn('cart_id', $cart_ids)->get();

        $this->data['transactions'] = Transaction::where('user_id', Auth::user()->id)->get();

        $transaction_ids[] = 0;
        foreach ($this->data['transactions'] as $transaction) {
            $transaction_ids[] = $transaction->id;
        }
        $this->data['transaction_details'] = Transaction_detail::whereIn('transaction_id', $transaction_ids)->orderBy('created_at', 'DESC')->get();

        return view('user.transactions', $this->data);
    }

    public function getCitiesAjax($id)
    {
        $cities = City::where('province_id', '=', $id)->pluck('city_name', 'id');

        return json_encode($cities);
    }

    public function success()
    {
        $this->data['carts'] = Cart::where('user_id', Auth::user()->id)->get();
        // return $this->data['carts'];
        $cart_ids[] = 0;
        foreach ($this->data['carts'] as $cart) {
            $cart_ids[] = $cart->id;
        }
        $this->data['cart_details'] = Cart_detail::whereIn('cart_id', $cart_ids)->get();
        return view('user.success', $this->data);
    }

    public function receive($id)
    {
        $transaction = Transaction::findOrFail($id);
        $transaction->status = 4;
        $transaction->save();
        return redirect()->route('home.transactions');
    }

    public function stores()
    {
        $this->data['stores'] = Store::all();
        $this->data['carts'] = Cart::where('user_id', Auth::user()->id)->get();

        $cart_ids[] = 0;
        foreach ($this->data['carts'] as $cart) {
            $cart_ids[] = $cart->id;
        }
        $this->data['cart_details'] = Cart_detail::whereIn('cart_id', $cart_ids)->get();

        $store_ids[] = 0;
        foreach ($this->data['stores'] as $store) {
            $store_ids[] = $store->id;
        }
        $this->data['store_addresses'] = Address::whereIn('store_id', $store_ids)->get();

        foreach ($this->data['stores'] as $store) {
            $store_ids[] = $store->id;
        }

        // return $this->data['store_addresses'];
        return view('user.stores', $this->data);
    }

    public function store($id)
    {
        $this->data['store'] = Store::findOrFail($id);
        $this->data['address'] = Address::where('store_id', $id)->first();
        $this->data['products'] = Product::where('store_id', $id)->where('is_available', 1)->get();
        $this->data['transactions'] = Transaction::where('store_id', $id)->where('status', 4)->get();

        $this->data['carts'] = Cart::where('user_id', Auth::user()->id)->get();
        $cart_ids[] = 0;
        foreach ($this->data['carts'] as $cart) {
            $cart_ids[] = $cart->id;
        }
        $this->data['cart_details'] = Cart_detail::whereIn('cart_id', $cart_ids)->get();

        // return $this->data;
        return view('user.store', $this->data);
    }
}
