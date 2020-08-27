@extends('admin.layout')

@section('content')
    <div class="content">
        <div class="card card-default">
            <div class="card-header justify-content-between mb-4 ml-4">
              <h1>{{ $product->name }}</h1>
            </div>
            <div class="card-body">
                <div class="row">
                    <div class="col-lg-6">
                        <img src="{{url($product->image)}}" alt="gambar produk" width="100%" height="100%">
                    </div>
                    <div class="col-lg-6">
                        <div class="row">
                            <div class="col-3 py-3">
                                <h5 class="text-dark font-weight-medium">Harga:</h5>
                            </div>
                            <div class="col-3 py-3">
                                <h5 class="font-weight-medium">Rp. {{ $product->price }}</h5>
                            </div>
                            <div class="col-3 py-3">
                                <h5 class="text-dark font-weight-medium">Kategori:</h5>
                            </div>
                            <div class="col-3 py-3">
                                <h5 class="font-weight-medium">{{ $product->category->name }}</h5>
                            </div>
                            <div class="col-3 py-3">
                                <h5 class="text-dark font-weight-medium">Berat:</h5>
                            </div>
                            <div class="col-3 py-3">
                                <h5 class="font-weight-medium">{{ $product->weight }} gram</h5>
                            </div>
                            <div class="col-3 py-3">
                                <h5 class="text-dark font-weight-medium">Tersedia:</h5>
                            </div>
                            <div class="col-3 py-3">
                                @if ($product->is_available == '0')
                                    <span class="badge badge-danger">Habis</span>
                                @else
                                    <span class="badge badge-success">Tersedia</span>
                                @endif
                            </div>
                            <div class="col-3 py-3">
                                <h5 class="text-dark font-weight-medium">Toko:</h5>
                            </div>
                            <div class="col-3 py-3">
                                <h5 class="font-weight-medium">{{ $product->store->name }}</h5>
                            </div>
                        </div>
                        <div class="row mb-5">
                            <h5 class="ml-3 mt-3 font-weight-medium">{{ $product->description }}</h5>
                        </div>
                        <div class="form-footer pt-2">
                            @if (Auth::user()->role_id == '2')
                            <a href="{{ route('stores.products', Auth::user()->store_id) }}" class="btn btn-secondary btn-default">Back</a>
                            @else
                            <a href="{{ route('products.index') }}" class="btn btn-secondary btn-default">Back</a>
                            @endif

                        </div>
                    </div>
                </div>
              </div>
          </div>
    </div>
@endsection
