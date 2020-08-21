<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Transaction;
use App\Models\Transaction_detail;
use Illuminate\Http\Request;
use Session;

class TransactionController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
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
        $transaction_detail = Transaction_detail::findOrFail($id);
        $transaction = Transaction::findOrFail($transaction_detail->transaction_id);
        $transaction_detail->delete();
        $transaction->delete();
        Session::flash('success', 'Toko berhasil dihapus!');
        return redirect()->back();
    }

    public function confirm($id)
    {
        $transaction = Transaction::findOrfail($id);
        $transaction->status = 2;
        $transaction->save();
        Session::flash('success', 'Pembayaran telah dikonfirmasi, silahkan tambahkan nomor resi sudah ada');
        return redirect()->back();
    }

    public function add_resi(Request $request, $id)
    {
        $transaction = Transaction::findOrfail($id);
        $transaction->resi = $request->resi;
        $transaction->status = 3;
        $transaction->save();
        Session::flash('success', 'Resi telah ditambahkan');
        return redirect()->back();
    }
}
