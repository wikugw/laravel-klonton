<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Store;
use App\Models\Product;
use App\Http\Requests\StoreRequest;
use App\User;
use Str;
use Auth;
use Session;
use App\Models\Address;
use App\Models\Store_bank;
use App\Models\Cart;
use App\Models\Cart_detail;
use App\Models\Transaction;
use App\Models\Transaction_detail;
use App\Models\Province;
use App\Models\City;
use App\Notifications\konfirmasiPembayaran;
use App\Notifications\UserNotification;

class StoreController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $this->data['stores'] = Store::all();

        return view('admin.stores.index', $this->data);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $this->data['provinces'] = Province::all();
        $this->data['cities'] = City::all();

        return view('admin.stores.create', $this->data);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $params = $request->except('_token');
        $params['slug'] = Str::slug($params['name']);
        $params['user_id'] = Auth::user()->id;
        $params['is_active'] = '0';

        if ($request->has('profile_toko') && $request->profile_toko != "undefined") {
            $profile_toko = $request->file('profile_toko');
            $extension = $profile_toko->getClientOriginalExtension();
            $filename = $params['slug'] . time() . '.' . $extension;
            $profile_toko->storeAs('public/profile_toko', $filename);
            $path_profile_toko = 'profile_toko' . '/' . $filename;
            $params['profile'] = $path_profile_toko;
        }

        if ($request->has('foto_ktp') && $request->foto_ktp != "undefined") {
            $foto_ktp = $request->file('foto_ktp');
            $extension = $foto_ktp->getClientOriginalExtension();
            $filename = $params['slug'] . time() . '.' . $extension;
            $foto_ktp->storeAs('public/foto_ktp', $filename);
            $path_foto_ktp = 'foto_ktp' . '/' . $filename;
            $params['foto_ktp'] = $path_foto_ktp;
        }

        $this->data['store'] = Store::create($params)->id;

        $toko_user = User::findOrFail(Auth::user()->id);
        $toko_user->store_id = $this->data['store'];
        $toko_user->save();

        $params['store_id'] = $this->data['store'];
        Address::create($params);
        Store_bank::create($params);

        $store = Store::findOrFail($toko_user->store_id);
        $store['for'] = "admin";
        $store['message'] = auth()->user()->name . " mengajukan pembuatan toko, segera cek dan verifikasi!";
        // return $store;
        User::find(2)->notify(new konfirmasiPembayaran($store));

        Session::flash('success', 'Toko telah dibuat, menunggu persetujuan admin');

        return redirect()->route('stores.show', $this->data);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $this->data['store'] = Store::findOrFail($id);
        $this->data['products'] = Product::where('store_id', $this->data['store']->id)->get();
        $this->data['address'] = Address::where('store_id', $this->data['store']->id)->first();
        // $this->data['store_bank'] =
        return view('admin.stores.show', $this->data);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $this->data['provinces'] = Province::all();
        $this->data['cities'] = City::all();

        $this->data['store'] = Store::findOrFail($id);
        $this->data['address'] = Address::where('store_id', $id)->first();
        return view('admin.stores.edit', $this->data);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(StoreRequest $request, $id)
    {
        $params = $request->except('_token');
        $params['slug'] = Str::slug($params['name']);

        if ($request->has('profile_toko') && $request->profile_toko != "undefined") {
            $profile_toko = $request->file('profile_toko');
            $extension = $profile_toko->getClientOriginalExtension();
            $filename = $params['slug'] . time() . '.' . $extension;
            $profile_toko->storeAs('public/profile_toko', $filename);
            $path_profile_toko = 'profile_toko' . '/' . $filename;
            $params['profile'] = $path_profile_toko;
        }

        if ($request->has('foto_ktp') && $request->foto_ktp != "undefined") {
            $foto_ktp = $request->file('foto_ktp');
            $extension = $foto_ktp->getClientOriginalExtension();
            $filename = $params['slug'] . time() . '.' . $extension;
            $foto_ktp->storeAs('public/foto_ktp', $filename);
            $path_foto_ktp = 'foto_ktp' . '/' . $filename;
            $params['foto_ktp'] = $path_foto_ktp;
        }

        $store = Store::findOrFail($id);

        $store->update($params);

        $address = Address::where('store_id', $id)->first();
        $params['store_id'] = $id;
        $address->update($params);

        Session::flash('success', 'Toko berhasil diupdate');

        return redirect()->route('stores.show', $id);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        // mencari toko
        $store = Store::findOrfail($id);
        // mencari produk
        $products = Product::where('store_id', $id)->get();
        // mencari alamat toko
        $store_address = Address::where('store_id', $id)->first();
        // mencari cart dengan toko
        $carts = Cart::where('store_id', $id)->get();
        // mencari cart_detail yang ada pada toko
        $cart_ids[] = 0;
        foreach ($carts as $cart) {
            $cart_ids[] = $cart->id;
        }
        $cart_details = Cart_detail::whereIn('cart_id', $cart_ids)->get();
        // mencari store_bank
        $store_banks = Store_bank::where('store_id', $id)->get();

        $transactions = Transaction::where('store_id', $id)->get();
        $transaction_ids[] = 0;
        foreach ($transactions as $transaction) {
            $transaction_ids[] = $transaction->id;
        }
        $transaction_details = Transaction_detail::whereIn('transaction_id', $transaction_ids)->get();

        // mencari pengguna toko
        $user = User::findOrFail($store->user_id);
        $user->store_id = null;
        $user->save();

        // menghapus store bank
        if (!$store_banks->isEmpty()) {
            foreach ($store_banks as $store_bank) {
                $store_bank->delete($store_bank->id);
            }
        } else {
            // return "gada";
        }
        // menghapus $cart_details
        if (!$cart_details->isEmpty()) {
            foreach ($cart_details as $cart_detail) {
                $cart_detail->delete($cart_detail->id);
            }
        } else {
            // return "cart detail gada";
        }
        // menghapus $cart_details
        if (!$carts->isEmpty()) {
            foreach ($carts as $cart) {
                $cart->delete($cart->id);
            }
        } else {
            // return "cart gada";
        }
        // menghapus $cart_details
        if ($store_address) {
            $store_address->delete($store_address->id);
        } else {
            // return "alamat gada";
        }
        // menghapus products
        if (!$products->isEmpty()) {
            foreach ($products as $product) {
                $product->delete($product->id);
            }
        } else {
            // return "product gada";
        }

        if (!$transaction_details->isEmpty()) {
            foreach ($transaction_details as $transaction_detail) {
                $transaction_detail->delete($transaction_detail->id);
            }
        } else {
            // return "transaction detail gada";
        }

        // menghapus $cart_details
        if (!$transactions->isEmpty()) {
            foreach ($transactions as $transaction) {
                $transaction->delete($transaction->id);
            }
        } else {
            // return "cart gada";
        }

        $store->delete();

        Session::flash('success', 'Toko berhasil dihapus!');

        return redirect()->route('stores.index');
    }

    public function activate($id)
    {
        $params = Store::findOrFail($id);
        $params->is_active = '1';
        $params->save();

        $store = Store::findOrFail($id);
        $store['for'] = "admin";
        $store['message'] = "Toko anda telah diverifikasi, segera tambahkan produk!";
        User::find($store->user_id)->notify(new konfirmasiPembayaran($store));


        Session::flash('success', 'Toko telah diaktivasi');
        return redirect()->route('stores.index');
    }

    public function store_products($id)
    {
        $this->data['products'] = Product::where('store_id', $id)->get();
        $this->data['store'] = Store::findOrFail(Auth::user()->store_id);
        return view('admin.products.index', $this->data);
    }

    public function store_banks($id)
    {
        $this->data['store_banks'] = Store_bank::where('store_id', $id)->get();
        return view('admin.store_banks.index', $this->data);
    }

    public function transactions($id)
    {
        $this->data['transactions'] = Transaction::where('store_id', $id)->orderBy('created_at', 'DESC')->get();

        $transaction_ids[] = 0;
        foreach ($this->data['transactions'] as $transaction) {
            $transaction_ids[] = $transaction->id;
        }
        $this->data['transaction_details'] = Transaction_detail::whereIn('transaction_id', $transaction_ids)->orderBy('id', 'DESC')->get();
        // return $this->data;
        return view('admin.transactions.index', $this->data);
    }
}
