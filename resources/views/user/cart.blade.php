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
                    <td class="product-remove"><a href="{{ route('carts.remove', $cart_detail->id) }}"><span class="ion-ios-close"></span></a></td>

                    <td class="image-prod">
                        <img class="img-fluid" src="{{url($cart_detail->product->image)}}" alt="Colorlib Template" style=" object-fit: contain" width="100px">
                    </td>

                    <td class="product-name">
                        <h3>{{ $cart_detail->product->name }}</h3>
                    </td>

                    <td class="price">Rp. {{ $cart_detail->product->price }}  </td>

                    <td class="quantity">
                        <div class="input-group mb-3">
                         <input type="text" name="quantity" class="quantity form-control input-number" readonly value={{ $cart_detail->quantity }} min="1" max="100">
                      </div>
                    </td>

                    <td class="total">Rp. {{ $cart_detail->total_price() }}</td>

                    <td>
                        <div class="row pl-1">
                            @if ($cart_detail->quantity > 1)
                            <a href="{{ route('carts.decrement_quantity', $cart_detail->id) }}" class="btn btn-sm btn-secondary"><span class="ion-ios-remove"></a>
                            @endif
                            <a href="#" class="btn btn-sm btn-primary mx-1">Checkout</a>
                            <a href="{{ route('carts.increment_quantity', $cart_detail->id) }}" class="btn btn-sm btn-info"><span class="ion-ios-add"></a>
                        </div>
                    </td>
                  </tr>
                  @empty
                    <h3 class="text-center" colspan="6">Belum ada barang pada keranjang</h3>
                  @endforelse
                  <!-- END TR-->

                </tbody>
              </table>
          </div>
    </div>
</div>
<div class="row justify-content-center">
    <div class="col col-lg-5 col-md-6 mt-5 cart-wrap ftco-animate">
        <div class="cart-total mb-3">
            <h3>Cart Totals</h3>
            <p class="d-flex">
                <span>Subtotal</span>
                <span>$20.60</span>
            </p>
            <p class="d-flex">
                <span>Delivery</span>
                <span>$0.00</span>
            </p>
            <p class="d-flex">
                <span>Discount</span>
                <span>$3.00</span>
            </p>
            <hr>
            <p class="d-flex total-price">
                <span>Total</span>
                <span>$17.60</span>
            </p>
        </div>
        <p class="text-center"><a href="checkout.html" class="btn btn-primary py-3 px-4">Proceed to Checkout</a></p>
    </div>
</div>
</div>
@endsection
