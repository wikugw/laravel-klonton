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
                            <th>Price</th>
                            <th>Quantity</th>
                            <th>Total</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr class="text-center">

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
                        </tr>

                    </tbody>
                </table>
            </div>
        </div>
    </div>
    <form action="{{ route('carts.checkout', $cart_detail->id) }}" method="POST">
        @csrf
        <div class="row justify-content-center mt-5 pt-5">
            @include('admin.partials.flash', ['$errors' => $errors])
            <div class="col-xl-8 ftco-animate fadeInUp ftco-animated">
                <form action="#" class="billing-form">
                    <h3 class="mb-4 billing-heading">Masukkan Alamat pengiriman</h3>
                    <div class="row align-items-end">
                        <div class="col-md-12">
                            <div class="form-group">
                                <label for="adrress">Alamat</label>
                                <input name="adrress" type="text" class="form-control" placeholder="Alamat">
                            </div>
                        </div>
                        <div class="w-100"></div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="province_id">Provinsi</label>
                                <div class="select-wrap">
                                    <select name="province_id" id="" class="form-control">
                                        <option value="" holder>Pilih provinsi</option>
                                        @foreach ($provinces as $province)
                                        <option value="{{ $province->id }}">{{ $province->province }}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="city_id">Kota</label>
                                <div class="select-wrap">
                                    <select name="city_id" id="" class="form-control">
                                        <option value="" holder>Pilih kota</option>
                                        @foreach ($cities as $city)
                                        <option value="{{ $city->id }}">{{ $city->city_name }}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                        </div>
                        <div class="w-100"></div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="phone">No. HP</label>
                                <input type="number" name="phone" class="form-control" placeholder="">
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="phone">Kode Pos</label>
                                <input type="number" name="postal_code" class="form-control" placeholder="">
                            </div>
                        </div>
                        <div class="w-100"></div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="country">Kurir</label>
                                <div class="select-wrap">
                                    <select name="courier" id="" class="form-control">
                                        <option value="" holder>Pilih Kurir</option>
                                        <option value="jne">JNE</option>
                                        <option value="tiki">TIKI</option>
                                        <option value="pos">POS</option>
                                    </select>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-6" align="center">
                            <p><button type="submit" class="btn btn-primary py-3 px-4">Cek Pembayaran</button></p>
                        </div>
                    </div>
                </form><!-- END -->
            </div>
        </div>
    </form>
</div>
@endsection
