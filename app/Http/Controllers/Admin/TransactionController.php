<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Transaction;
use App\Models\Transaction_detail;
use App\Models\Address;
use App\Models\Store;
use Illuminate\Http\Request;
use Session;
use Auth;
use PDF;

class TransactionController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $this->data['transactions'] = Transaction::all();
        // return $this->data['transactions'];

        $transaction_ids[] = 0;
        foreach ($this->data['transactions'] as $transaction) {
            $transaction_ids[] = $transaction->id;
        }
        $this->data['transaction_details'] = Transaction_detail::whereIn('transaction_id', $transaction_ids)->get();

        // return $this->data;
        return view('admin.transactions.index', $this->data);
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
        $this->data['transaction_detail'] = Transaction_detail::findOrFail($id);
        $this->data['transaction'] = Transaction::FindOrFail($this->data['transaction_detail']->transaction_id);
        $this->data['destination_address'] = Address::FindOrFail($this->data['transaction']->address_id);
        // return $this->data;
        return view('admin.transactions.show', $this->data);
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

    public function resi($id)
    {
        $this->data['transaction'] = Transaction::findOrFail($id);
        return view('admin.transactions.add_resi', $this->data);
    }

    public function add_resi(Request $request, $id)
    {
        $validatedData = $request->validate([
            'resi' => 'required|unique:transactions|max:191'
        ]);

        $transaction = Transaction::findOrfail($id);
        $transaction->resi = $request->resi;
        $transaction->status = 3;
        $transaction->save();
        Session::flash('success', 'Resi telah ditambahkan');
        return redirect()->route('stores.transactions', Auth::user()->store_id);
    }

    public function export()
    {
        if (Auth::user()->role_id == '2') {
            $this->data['transactions'] = Transaction::where('store_id', Auth::user()->store_id)->get();
        } else {
            $this->data['transactions'] = Transaction::all();
        }

        $transaction_ids[] = 0;
        foreach ($this->data['transactions'] as $transaction) {
            $transaction_ids[] = $transaction->id;
        }
        $this->data['transaction_details'] = Transaction_detail::whereIn('transaction_id', $transaction_ids)->get();

        $pdf = PDF::loadView('admin.transactions.pdf', $this->data)->setPaper('a4', 'landscape');
        return $pdf->download('data transaksi.pdf');
        return $this->data;
    }
}
