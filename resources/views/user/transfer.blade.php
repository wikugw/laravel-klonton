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
                    <span>{{ $cart->store['name'] }}</span>
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
                    <span style="text-transform:capitalize;">{{ $weight_total }} gram</span>
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
                        <form enctype="multipart/form-data"
                            action="{{ route('carts.checkout.pay', ['id' => $cart_detail->id, 'address_id' => $destination_address->id, 'courier' => $picked_service]) }}"
                            method="POST">
                            @csrf
                            <tr class="text-center">

                                <td class="product-name">
                                    <h3>{{$service['description']}} ({{ $service['service'] }})</h3>
                                </td>

                                <td class="price">
                                    Rp. {{$service['cost'][0]['value']}}
                                    <input type="hidden" name="subtotal" value="{{$price_total}}">
                                </td>

                                <td class="price">
                                    Rp. {{ ( $price_total + $service['cost'][0]['value'])}}
                                </td>

                                <td class="price">
                                    {{$service['cost'][0]['etd']}}
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
                                    {{-- <a href="#" class="btn btn-sm btn-primary mx-1" data-toggle="modal"
                                        data-target="#exampleModal">Pilih</a> --}}
                                    <button type="button" class="btn btn-primary" data-toggle="modal"
                                        data-target="#exampleModal"
                                        data-ongkir="{{$service['cost'][0]['value']}}"
                                        data-service="{{ strtoupper($picked_service)}} - {{$service['description']}} ({{ $service['service'] }})"
                                        data-whatever="{{( $price_total + $service['cost'][0]['value'])}}">
                                        Open modal {{ $service['service'] }}
                                    </button>
                                </td>

                            </tr>
                            {{-- </form> --}}
                            @empty
                            <td class="text-center" colspan="8">Jasa pengiriman tidak dapat ditemukan, coba jassa lain
                                :(
                            </td>
                            @endforelse
                            <!-- END TR-->

                    </tbody>
                </table>
            </div>
        </div>
        <div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel">
            <div class="modal-dialog modal-lg" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                            <h5 class="modal-title" id="exampleModalLabel">Ikuti Instruksi untuk menyelesaikan transaksi
                            </h5>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                    </div>
                    <div class="modal-body">
                            <div class="col-md-12 cart-wrap ftco-animate fadeInUp ftco-animated">
                                <div class="cart-total mb-3">
                                    <input type="hidden" name="service" id="service"
                                        value="{{$service['description']}} ({{ $service['service'] }})">
                                    <input type="hidden" name="ongkir" id="ongkir" value="{{$service['cost'][0]['value']}}">
                                    <h3 id="bayar">1. Lakukan Transfer Pada salah 1 Bank dibawah ini</h3>
                                    <p class="d-flex px-5">
                                        <span style="color: black;">Nama Bank</span>
                                        <span style="color: black;">Nomor Rekening</span>
                                        <span style="color: black;">Atas Nama</span>
                                    </p>
                                    @forelse ($store_banks as $store_bank)
                                    <p class="d-flex px-5">
                                        <span>{{ $store_bank->bank_name }}</span>
                                        <span>{{ $store_bank->nomor_rekening }}</span>
                                        <span>{{ $store_bank->atas_nama }}</span>
                                    </p>
                                    @empty
                                    <span>Sayang sekali tidak dapat menemukan Bank :(</span>
                                    @endforelse
                                </div>
                            </div>
                            <div class="col-md-12 cart-wrap ftco-animate fadeInUp ftco-animated">
                                <div class="cart-total mb-3">
                                    <h3>2. Upload bukti Transfer dan Tekan Tombol "Saya Telah Bayar"</h3>
                                    <p class="d-flex px-5">
                                        <div class="form-control">
                                            <input type="file" name="image" required>
                                        </div>
                                    </p>
                                </div>
                            </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                    <button type="submit" class="btn btn-primary">Saya Telah Bayar</button>
                    </div>
                </div>
            </div>
        </div>
        <!-- Modal -->
        {{-- <div class="modal fade" id="myModal-{{ $service['description'] }}" tabindex="-1" role="dialog"
        aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Ikuti Instruksi untuk menyelesaikan transaksi
                    </h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <div class="col-md-12 cart-wrap ftco-animate fadeInUp ftco-animated">
                        <div class="cart-total mb-3">
                            <h3>1. Lakukan Transfer Pada salah 1 Bank dibawah ini</h3>
                            <p class="d-flex px-5">
                                <span style="color: black;">Nama Bank</span>
                                <span style="color: black;">Nomor Rekening</span>
                                <span style="color: black;">Atas Nama</span>
                            </p>
                            @forelse ($store_banks as $store_bank)
                            <p class="d-flex px-5">
                                <span>{{ $store_bank->bank_name }}</span>
                                <span>{{ $store_bank->nomor_rekening }}</span>
                                <span>{{ $store_bank->atas_nama }}</span>
                            </p>
                            @empty
                            <span>Sayang sekali tidak dapat menemukan Bank :(</span>
                            @endforelse
                        </div>
                    </div>
                    <div class="col-md-12 cart-wrap ftco-animate fadeInUp ftco-animated">
                        <div class="cart-total mb-3">
                            <h3>2. Upload bukti Transfer dan Tekan Tombol "Saya Telah Bayar"</h3>
                            <p class="d-flex px-5">
                                <div class="form-control">
                                    <input type="file" name="image">
                                </div>
                            </p>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                    <button type="submit" class="btn btn-primary">Saya Telah Bayar</button>
                </div>
            </div>
        </div>
    </div> --}}
    </form>

        <div class="col-12" align="center">
            <form action="{{ route('carts.delete_address', ['id' => $cart_detail->id, 'address_id' => $destination_address->id]) }}" method="post"
                class="d-inline">
                @method('delete')
                @csrf
                <button class="mt-5 btn btn-secondary" onclick="return confirm('Dengan menekan tombol ini anda harus memasukkan alamat ulang');">
                    Kembali
                </button>
            </form>
        </div>
</div>
</div>
@endsection
