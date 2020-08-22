@extends('admin.layout')

@section('content')
    <div class="content">
        <div class="row justify-content-center">
            <div class="col-lg-6">
                <div class="card card-default">
                    <div class="card-header card-header-border-bottom">
                        Tambah Resi Transaksi dengan kode <br> {{ $transaction->code }}
                    </div>
                    <div class="card-body">
                        @include('admin.partials.flash', ['$errors' => $errors])
                        <form action="{{ route('transactions.add_resi', $transaction->id) }}" method="POST">
                            @method('PUT')
                            @csrf
                            <div class="form-group">
                                <label for="resi">Nomor Resi</label>
                                <input type="text" class="form-control" id="resi"
                                        value="{{ old('resi') ? old('resi') : $transaction->resi }}"
                                        name="resi" placeholder="Masukkan kategori">
                                <span class="mt-2 d-block">* Harus Unik.</span>
                            </div>
                            <div class="form-footer pt-2 border-top">
                                <button type="submit" class="btn btn-primary btn-default">Tambahkan</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
