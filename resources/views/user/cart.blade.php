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
                            <th>&nbsp;</th>
                            <th>Product</th>
                            <th>Price</th>
                            <th>Quantity</th>
                            <th>Total</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse ($cart_details as $cart_detail)
                        <tr class="text-center">
                            <td class="product-remove">
                                <form action="{{ route('carts.destroy', $cart_detail->id) }}" method="post"
                                    class="d-inline">
                                    @method('delete')
                                    @csrf
                                    <button class="btn btn-sm btn-primary">
                                        <span class="ion-ios-close">
                                    </button>
                                </form>
                            </td>

                            <td class="image-prod">
                                <img class="img-fluid" src="{{ route('gambar', ['path' => $cart_detail->product->image])  }}"
                                    alt="Colorlib Template" style=" object-fit: contain" width="100px">
                            </td>

                            <td class="product-name">
                                <h3>{{ $cart_detail->product->name }}</h3>
                            </td>

                            <td class="price">Rp. {{ $cart_detail->product->price }} </td>

                            <td class="quantity">
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
                            </td>
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
