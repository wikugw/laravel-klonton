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
        return view('admin.stores.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreRequest $request)
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
            $path_profile_toko = 'storage/profile_toko' . '/' . $filename;
        }

        if ($request->has('foto_ktp') && $request->foto_ktp != "undefined") {
            $foto_ktp = $request->file('foto_ktp');
            $extension = $foto_ktp->getClientOriginalExtension();
            $filename = $params['slug'] . time() . '.' . $extension;
            $foto_ktp->storeAs('public/foto_ktp', $filename);
            $path_foto_ktp = 'storage/foto_ktp' . '/' . $filename;
        }

        $params['profile'] = $path_profile_toko;
        $params['foto_ktp'] = $path_foto_ktp;

        $this->data['store'] = Store::create($params)->id;

        $toko_user = User::findOrFail(Auth::user()->id);
        $toko_user->store_id = $this->data['store'];
        $toko_user->save();

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
        $this->data['store'] = Store::findOrFail($id);
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
            $path_profile_toko = 'storage/profile_toko' . '/' . $filename;
            $params['profile'] = $path_profile_toko;
        }

        if ($request->has('foto_ktp') && $request->foto_ktp != "undefined") {
            $foto_ktp = $request->file('foto_ktp');
            $extension = $foto_ktp->getClientOriginalExtension();
            $filename = $params['slug'] . time() . '.' . $extension;
            $foto_ktp->storeAs('public/foto_ktp', $filename);
            $path_foto_ktp = 'storage/foto_ktp' . '/' . $filename;
            $params['foto_ktp'] = $path_foto_ktp;
        }

        $store = Store::findOrFail($id);

        if ($store->update($params)) {
            Session::flash('success', 'Toko telah dibuat, menunggu persetujuan admin');
        } else {
            Session::flash('error', 'Tidak dapat membuat toko, coba ulangi');
        }

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
        $store = Store::findOrfail($id);
        if ($store->delete()) {
            Session::flash('success', 'Toko berhasil dihapus!');
        }

        return redirect()->route('stores.index');
    }

    public function activate($id)
    {
        $params = Store::findOrFail($id);
        $params->is_active = '1';
        $params->save();
        Session::flash('success', 'Toko telah diaktivasi');
        return redirect()->route('stores.index');
    }
}
