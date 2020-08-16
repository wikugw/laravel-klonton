@extends('admin.layout')

@section('content')
    <div class="content">
        <div class="row">
            <div class="col-lg-12">
                <div class="card card-default">
                    <div class="card-header card-header-border-bottom">
                        Tambahkan Alamat Toko
                    </div>
                    <div class="card-body">
                        @include('admin.partials.flash', ['$errors' => $errors])
                        <form action="{{ route('addresses.store') }}" method="POST">
                            @csrf
                            <div class="row">
                                <div class="col-lg-6">
                                    {{-- alamat --}}
                                    <div class="form-group">
                                        <label for="adress">Alamat Toko</label>
                                        <textarea class="form-control" id="adress" name="adrress" rows="5"></textarea>
                                    </div>
                                    {{-- kode pos --}}
                                    <div class="form-group">
                                        <label for="postal_code">Kode Pos</label>
                                        <input type="number" class="form-control" id="postal_code" name="postal_code" placeholder="Masukkan Kode Pos">
                                        <span class="mt-2 d-block">* Wajib diisi.</span>
                                    </div>
                                </div>
                                <div class="col-lg-6">
                                    {{-- select provinsi --}}
                                    <div class="form-group">
                                        <label for="province_id">Provinsi</label>
                                        <select name="province_id" class="form-control">
                                            <option value="" holder>Pilih Provinsi</option>
                                            @foreach ($provinces as $province)
                                                <option value="{{ $province->id }}">{{ $province->province }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                    {{-- select kota --}}
                                    <div class="form-group">
                                        <label for="city_id">Kota</label>
                                        <select name="city_id" class="form-control">
                                            <option value="" holder>Pilih Kota</option>
                                            @foreach ($cities as $city)
                                                <option value="{{ $city->id }}">{{ $city->city_name }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                    {{-- nomor telepon --}}
                                    <div class="form-group">
                                        <label for="phone">Nomor Telepon</label>
                                        <input type="number" class="form-control" id="phone" name="phone" placeholder="Masukkan Nomor Telepon">
                                        <span class="mt-2 d-block">* Wajib diisi.</span>
                                    </div>
                                </div>
                            </div>
                            <div class="form-footer pt-2 border-top">
                                <button type="submit" class="btn btn-primary btn-default">Save</button>
                                <a href="{{ URL::previous() }}" class="btn btn-secondary btn-default">Back</a>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
