@extends('admin.layout')

@section('content')
    <div class="content">
        <div class="row">
            <div class="col-lg-12">
                <div class="card card-default">
                    <div class="card-header card-header-border-bottom">
                        <h2>Transaksi</h2>
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
                                      <th>Nama Produk</th>
                                      <th>Nama Pembeli</th>
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
                                                <td>{{ $transaction_detail->product->name }}</td>
                                                <td>{{ $transaction_detail->transaction->user->name }}</td>
                                                <td>{{ $transaction_detail->transaction->service }}</td>
                                                <td>Rp. {{ $transaction_detail->transaction->subtotal }}</td>
                                                <td>Rp. {{ $transaction_detail->transaction->ongkir }}</td>
                                                <td>
                                                    <img class="img-fluid" src="{{url($transaction_detail->transaction->bukti_transfer)}}"
                                                        alt="Colorlib Template" style=" object-fit: contain" width="100px">
                                                </td>
                                                <td>
                                                    @if ($transaction_detail->transaction->resi)
                                                    {{ $transaction_detail->transaction->resi }}
                                                    @elseif ($transaction_detail->transaction->status == '2')
                                                    <button type="button" class="btn btn-primary btn-sm" data-toggle="modal" data-target="#exampleModalCenter">
                                                        {{-- <span class="mdi mdi-zip-box"></span> --}}
                                                        Tambah Resi
                                                    </button>
                                                    @else
                                                    -
                                                    @endif
                                                </td>
                                                <td
                                                    @if ($transaction_detail->transaction->status == '1')
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
                                                    <a
                                                        href="{{ route('transactions.confirm', $transaction_detail->transaction->id) }}"
                                                        class="btn btn-sm btn-primary"
                                                        onclick="return confirm('Yakin ingin menkofirmasi transaksi?');"
                                                    >
                                                        <span class="mdi mdi-check"></span>
                                                    </a>
                                                    @endif
                                                    <form action="{{ route('transactions.destroy', $transaction_detail->id) }}" method="post" class="d-inline">
                                                        @method('delete')
                                                        @csrf
                                                        <button class=" ml-1 btn btn-sm btn-danger"
                                                                onclick="return confirm('Yakin ingin menghapus produk?');"
                                                        >
                                                            <span class="mdi mdi-delete"></span>
                                                        </button>
                                                    </form>
                                                    </div>
                                                </td>
                                            </tr>
                                            <div class="modal fade" id="exampleModalCenter" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
                                                <div class="modal-dialog modal-dialog-centered" role="document">
                                                  <div class="modal-content">
                                                    <div class="modal-header">
                                                      <h5 class="modal-title" id="exampleModalLongTitle">Tambah Resi</h5>
                                                      <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                        <span aria-hidden="true">&times;</span>
                                                      </button>
                                                    </div>
                                                    <div class="modal-body">
                                                        <form action="{{ route('transactions.add_resi', $transaction_detail->transaction_id) }}" method="POST">
                                                            @method('PUT')
                                                            @csrf
                                                            <div class="form-group">
                                                                <label for="resi">Nomor Resi</label>
                                                                <input required type="text" class="form-control" id="resi" name="resi" placeholder="Masukkan Resi">
                                                                <span class="mt-2 d-block">* Harus Unik.</span>
                                                            </div>
                                                    </div>
                                                    <div class="modal-footer">
                                                      <button type="button" class="btn btn-secondary" data-dismiss="modal">Tutup</button>
                                                      <button type="submit" class="btn btn-primary">Tambah Resi</button>
                                                    </form>
                                                    </div>
                                                  </div>
                                                </div>
                                              </div>
                                        @empty
                                        <td class="text-center" colspan="11"> Produk tidak ditemukan </td>
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
