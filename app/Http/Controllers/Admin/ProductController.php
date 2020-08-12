<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Product;
use App\Models\Category;
use App\Models\Store;
use App\Http\Requests\ProductRequest;
use Illuminate\Http\Request;
use Str;
use Auth;
use Session;

class ProductController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $this->data['products'] = Product::all();

        return view('admin.products.index', $this->data);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $this->data['categories'] = Category::all();

        return view('admin.products.create', $this->data);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(ProductRequest $request)
    {
        $params = $request->except('_token');
        $params['slug'] = Str::slug($params['name']);
        $store = Store::where('user_id', Auth::user()->id)->first();
        $params['store_id'] = $store->id;

        if ($request->has('image') && $request->image != "undefined") {
            $image = $request->file('image');
            $extension = $image->getClientOriginalExtension();
            $filename = $params['slug'] . time() . '.' . $extension;
            $image->storeAs('public/gambar_produk', $filename);
            $path_gambar_produk = 'storage/gambar_produk' . '/' . $filename;
        }

        $params['image'] = $path_gambar_produk;
        // return $params;

        if (Product::create($params)) {
            Session::flash('success', 'Produk berhasil dibuat!');
        } else {
            Session::flash('error', 'Tidak dapat membuat produk, coba ulangi');
        }

        return redirect()->route('products.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $this->data['product'] = Product::findOrFail($id);
        return view('admin.products.show', $this->data);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $this->data['product'] = Product::findOrFail($id);
        $kategori =  $this->data['product']->store_id;
        $this->data['categories'] = Category::whereNotIn('id', [$kategori])->get();
        return view('admin.products.edit', $this->data);
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
        $params = $request->except('_token');
        $params['slug'] = Str::slug($params['name']);
        $store = Store::where('user_id', Auth::user()->id)->first();
        $params['store_id'] = $store->id;

        if ($request->has('image') && $request->image != "undefined") {
            $image = $request->file('image');
            $extension = $image->getClientOriginalExtension();
            $filename = $params['slug'] . time() . '.' . $extension;
            $image->storeAs('public/gambar_produk', $filename);
            $path_gambar_produk = 'storage/gambar_produk' . '/' . $filename;
        }

        $params['image'] = $path_gambar_produk;
        // return $params;
        $product = Product::findOrFail($id);

        if ($product->update($params)) {
            Session::flash('success', 'Produk berhasil di update!');
        } else {
            Session::flash('error', 'Tidak dapat mengupdate produk, coba ulangi');
        }

        return redirect()->route('products.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $product = Product::findOrfail($id);
        if ($product->delete()) {
            Session::flash('success', 'Produk berhasil dihapus!');
        }

        return redirect()->route('products.index');
    }
}
