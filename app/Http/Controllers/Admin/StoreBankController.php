<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Store;
use App\Models\Store_bank;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Http\Requests\StoreBankRequest;
use Session;

class StoreBankController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        // $store = Store::where('user_id', Auth::user()->id)->first();
        // $this->data['store'] = $store;
        $this->data['store_banks'] = Store_bank::all();
        return view('admin.store_banks.index', $this->data);
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
    public function store(StoreBankRequest $request)
    {
        $params = $request->except('_token');
        $params['store_id'] = Auth::user()->store_id;
        Store_bank::create($params);
        Session::flash('success', 'Berhasil menambah Bank Baru');
        return redirect()->back();
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
        $store = Store::where('user_id', Auth::user()->id)->first();
        $this->data['store'] = $store;
        $this->data['store_bank'] = Store_bank::findOrFail($id);
        return view('admin.store_banks.edit', $this->data);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(StoreBankRequest $request, $id)
    {
        $params = $request->except('_token');
        $store_bank = Store_bank::findOrFail($id);
        $store_bank->update($params);
        Session::flash('success', 'Berhasil mengupdate Bank');
        if (Auth::user()->role_id == '1') {
            return redirect()->route('store_banks.index');
        } else {
            return redirect()->route('stores.banks', Auth::user()->store_id);
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $store_bank = Store_bank::findOrfail($id);
        $store_bank->delete();
        Session::flash('success', 'Bank berhasil dihapus!');
        return redirect()->back();
    }
}
