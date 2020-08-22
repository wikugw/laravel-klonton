@extends('admin.layout')

@section('content')
<div class="content">
    <div class="invoice-wrapper rounded border bg-white py-5 px-3 px-md-4 px-lg-5">
        <div class="d-flex justify-content-between">
            <h2 class="text-dark font-weight-medium"> Transaksi {{ $transaction->code }}</h2>
        </div>
        <div class="row pt-5">
            <div class="col-xl-3 col-lg-4">
                <p class="text-dark mb-2">Alamat Pengiriman</p>
                <address>
                    {{ $destination_address->adrress }}
                    <br> {{ $destination_address->city->city_name }}
                    <br> {{ $destination_address->province->province }}
                    <br> Kode Pos : {{ $destination_address->postal_code }}
                    <br> No. HP : {{ $destination_address->phone }}
                </address>
            </div>
            <div class="col-xl-3 col-lg-4">
                <p class="text-dark mb-2">Detail Pengiriman</p>
                <address>
                    Kurir : {{ $transaction->service }}
                    <br> Resi : @if ($transaction->resi)
                        {{ $transaction->resi }}
                    @else
                        -
                    @endif
                </address>
            </div>
        </div>
        <table class="table mt-3 table-striped table-responsive table-responsive-large" style="width:100%">
            <thead>
                <tr>
                    <th></th>
                    <th>Nama Produk</th>
                    <th>Jumlah</th>
                    <th>Berat</th>
                    <th>Harga</th>
                </tr>
            </thead>
            <tbody>
                <tr>
                    <td>
                        <img class="img-fluid" src="{{url($transaction_detail->product->image)}}"
                             alt="Colorlib Template" style=" object-fit: contain" width="100px">
                    </td>
                    <td>{{ $transaction_detail->product->name }}</td>
                    <td>{{ $transaction_detail->quantity }}</td>
                    <td>
                        {{ $transaction_detail->product->weight }} x {{ $transaction_detail->quantity }} = {{ ($transaction_detail->product->weight * $transaction_detail->quantity ) }} Gr
                    </td>
                    <td>
                        Rp. {{ $transaction_detail->product->price }} x {{ $transaction_detail->quantity }} =  Rp. {{ ($transaction->subtotal) }}
                    </td>
                </tr>
            </tbody>
        </table>
        <div class="row justify-content-end">
            <div class="col-lg-5 col-xl-4 col-xl-3 ml-sm-auto">
                <ul class="list-unstyled mt-4">
                    <li class="mid pb-3 text-dark"> Subtotal
                        <span class="d-inline-block float-right text-default">Rp. {{ $transaction->subtotal }}</span>
                    </li>
                    <li class="mid pb-3 text-dark">Ongkos Kirim
                        <span class="d-inline-block float-right text-default">Rp. {{ $transaction->ongkir }}</span>
                    </li>
                    <li class="pb-3 text-dark">Total
                        <span class="d-inline-block float-right">Rp. {{ ($transaction->subtotal + $transaction->ongkir) }}</span>
                    </li>
                </ul>
                <a href="{{ URL::previous() }}" class="btn btn-secondary btn-default float-right">Back</a>
            </div>
        </div>
    </div>
</div>
@endsection
