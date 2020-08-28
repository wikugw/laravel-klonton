<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Product;
use Illuminate\Http\Request;
use Auth;
use App\Models\Cart;
use App\Models\Cart_detail;
use Session;
use App\Models\City;
use App\Models\Province;
use App\Http\Requests\AddressRequest;
use App\Models\Address;
use Illuminate\Support\Facades\Http;
use App\Models\Store;
use App\Models\Store_bank;
use App\Models\Transaction;
use App\Models\Transaction_detail;

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
        $this->data['cart_detail'] = Cart_detail::findOrFail($id);
        $this->data['carts'] = Cart::where('user_id', Auth::user()->id)->get();
        $cart_ids[] = 0;
        foreach ($this->data['carts'] as $cart) {
            $cart_ids[] = $cart->id;
        }
        $this->data['cart_details'] = Cart_detail::whereIn('cart_id', $cart_ids)->get();
        $this->data['provinces'] = Province::all();
        $this->data['cities'] = City::all();
        return view('user.checkout', $this->data);
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

    public function checkout(AddressRequest $request, $id)
    {
        $params = $request->except('_token');
        // mencari cart_detail
        $cart_detail = Cart_detail::findOrFail($id);
        // mencari cart
        $cart = Cart::with('store')->findOrFail($cart_detail->cart_id);
        // mencari address
        $cart_address = Address::where('store_id', $cart->store_id)->first();
        // mencari produk
        $product = Product::findOrFail($cart_detail->product_id);
        // kelengkapan cek ongkir
        // $cek_ongkir['origin'] = $cart_address['city_id'];
        // $cek_ongkir['destination'] = (int)$params['city_id'];
        // $cek_ongkir['weight'] = (int)$product->weight * (int)$cart_detail->quantity;
        // $cek_ongkir['courier'] = $params['courier'];
        // menambah address pengiriman dan ambil id
        $params['user_id'] = Auth::user()->id;
        $destination_address = Address::create($params)->id;

        return redirect()->route('carts.checkout.ongkir', ['id' => $id, 'address_id' => $destination_address, 'courier' => $params['courier']]);
        // // cek ongkir
        // $response = Http::asForm()->withHeaders([
        //     'key' => '599cde1abca841e4b74a85474c131392'
        // ])->post('https://api.rajaongkir.com/starter/cost', $cek_ongkir);
        // menampilkan pada halaman pembayaran
        $this->data['origin_address'] = $cart_address;
        $this->data['destination_address'] = Address::findOrFail($destination_address);
        $this->data['product'] = $product;
        $this->data['services'] = $response['rajaongkir']['results'][0]['costs'];
        // buat count keranjang
        $this->data['carts'] = Cart::where('user_id', Auth::user()->id)->get();
        $cart_ids[] = 0;
        foreach ($this->data['carts'] as $cart) {
            $cart_ids[] = $cart->id;
        }
        $this->data['cart_details'] = Cart_detail::whereIn('cart_id', $cart_ids)->get();
        $this->data['cart_detail'] = $cart_detail;
        $this->data['weight_total'] = (int)$product->weight * (int)$cart_detail->quantity;
        $this->data['price_total'] = (int)$product->price * (int)$cart_detail->quantity;
        $this->data['cart'] = $cart;
        $this->data['picked_service'] = $cek_ongkir['courier'];
        // return view('user.transfer', $this->data);
    }

    public function ongkir($id, $address_id, $courier)
    {
        // mencari cart_detail
        $cart_detail = Cart_detail::findOrFail($id);
        // mencari product
        $product = Product::FindOrFail($cart_detail->product_id);
        // mencari cart
        $cart = Cart::findOrFail($cart_detail->cart_id);
        // mencari toko
        $store = Store::findOrFail($cart->store_id);
        // mencari alamat toko
        $origin_address = Address::where('store_id', $store->id)->first();
        // mencari alamat pembeli
        $destination_address = Address::findOrFail($address_id);

        // kelengkapan cek ongkir
        $cek_ongkir['origin'] = (int)$origin_address['city_id'];
        $cek_ongkir['destination'] = (int)$destination_address['city_id'];
        $cek_ongkir['weight'] = (int)$product->weight * (int)$cart_detail->quantity;
        $cek_ongkir['courier'] = $courier;

        // cek ongkir
        $response = Http::asForm()->withHeaders([
            'key' => '599cde1abca841e4b74a85474c131392'
        ])->post('https://api.rajaongkir.com/starter/cost', $cek_ongkir);

        // mengirim data ke view
        $this->data['carts'] = Cart::where('user_id', Auth::user()->id)->get();
        $cart_ids[] = 0;
        foreach ($this->data['carts'] as $cart) {
            $cart_ids[] = $cart->id;
        }
        $this->data['cart_details'] = Cart_detail::whereIn('cart_id', $cart_ids)->get();
        $store_banks = Store_bank::where('store_id', $store->id)->get();
        $this->data['store_banks'] = $store_banks;
        $this->data['origin_address'] = $origin_address;
        $this->data['destination_address'] = $destination_address;
        $this->data['product'] = $product;
        $this->data['services'] = $response['rajaongkir']['results'][0]['costs'];
        $this->data['cart_detail'] = $cart_detail;
        $this->data['weight_total'] = (int)$product->weight * (int)$cart_detail->quantity;
        $this->data['price_total'] = (int)$product->price * (int)$cart_detail->quantity;
        $this->data['cart'] = $cart;
        $this->data['picked_service'] = $courier;

        return view('user.transfer', $this->data);
    }

    public function pay(Request $request, $id, $address_id, $courier)
    {
        // mencari cart detail
        $cart_detail = Cart_detail::findOrFail($id);
        // mencari cart
        $cart = Cart::findOrFail($cart_detail->cart_id);
        // mencari toko
        $store = Store::findOrFail($cart->store_id);
        // mencari produk
        $product = Product::findOrFail($cart_detail->product_id);
        // mengumpulkan data pada tabel transactions
        $transaction = $request->except('_token');
        $transaction['user_id'] = Auth::user()->id;
        $transaction['store_id'] = $cart->store_id;
        $transaction['address_id'] = $address_id;
        $transaction['status'] = 1;
        $transaction['code'] = 'TRX-' . $cart_detail->id . '-' . time();

        if ($request->has('image') && $request->image != "undefined") {
            $image = $request->file('image');
            $extension = $image->getClientOriginalExtension();
            $filename = 'TRX-' . $cart_detail->id . '-' . time() . '.' . $extension;
            $image->storeAs('public/bukti_transfer', $filename);
            $path_bukti_transfer = 'bukti_transfer' . '/' . $filename;
        }
        $transaction['bukti_transfer'] = $path_bukti_transfer;
        // tambah data transaksi database
        $transaction = Transaction::create($transaction)->id;
        // mengumpulkan data transaction detail
        $transaction_detail['transaction_id'] = $transaction;
        $transaction_detail['product_id'] = $product->id;
        $transaction_detail['quantity'] = $cart_detail->quantity;
        Transaction_detail::create($transaction_detail);
        // menghapus cart_detail
        $cart_detail->delete();
        return redirect()->route('home.success');
    }

    public function delete_address($id, $address_id)
    {
        $address = Address::findOrFail($address_id);
        $address->delete();
        return redirect()->route('carts.show', $id);
    }
}
