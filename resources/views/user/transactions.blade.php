@extends('user.layout')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-12 ftco-animate">
            <div class="cart-list">
                <table class="table">
                    <thead class="thead-primary">
                        <tr class="text-center">
                            <th>&nbsp;</th>
                            <th>Product</th>
                            <th>Quantity</th>
                            <th>Status</th>
                            <th>Resi</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse ($transaction_details as $transaction_detail)
                        <tr class="text-center">

                            <td class="image-prod">
                                <img class="img-fluid" src="{{url($transaction_detail->product->image)}}"
                                    alt="Colorlib Template" style=" object-fit: contain" width="100px">
                            </td>

                            <td class="product-name">
                                <h3>{{ $transaction_detail->product->name }}</h3>
                            </td>

                            <td class="price">{{ $transaction_detail->quantity }} </td>

                            <td class="price"
                                @if ($transaction_detail->transaction->status == '1')
                                style="color: red;"> Menunggu Konfirmasi
                                @elseif($transaction_detail->transaction->status == '2')
                                style="color: orange;"> Menunggu Resi
                                @elseif($transaction_detail->transaction->status == '3')
                                style="color: green;"> Barang Telah dikirim
                                @elseif($transaction_detail->transaction->status == '4')
                                style="color: green;"> Transaksi Selesai
                                @endif
                            </td>

                            <td class="price">
                                @if ($transaction_detail->transaction->resi == null)
                                Lorem ipsum dolor sit, amet consectetur adipisicing elit. Beatae, velit.
                                @else
                                    {{ $transaction_detail->transaction->resi }}
                                @endif
                            </td>

                            <td class="price">
                                @if ($transaction_detail->transaction->status == '3')
                                <a
                                    href="{{ route('home.receive', $transaction_detail->transaction->id) }}"
                                    class="btn btn-sm btn-primary"
                                    onclick="return confirm('Dengan menekan tombol ini anda akan menyelesaikan transaksi');">
                                    Barang telah saya terima
                                </a>
                                @else
                                -
                                @endif
                            </td>

                            {{-- <td class="quantity">
                                <div class="input-group mb-3">
                                    <input type="text" name="quantity" class="quantity form-control input-number"
                                        readonly value={{ $cart_detail->quantity }} min="1" max="100">
                                </div>
                            </td>

                            <td class="total">Rp. {{ $cart_detail->total_price() }}</td>

                            <td>
                                <div class="row pl-1">
                                    @if ($cart_detail->quantity > 1)
                                    <a href="{{ route('carts.decrement_quantity', $cart_detail->id) }}"
                                        class="btn btn-sm btn-secondary"><span class="ion-ios-remove"></a>
                                    @endif
                                    <a href="{{ route('carts.show', $cart_detail->id) }}"
                                        class="btn btn-sm btn-primary mx-1">Checkout</a>
                                    <a href="{{ route('carts.increment_quantity', $cart_detail->id) }}"
                                        class="btn btn-sm btn-info"><span class="ion-ios-add"></a>
                                </div>
                            </td> --}}
                        </tr>
                        @empty
                        <td class="text-center" colspan="8">Belum ada barang pada keranjang</td>
                        @endforelse
                        <!-- END TR-->

                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>
@endsection
