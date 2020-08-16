@extends('user.layout')

@section('content')
    <div class="container">
        <div class="row">
            {{-- alamat pengiriman --}}
            <div class="col-md-4 cart-wrap ftco-animate fadeInUp ftco-animated">
                <div class="cart-total mb-3">
                    <h3>Informasi Toko</h3>
                    <p class="d-flex">
                        <span>Nama Toko</span>
                        <span>{{ $cart->store_id }}</span>
                    </p>
                    <hr>
                    <p class="d-flex">
                        <span>Alamat</span>
                        <span>{{ $origin_address->adrress }}</span>
                    </p>
                    <p class="d-flex">
                        <span>Kota</span>
                        <span>{{ $origin_address->city->city_name }}</span>
                    </p>
                    <p class="d-flex">
                        <span>Provinsi</span>
                        <span>{{ $origin_address->province->province }}</span>
                    </p>
                    <p class="d-flex">
                        <span>Kode Pos</span>
                        <span>{{ $origin_address->postal_code }}</span>
                    </p>
                    <hr>
                    <p class="d-flex">
                        <span>No. HP</span>
                        <span>{{ $origin_address->phone }}</span>
                    </p>
                </div>
            </div>
            {{-- alamat toko --}}
            <div class="col-md-4 cart-wrap ftco-animate fadeInUp ftco-animated">
                <div class="cart-total mb-3">
                    <h3>Informasi Pembeli</h3>
                    <p class="d-flex">
                        <span>Nama Pembeli</span>
                        <span>{{ Auth::user()->name }}</span>
                    </p>
                    <hr>
                    <p class="d-flex">
                        <span>Alamat</span>
                        <span>{{ $destination_address->adrress }}</span>
                    </p>
                    <p class="d-flex">
                        <span>Kota</span>
                        <span>{{ $destination_address->city->city_name }}</span>
                    </p>
                    <p class="d-flex">
                        <span>Provinsi</span>
                        <span>{{ $destination_address->province->province }}</span>
                    </p>
                    <p class="d-flex">
                        <span>Kode Pos</span>
                        <span>{{ $destination_address->postal_code }}</span>
                    </p>
                    <hr>
                    <p class="d-flex">
                        <span>No. HP</span>
                        <span>{{ $destination_address->phone }}</span>
                    </p>
                    <p class="d-flex">
                        <span>Kurir</span>
                        <span style="text-transform:uppercase;">{{ $picked_service }}</span>
                    </p>
                </div>
            </div>
            {{-- detail produk --}}
            <div class="col-md-4 cart-wrap ftco-animate fadeInUp ftco-animated">
                <div class="cart-total mb-3">
                    <h3>Detail Produk</h3>
                    <p class="d-flex">
                        <span>Nama</span>
                        <span>{{ $product->name }}</span>
                    </p>
                    <p class="d-flex">
                        <span>Jumlah</span>
                        <span>{{ $cart_detail->quantity }}</span>
                    </p>
                    <hr>
                    <p class="d-flex">
                        <span>Berat</span>
                        <span>{{ $product->weight }}</span>
                    </p>
                    <p class="d-flex total-price">
                        <span>Berat Total</span>
                        <span style="text-transform:capitalize;" >{{ $weight_total }} gram</span>
                    </p>
                    <hr>
                    <p class="d-flex">
                        <span>Harga</span>
                        <span>Rp. {{ $product->price }}</span>
                    </p>
                    <p class="d-flex total-price">
                        <span>Harga Total</span>
                        <span style="text-transform:capitalize;">Rp. {{ $price_total }}</span>
                    </p>
                </div>
            </div>
        </div>

        <div class="row">
            <div class="col-md-12 ftco-animate">
                <div class="cart-list">
                    <table class="table">
                        <thead class="thead-primary">
                          <tr class="text-center">
                            <th>Nama Service</th>
                            <th>Harga Ongkir</th>
                            <th>Total Harga</th>
                            <th>Estimasi Pengiriman</th>
                            <th>Note</th>
                            <th>Action</th>
                          </tr>
                        </thead>
                        <tbody>
                          @forelse ($services as $service)
                          <form action="{{ route('carts.checkout.pay', ['id' => $cart_detail->id, 'address_id' => $destination_address->id, 'courier' => $picked_service]) }}" method="POST">
                          @csrf
                          <tr class="text-center">

                            <td class="product-name">
                                <h3>{{$service['description']}} ({{ $service['service'] }})</h3>
                                <input type="hidden" name="service" value="{{$service['description']}} ({{ $service['service'] }})">
                            </td>

                            <td class="price">
                                Rp. {{$service['cost'][0]['value']}}
                                <input type="hidden" name="subtotal" value="{{$price_total}}">
                            </td>

                            <td class="price">
                                Rp. {{ ( $price_total + $service['cost'][0]['value'])}}
                                <input type="hidden" name="ongkir" value="{{$service['cost'][0]['value']}}">
                            </td>

                            <td class="price">
                                {{$service['cost'][0]['etd']}} Hari
                            </td>

                            @if ($service['cost'][0]['note'] == "")
                            <td class="price">
                                -
                            </td>
                            @else
                            <td class="price">
                                {{$service['cost'][0]['note']}}
                            </td>
                            @endif

                            <td>
                                <button type="submit" class="btn btn-sm btn-primary mx-1">Pilih</button>
                            </td>
                          </tr>
                          </form>
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
