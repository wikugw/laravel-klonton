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
                                        <span class="mt-2 d-block">* Wajib diisi.</span>
                                    </div>
                                </div>
                                <div class="col-lg-6">
                                    <div class="form-group">
                                        <label for="deskripsi">Deskripsi Toko</label>
                                        <textarea class="form-control" id="deskripsi" name="description" rows="10">{{ old('description') ? old('description') : $store->description }}</textarea>
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
