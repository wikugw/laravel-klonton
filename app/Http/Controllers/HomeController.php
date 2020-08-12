<?php

namespace App\Http\Controllers;

use App\Models\Category;
use Illuminate\Http\Request;
use App\Models\Store;
use App\Models\Product;
use Auth;

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
        if (Auth::user()->role_id == "1" && Auth::user()->store_id == "") {
            $this->data['stores'] = Store::All();
            return view('admin.stores.index', $this->data);
        } elseif (Auth::user()->role_id == "2" && Auth::user()->store_id == "") {
            $this->data['products'] = Product::all();
            $this->data['categories'] = Category::all();
            return view('user.shop', $this->data);
        } elseif (Auth::user()->role_id == "2" && Auth::user()->store_id !== "") {
            $this->data['store'] = Store::findOrFail(Auth::user()->store_id);
            $this->data['products'] = Product::where('store_id', $this->data['store']->id)->get();
            return view('admin.stores.show', $this->data);
        } else {
            return view('auth.login');
        }
    }
}
