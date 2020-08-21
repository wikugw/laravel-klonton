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
        $this->data['transaction_details'] = Transaction_detail::whereIn('transaction_id', $transaction_ids)->get();

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
}
