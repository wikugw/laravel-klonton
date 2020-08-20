@extends('user.layout')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-7 heading-section ftco-animate fadeInUp ftco-animated" align="center">
                <h2 class="mb-4">Transaksi Berhasil</h2>
                <img src="{{url('storage/success-buy.png')}}" width="50%"/>
                <p class="pt-5">Anda dapat melihat data transaksi pada tab
                    <a href="">transaksi</a> atau kembali pada halaman
                    <a href="">utama</a>
                </p>
              </div>
        </div>
    </div>
@endsection
