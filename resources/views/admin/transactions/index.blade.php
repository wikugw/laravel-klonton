@extends('admin.layout')

@section('content')
<div class="content">
    <div class="row">
        <div class="col-lg-12">
            <div class="card card-default">
                <div class="row">
                    <div class="card-body">
                        <div class="row">
                            <div class="col-6">
                                <h2 class="pl-3">Transaksi</h2>
                            </div>
                            <div class="col-6" align="right">
                                <a href="{{ route('transactions.export') }}" class="mr-3 btn btn-primary">
                                    <span class="mdi mdi-file-pdf"> Unduh data Transaksi dalam bentuk PDF</span>
                                </a>
                            </div>
                        </div>
                    </div>
                </div>

                {{-- session sukses --}}
                @include('admin.partials.flash')

                <div class="card-body">
                    <div class="basic-data-table">
                        <div class="dataTables_wrapper dt-bootstrap4 tables_responsive">
                            <table id="basic-data-table" class="table nowrap dataTable ">
                                <thead>
                                    <tr>
                                        <th>#</th>
                                        <th>Kode Transaksi</th>
                                        @if (Auth::user()->role_id == '1')
                                        <th>Nama Toko</th>
                                        @endif
                                        <th>Nama Produk</th>
                                        <th>Nama Pembeli</th>
                                        <th>Alamat</th>
                                        <th>Kurir</th>
                                        <th>Subtotal</th>
                                        <th>Ongkir</th>
                                        <th>Bukti Transfer</th>
                                        <th>Resi</th>
                                        <th>Status</th>
                                        <th>Action</th>
                                    </tr>
                                </thead>

                                <tbody>
                                    @forelse ($transaction_details as $transaction_detail)
                                    <tr>
                                        <td>{{ $transaction_detail->id }}</td>
                                        <td>{{ $transaction_detail->transaction->code }}</td>
                                        @if (Auth::user()->role_id == '1')
                                        <td>{{ $transaction_detail->transaction->store->name }}</td>
                                        @endif
                                        <td>{{ $transaction_detail->product->name }}</td>
                                        <td>{{ $transaction_detail->transaction->user->name }}</td>
                                        <td>{{ $transaction_detail->transaction->address->adrress }},
                                            {{ $transaction_detail->transaction->address->city->city_name }},
                                            {{ $transaction_detail->transaction->address->province->province }},
                                            {{ $transaction_detail->transaction->address->postal_code }}
                                        </td>
                                        <td>{{ $transaction_detail->transaction->service }}</td>
                                        <td>Rp. {{ $transaction_detail->transaction->subtotal }}</td>
                                        <td>Rp. {{ $transaction_detail->transaction->ongkir }}</td>
                                        <td>
                                            <a href="{{ route('gambar', ['path' => $transaction_detail->transaction->bukti_transfer])  }}"">
                                                <img class="img-fluid"
                                            src="{{ route('gambar', ['path' => $transaction_detail->transaction->bukti_transfer])  }}"
                                                alt="Colorlib Template" style=" object-fit: contain" width="100px">
                                            </a>
                                        </td>
                                        <td>
                                            @if ($transaction_detail->transaction->resi)
                                            {{ $transaction_detail->transaction->resi }}
                                            @elseif ($transaction_detail->transaction->status == '2')
                                            <a href="{{ route('transactions.resi', $transaction_detail->transaction->id) }}"
                                                class="mb-1 btn btn-sm btn-primary">
                                                Tambah Resi
                                            </a>
                                            @else
                                            -
                                            @endif
                                        </td>
                                        <td @if ($transaction_detail->transaction->status == '1')
                                            style="color: red;"> Menunggu Konfirmasi
                                            @elseif($transaction_detail->transaction->status == '2')
                                            style="color: orange;"> Menunggu Resi
                                            @elseif($transaction_detail->transaction->status == '3')
                                            style="color: green;"> Barang Telah dikirim
                                            @elseif($transaction_detail->transaction->status == '4')
                                            style="color: green;"> Barang Telah diterima
                                            @endif
                                        </td>
                                        <td>
                                            <div class="row">
                                                @if ($transaction_detail->transaction->status == '1')
                                                <a href="{{ route('transactions.confirm', $transaction_detail->transaction->id) }}"
                                                    class="mb-1 btn btn-sm btn-primary"
                                                    onclick="return confirm('Yakin ingin menkofirmasi transaksi?');">
                                                    <span class="mdi mdi-check"></span>
                                                </a>
                                                @endif
                                                <a href="{{ route('transactions.show', $transaction_detail->id) }}"
                                                    class="mb-1 mx-1 btn btn-sm btn-info">
                                                    <span class="mdi mdi-eye"></span>
                                                </a>
                                            </div>
                                        </td>
                                    </tr>
                                    @empty
                                    <td class="text-center" colspan="11"> Belum ada transaksi </td>
                                    @endforelse
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
