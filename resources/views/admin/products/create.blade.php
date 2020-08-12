@extends('admin.layout')

@section('content')
    <div class="content">
        <div class="row">
            <div class="col-lg-12">
                <div class="card card-default">
                    <div class="card-header card-header-border-bottom">
                        Buat Produk
                    </div>
                    <div class="card-body">
                        @include('admin.partials.flash', ['$errors' => $errors])
                        <form action="{{ route('products.store') }}" method="POST" enctype="multipart/form-data">
                            @csrf
                            <div class="row">
                                <div class="col-lg-6">
                                    <div class="form-group">
                                        <label for="name">Nama Produk</label>
                                        <input type="text" class="form-control" id="name" name="name" placeholder="Masukkan nama produk anda">
                                        <span class="mt-2 d-block">* Wajib diisi.</span>
                                    </div>
                                    {{-- select kategori --}}
                                    <div class="form-group">
                                        <label for="category_id">Kategori</label>
                                        <select name="category_id" class="form-control">
                                            @foreach ($categories as $category)
                                                <option value="{{ $category->id }}">{{ $category->name }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                    {{-- berat --}}
                                    <div class="form-group">
                                        <label for="weight">Berat Produk (dalam gram)</label>
                                        <input type="number" class="form-control" id="weight" name="weight" placeholder="Masukkan berat produk anda contoh 1000">
                                        <span class="mt-2 d-block">* Wajib diisi.</span>
                                    </div>
                                    {{-- harga --}}
                                    <div class="form-group">
                                        <label for="price">Harga Produk</label>
                                        <input type="number" class="form-control" id="price" name="price" placeholder="Masukkan harga produk anda contoh 15000">
                                        <span class="mt-2 d-block">* Wajib diisi.</span>
                                    </div>
                                </div>
                                <div class="col-lg-6">
                                    {{-- deskripsi --}}
                                    <div class="form-group">
                                        <label for="deskripsi">Deskripsi Produk</label>
                                        <textarea class="form-control" id="deskripsi" name="description" rows="7"></textarea>
                                        <span class="mt-2 d-block">* Wajib diisi.</span>
                                    </div>
                                    {{-- select tersedia --}}
                                    <div class="form-group">
                                        <label for="is_available">Tersedia</label>
                                        <select name="is_available" class="form-control">
                                            <option value="0">Tidak</option>
                                            <option value="1">Tersedia</option>
                                        </select>
                                    </div>
                                    {{-- image --}}
                                    <div class="form-group">
                                        <label for="image">Gambar</label>
                                        <input type="file" class="form-control-file" name="image" id="image">
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
