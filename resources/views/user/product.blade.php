@extends('user.layout')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-lg-6 mb-5 ftco-animate fadeInUp ftco-animated">
            <a href="{{ route('gambar', ['path' => $product->image])  }}" class="image-popup"><img src="{{ route('gambar', ['path' => $product->image])  }}" class="img-fluid"
                    alt="Colorlib Template"></a>
        </div>
        <div class="col-lg-6 product-details pl-md-5 ftco-animate fadeInUp ftco-animated">
            <h3>{{ $product->name }}</h3>
            <div class="rating d-flex">
                <p class="text-left mr-4">
                    <a href="#" class="mr-2" style="color: #000;">{{ $transaction_details->count() }} <span
                            style="color: #bbb;">Terjual</span></a>
                </p>
                <p class="text-left mr-4">
                    <a href="#" class="mr-2" style="color: #000;">{{ $product->weight }} Gr<span style="color: #bbb;">
                            Berat </span></a>
                </p>
                <p class="text-left mr-4">
                    <a href="{{ route('home.store', $product->store_id) }}" class="mr-2" style="color: #000;">{{ $product->store->name }} <span
                            style="color: #bbb;"> Penjual</span></a>
                </p>
            </div>
            <p class="price"><span>Rp. {{ $product->price }}</span></p>
            <p>{{ $product->description }}</p>

            <p><a href="{{ route('carts.add', $product->id) }}" class="btn btn-black py-3 px-5">Add to Cart</a></p>
        </div>
    </div>
</div>

<div class="container">
    <div class="row">
        <div class="col-md-12 col-lg-12 order-md-last">
            <h3 class="py-3">Produk dengan kategori sama</h3>
            <div class="row">
                {{-- dipake --}}
                @forelse ($products as $product)
                    <div class="col-sm-6 col-md-6 col-lg-3 ftco-animate">
                    <div class="product">
                        <a href="#" class="img-prod"><img class="img-fluid" src="{{ route('gambar', ['path' => $product->image])  }}"  alt="Colorlib Template" style="height: 300px; object-fit: contain" width="100%">
                            <div class="overlay"></div>
                        </a>
                        <div class="text py-3 px-3">
                            <h3><a href="#">{{ $product->name }}</a></h3>
                            <div class="d-flex">
                                <div class="pricing">
                                    <p class="price"><span>Rp. {{ $product->price }}</span></p>
                                </div>
                            </div>
                            <p class="bottom-area d-flex px-3">
                                <a href="{{ route('carts.add', $product->id) }}" class="add-to-cart text-center py-2 mr-1"><span>Add to cart <i class="ion-ios-add ml-1"></i></span></a>
                                <a href="{{ route('home.product', $product->id) }}" class="buy-now text-center py-2">Detail<span><i class="ion-ios-eye ml-1"></i></span></a>
                            </p>
                        </div>
                    </div>
                </div>
                @empty
                <div class="container">
                    <div class="row justify-content-center mt-5 mb-3 pb-3">
              <div class="col-md-12 heading-section text-center ftco-animate fadeInUp ftco-animated">
                <h4 class="mb-4">Produk tidak ditemukan :(</h4>
              </div>
            </div>
            </div>
                @endforelse
            </div>
        </div>
    </div>
</div>
@endsection
