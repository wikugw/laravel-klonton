@extends('user.layout')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-7 heading-section ftco-animate fadeInUp ftco-animated" align="center">
                <h2 class="mb-4">Transaksi Selesai</h2>
                <img src="{{url('storage/success-buy.png')}}" width="50%"/>
                <p class="pt-5">Terimakasih karena telah melakukan transaksi menggunakan platform ini, Anda dapat melihat produk yang tersedia pada halaman
                    <a href="{{ route('home') }}">utama</a>
                </p>
              </div>
        </div>
    </div>
@endsection
