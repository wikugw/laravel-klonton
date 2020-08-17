@extends('admin.layout')

@section('content')
    <div class="content">
        <div class="row justify-content-center">
            <div class="col-lg-6">
                <div class="card card-default">
                    <div class="card-header card-header-border-bottom">
                        Edit Bank Toko {{ $store->name }}
                    </div>
                    <div class="card-body">
                        @include('admin.partials.flash', ['$errors' => $errors])
                        <form action="{{ route('store_banks.update', $store_bank->id) }}" method="POST">
                            @method('PUT')
                            @csrf
                            <div class="form-group">
                                <label for="bank_name">Nama Bank</label>
                                <input type="text" class="form-control" id="bank_name"
                                        value="{{ old('bank_name') ? old('bank_name') : $store_bank->bank_name }}"
                                        name="bank_name" placeholder="Masukkan Nama Bank">
                                <span class="mt-2 d-block">* Harus Unik.</span>
                            </div>
                            <div class="form-group">
                                <label for="nomor_rekening">Nomor Rekening</label>
                                <input type="text" class="form-control" id="nomor_rekening"
                                        value="{{ old('nomor_rekening') ? old('nomor_rekening') : $store_bank->nomor_rekening }}"
                                        name="nomor_rekening" placeholder="Masukkan Nomor Rekening">
                                <span class="mt-2 d-block">* Harus Unik.</span>
                            </div>
                            <div class="form-group">
                                <label for="bank_name">Atas Nama</label>
                                <input type="text" class="form-control" id="atas_nama"
                                        value="{{ old('atas_nama') ? old('atas_nama') : $store_bank->atas_nama }}"
                                        name="atas_nama" placeholder="Masukkan Atas Nama">
                                <span class="mt-2 d-block">* Harus Unik.</span>
                            </div>
                            <div class="form-footer pt-2 border-top">
                                <button type="submit" class="btn btn-primary btn-default">Update</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
