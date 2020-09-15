@extends('user.layout')

@section('content')

<div class="hero-wrap hero-bread mb-5" style="
background-image: url(https://images.unsplash.com/photo-1584192134994-726100c5d92a?ixlib=rb-1.2.1&ixid=eyJhcHBfaWQiOjEyMDd9&auto=format&fit=crop&w=1517&q=80)">
      <div class="container">
        <div class="row no-gutters slider-text align-items-center justify-content-center">
          <div class="col-md-9 ftco-animate text-center">
            <h1 class="mb-0 bread" style=" text-shadow: 0 1px 0 darkgrey; ">Sumbersekar-Mart</h1>
              <p class="breadcrumbs py-1" style="font-size: 16px; text-shadow: 0 1px 0 darkgrey; font-weight: bold; text-transform: none; color: white ">Bumdes Sekar Abadi <br> Desa Sumbersekar</p>
          </div>
        </div>
      </div>
    </div>

<div class="container">
    <div class="row">
        <div class="col-md-8 col-lg-10 order-md-last">
            <div class="row">
                {{-- dipake --}}
                @forelse ($products as $product)
                    <div class="col-sm-6 col-md-6 col-lg-4 ftco-animate">
                    <div class="product">
                        <a href="#" class="img-prod"><img class="img-fluid" src="{{ route('gambar', ['path' => $product->image])  }}" alt="Colorlib Template" style="height: 300px; object-fit: contain" width="100%">
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

        <div class="col-md-4 col-lg-2 sidebar">
            <div class="sidebar-box-2">
                <h2 class="heading mb-4"><a href="{{ route('home') }}">Kategori</a></h2>
                <ul>
                    @forelse ($categories as $category)
                    <li><a href="{{ route('home.category', $category->id) }}">{{ $category->name }}</a></li>
                    @empty

                    @endforelse
                </ul>
            </div>
        </div>
    </div>
</div>
@endsection
