@extends('user.layout')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-12 col-lg-12 order-md-last">
            <div class="row">
                {{-- dipake --}}
                @forelse ($store_addresses as $store_address)
                    <div class="col-sm-6 col-md-6 col-lg-3 ftco-animate">
                    <div class="product">
                        <a href="#" class="img-prod"><img class="img-fluid"
                            src="{{ route('gambar', ['path' => $store_address->store->profile])  }}"
                            alt="Colorlib Template" style="height: 300px; object-fit: contain" width="100%">
                            <div class="overlay"></div>
                        </a>
                        <div class="text py-3 px-3">
                            <h3 style="font-weight: bold"><a href="#">{{ $store_address->store->name }}</a></h3>
                            <div class="d-flex">
                                <div class="pricing">
                                    <p class="price"><span>Kota {{ $store_address->city->city_name }}</span></p>
                                </div>
                                <div class="rating">
                                    <p class="text-right">
                                        <a href="{{ route('home.store', $store_address->store_id) }}" class="btn btn-sm btn-primary">Detail</a>
                                    </p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                @empty
                <div class="container">
                    <div class="row justify-content-center mt-5 mb-3 pb-3">
              <div class="col-md-12 heading-section text-center ftco-animate fadeInUp ftco-animated">
                <h4 class="mb-4">Toko tidak ditemukan :(</h4>
              </div>
            </div>
            </div>
                @endforelse
            </div>
        </div>

    </div>
</div>
@endsection
