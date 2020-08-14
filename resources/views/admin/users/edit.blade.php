@extends('admin.layout')

@section('content')
    <div class="content">
        <div class="row">
            <div class="col-lg-8">
                <div class="card card-default">
                    <div class="card-header card-header-border-bottom">
                        User Produk {{ $user->name }}
                    </div>
                    <div class="card-body">
                        @include('admin.partials.flash', ['$errors' => $errors])
                        <form action="{{ route('users.update', $user->id) }}" method="POST" enctype="multipart/form-data">
                            @method('PUT')
                            @csrf
                            <div class="row">
                                <div class="col-lg-12">
                                    {{-- nama --}}
                                    <div class="form-group">
                                        <label for="name">Nama</label>
                                        <input  type="text" class="form-control" id="name" name="name"
                                                value="{{ old('name') ? old('name') : $user->name }}"
                                                placeholder="Masukkan nama anda">
                                        <span class="mt-2 d-block">* Wajib diisi.</span>
                                    </div>
                                    {{-- email --}}
                                    <div class="form-group">
                                        <label for="email">Email</label>
                                        <input  type="email" class="form-control" id="name" name="email"
                                                value="{{ old('email') ? old('email') : $user->email }}"
                                                placeholder="Masukkan email anda">
                                        <span class="mt-2 d-block">* Wajib diisi.</span>
                                    </div>
                                    {{-- no hp --}}
                                    <div class="form-group">
                                        <label for="name">No. HP</label>
                                        <input  type="number" class="form-control" id="name" name="phone_number"
                                                value="{{ old('phone_number') ? old('phone_number') : $user->phone_number }}"
                                                placeholder="Masukkan No. HP anda">
                                        <span class="mt-2 d-block">* Wajib diisi.</span>
                                    </div>
                                    {{-- image --}}
                                    <div class="form-group">
                                        <label for="profile_photo">Gambar</label>
                                        <input type="file" class="form-control-file" name="profile_photo" id="profile_photo">
                                    </div>
                                </div>
                            </div>
                            <div class="form-footer pt-2 border-top">
                                <button type="submit" class="btn btn-primary btn-default">Update</button>
                                <a href="{{ URL::previous() }}" class="btn btn-secondary btn-default">Back</a>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
