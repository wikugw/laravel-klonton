@extends('admin.layout')

@section('content')
    <div class="content">
        <div class="row">
            <div class="col-lg-12">
                <div class="card card-default">
                    <div class="card-header card-header-border-bottom">
                        Edit Produk {{ $product->name }}
                    </div>
                    <div class="card-body">
                        @include('admin.partials.flash', ['$errors' => $errors])
                        <form action="{{ route('products.update', $product->id) }}" method="POST" enctype="multipart/form-data">
                            @method('PUT')
                            @csrf
                            <div class="row">
                                <div class="col-lg-6">
                                    <div class="form-group">
                                        <label for="name">Nama Produk</label>
                                        <input  type="text" class="form-control" id="name" name="name"
                                                value="{{ old('name') ? old('name') : $product->name }}"
                                                placeholder="Masukkan nama produk anda">
                                        <span class="mt-2 d-block">* Wajib diisi.</span>
                                    </div>
                                    {{-- select kategori --}}
                                    <div class="form-group">
                                        <label for="category_id">Kategori</label>
                                        <select name="category_id" class="form-control">
                                                <option value="{{ $product->category_id }}">{{ $product->category->name }}</option>
                                            @foreach ($categories as $category)
                                                <option value="{{ $category->id }}">{{ $category->name }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                    {{-- berat --}}
                                    <div class="form-group">
                                        <label for="weight">Berat Produk (dalam gram)</label>
                                        <input  type="number" class="form-control" id="weight" name="weight"
                                                value="{{ old('weight') ? old('weight') : $product->weight }}"
                                                placeholder="Masukkan berat produk anda contoh 1000">
                                        <span class="mt-2 d-block">* Wajib diisi.</span>
                                    </div>
                                    {{-- harga --}}
                                    <div class="form-group">
                                        <label for="price">Harga Produk</label>
                                        <input  type="number" class="form-control" id="price" name="price"
                                                value="{{ old('price') ? old('price') : $product->price }}"
                                                placeholder="Masukkan harga produk anda contoh 15000">
                                        <span class="mt-2 d-block">* Wajib diisi.</span>
                                    </div>
                                </div>
                                <div class="col-lg-6">
                                    {{-- deskripsi --}}
                                    <div class="form-group">
                                        <label for="deskripsi">Deskripsi Produk</label>
                                        <textarea class="form-control" id="deskripsi" name="description" rows="7">{{ old('description') ? old('description') : $product->description }}</textarea>
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
                                    </div>
                                </div>
                            </div>
                            <div class="form-footer pt-2 border-top">
                                <button type="submit" class="btn btn-primary btn-default">Save</button>
                                <a href="{{ route('products.index') }}" class="btn btn-secondary btn-default">Back</a>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
