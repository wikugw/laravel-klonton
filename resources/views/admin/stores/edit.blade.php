@extends('admin.layout')

@section('content')
    <div class="content">
        <div class="row">
            <div class="col-lg-12">
                <div class="card card-default">
                    <div class="card-header card-header-border-bottom">
                        Buat Toko
                    </div>
                    <div class="card-body">
                        @include('admin.partials.flash', ['$errors' => $errors])
                        <form action="{{ route('stores.update', $store->id) }}" method="POST" enctype="multipart/form-data">
                            @method('PUT')
                            @csrf
                            <div class="row">
                                <div class="col-lg-6">
                                    <div class="form-group">
                                        <label for="name">Nama Toko</label>
                                        <input  type="text" class="form-control" id="name" name="name"
                                                value="{{ old('name') ? old('name') : $store->name }}"
                                                placeholder="Masukkan nama toko anda">
                                        <span class="mt-2 d-block">* Wajib diisi.</span>
                                    </div>
                                    <div class="form-group">
                                        <label for="profil">Profil Toko</label>
                                        <input type="file" class="form-control-file" name="profile_toko" id="profil">
                                        <span class="mt-2 d-block">* Dapat dikosongi.</span>
                                    </div>
                                    <div class="form-group">
                                        <label for="foto_ktp">Foto KTP</label>
                                        <input type="file" class="form-control-file" name="foto_ktp" id="foto_ktp">
                                        <span class="mt-2 d-block">* Dapat dikosongi.</span>
                                    </div>
                                    <div class="form-group">
                                        <label for="deskripsi">Deskripsi Toko</label>
                                        <textarea class="form-control" id="deskripsi" name="description" rows="10">{{ old('description') ? old('description') : $store->description }}</textarea>
                                        <span class="mt-2 d-block">* Wajib diisi.</span>
                                    </div>
                                </div>
                                <div class="col-lg-6">
                                    {{-- alamat --}}
                                    <div class="form-group">
                                        <label for="adress">Alamat Toko</label>
                                        <textarea class="form-control" id="adress" name="adrress" rows="5">{{ old('name') ? old('name') : $address->adrress }}</textarea>
                                    </div>
                                    {{-- kode pos --}}
                                    <div class="form-group">
                                        <label for="postal_code">Kode Pos</label>
                                        <input  type="number" class="form-control" id="postal_code"
                                                value="{{ old('postal_code') ? old('postal_code') : $address->postal_code }}"
                                                name="postal_code" placeholder="Masukkan Kode Pos">
                                        <span class="mt-2 d-block">* Wajib diisi.</span>
                                    </div>
                                    {{-- select provinsi --}}
                                    <div class="form-group">
                                        <label for="province_id">Provinsi</label>
                                        <select name="province_id" class="form-control">
                                            <option value="{{ $address->province_id }}">{{ $address->province->province }}</option>
                                            @foreach ($provinces as $province)
                                                <option value="{{ $province->id }}">{{ $province->province }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                    {{-- select kota --}}
                                    <div class="form-group">
                                        <label for="city_id">Kota</label>
                                        <select name="city_id" class="form-control">
                                            <option value="{{ $address->city_id }}">{{ $address->city->city_name }}</option>
                                            @foreach ($cities as $city)
                                                <option value="{{ $city->id }}">{{ $city->city_name }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                    {{-- nomor telepon --}}
                                    <div class="form-group">
                                        <label for="phone">Nomor Telepon</label>
                                        <input type="number" class="form-control" id="phone" name="phone"
                                        value="{{ old('phone') ? old('phone') : $address->phone }}"
                                        placeholder="Masukkan Nomor Telepon">
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
