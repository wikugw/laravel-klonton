<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\User;
use App\Http\Requests\UserRequest;
use Session;
use App\Models\Store;
use App\Models\Cart;
use App\Models\Store_bank;
use App\Models\Cart_detail;
use App\Models\Transaction;
use App\Models\Transaction_detail;
use App\Models\Address;
use App\Models\Product;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $this->data['users'] = User::with('store')->get();
        return view('admin.users.index', $this->data);
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
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $this->data['user'] = User::findOrFail($id);
        return view('admin.users.show', $this->data);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $this->data['user'] = User::findOrFail($id);
        return view('admin.users.edit', $this->data);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(UserRequest $request, $id)
    {
        $params = $request->except('_token');

        if ($request->has('profile_photo') && $request->profile_photo != "undefined") {
            $profile_photo = $request->file('profile_photo');
            $extension = $profile_photo->getClientOriginalExtension();
            $filename = $params['name'] . time() . '.' . $extension;
            $profile_photo->storeAs('public/foto_user', $filename);
            $path_foto_user = 'foto_user' . '/' . $filename;
            $params['profile_photo'] = $path_foto_user;
        }

        // return $params;
        $product = User::findOrFail($id);

        if ($product->update($params)) {
            Session::flash('success', 'User berhasil di update!');
        } else {
            Session::flash('error', 'Tidak dapat mengupdate User, coba ulangi');
        }

        return redirect()->route('users.show', $id);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $user = User::findOrfail($id);
        $store_banks = Store_bank::where('store_id', $user->store_id)->get();
        $carts = Cart::where('store_id', $user->store_id)->get();

        // mencari cart_detail yang ada pada toko
        $cart_ids[] = 0;
        foreach ($carts as $cart) {
            $cart_ids[] = $cart->id;
        }
        $cart_details = Cart_detail::whereIn('cart_id', $cart_ids)->get();

        $transactions = Transaction::where('store_id', $user->store_id)->get();
        $transaction_ids[] = 0;
        foreach ($transactions as $transaction) {
            $transaction_ids[] = $transaction->id;
        }
        $transaction_details = Transaction_detail::whereIn('transaction_id', $transaction_ids)->get();

        $products = Product::where('store_id', $user->store_id)->get();

        $store_address = Address::where('store_id', $user->store_id)->first();

        if ($store_address) {
            $store_address->delete($store_address->id);
        } else {
            // return "alamat gada";
        }
        // return $store_address;

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

        // menghapus $transaction_details
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

        if (!$products->isEmpty()) {
            foreach ($products as $product) {
                $product->delete($product->id);
            }
        } else {
            // return "product gada";
        }

        $store = Store::where('user_id', $id)->first();
        if ($store) {
            $store->delete();
        }

        if ($user->delete()) {
            Session::flash('success', 'User berhasil dihapus!');
        }
        return redirect()->back();
    }
}
