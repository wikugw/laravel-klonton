@extends('user.layout')

@section('content')
    <div class="container">

        <div class="row">
            {{-- alamat toko --}}
            <div class="col-md-12 cart-wrap ftco-animate fadeInUp ftco-animated">
                <div class="cart-total mb-3">
                    <h3 >1. Lakukan Transfer Pada salah 1 Bank dibawah ini</h3>
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
        </div>
    </div>
@endsection
