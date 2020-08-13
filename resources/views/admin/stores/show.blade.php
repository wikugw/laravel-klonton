@extends('admin.layout')

@section('content')
<div class="content">
    {{-- session sukses --}}
    @include('admin.partials.flash')
    <div class="bg-white border rounded">
    <div class="row no-gutters">
        <div class="col-lg-4 col-xl-3">
            <div class="profile-content-left pt-5 pb-3 px-3 px-xl-5">
                <div class="card text-center widget-profile px-0 border-0">
                    <div class="card-img mx-auto rounded-circle">
                        @if ($store->profile == "")
                            <img src="{{url('storage/profile_toko/kosong.png')}}"/>
                        @else
                            <img src="{{url($store->profile)}}" alt="profile toko" width="100%" height="100%">
                        @endif
                    </div>
                    <div class="card-body">
                        <h4 class="py-2 text-dark mb-2">{{ $store->name }}</h4>
                        <h5 class="py-2 text-dark mb-2">{{ $store->user->name }}</h5>
                        @if ($store->is_active == '0')
                            <span class="badge badge-warning">Pending</span>
                        @else
                            <span class="badge badge-success">Active</span>
                        @endif
                        <br>
                        <br>
                        <a  href="{{ route('stores.edit', $store->id) }}" class="btn btn-sm btn-success">Edit Toko</a>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-lg-8 col-xl-9">
            <div class="profile-content-right py-5">
                <ul class="nav nav-tabs px-3 px-xl-5 nav-style-border" id="myTab" role="tablist">
                    <li class="nav-item">
                        <a class="nav-link active" id="timeline-tab" data-toggle="tab" href="#info" role="tab" aria-controls="info" aria-selected="false">Info</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" id="profile-tab" data-toggle="tab" href="#product" role="tab" aria-controls="product" aria-selected="true">Product</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" id="settings-tab" data-toggle="tab" href="#settings" role="tab" aria-controls="settings" aria-selected="false">Settings</a>
                    </li>
                </ul>
                <div class="tab-content px-3 px-xl-5" id="myTabContent">
                    <div class="tab-pane fade active show" id="info" role="tabpanel" aria-labelledby="info-tab">
                        <h4 class="pt-4 text-dark mb-2">Deskripsi</h4>
                        <p class="py-2 text-dark mb-2">{{ $store->description }}</p>
                        <h4 class="pt-4 text-dark mb-3">Foto KTP</h4>
                        <img src="{{url($store->foto_ktp)}}" class="img-thumbnail" alt="profile toko">
                    </div>
                    <div class="tab-pane fade" id="product" role="tabpanel" aria-labelledby="product-tab">
                        <div class="py-4">
                            <table id="basic-data-table" class="table nowrap pt-3" style="width:100%">
                                <thead>
                                  <tr>
                                  <th>#</th>
                                  <th>Nama Produk</th>
                                  <th>Kategori</th>
                                  <th>Berat</th>
                                  <th>Harga</th>
                                  <th>Tersedia</th>
                                  <th>Toko</th>
                                  <th>Action</th>
                                 </tr>
                                </thead>

                                <tbody>
                                    @forelse ($products as $product)
                                        <tr>
                                            <td>{{ $product->id }}</td>
                                            <td>{{ $product->name }}</td>
                                            <td>{{ $product->category->name }}</td>
                                            <td>{{ $product->weight }}</td>
                                            <td>{{ $product->price }}</td>
                                            <td>
                                                @if ($product->is_available == '0')
                                                    <span class="badge badge-danger">Habis</span>
                                                @else
                                                    <span class="badge badge-success">Tersedia</span>
                                                @endif
                                            </td>
                                            <td>{{ $product->store->name }}</td>
                                            <td>
                                                @if ($product->is_active == '0')
                                                <a  href="{{ route('products.activate', $store->id) }}"
                                                    class="btn btn-sm btn-primary"
                                                    onclick="return confirm('Yakin ingin mengaktifkan toko?');"
                                                >
                                                    <span class="mdi mdi-check"></span>
                                                </a>
                                                @endif
                                                <a  href="{{ route('products.edit', $product->id) }}" class="btn btn-sm btn-success"><span class="mdi mdi-pencil"></span></a>
                                                <a  href="{{ route('products.show', $product->id) }}" class="btn btn-sm btn-info"><span class="mdi mdi-eye"></span></a>
                                                <form action="{{ route('products.destroy', $product->id) }}" method="post" class="d-inline">
                                                    @method('delete')
                                                    @csrf
                                                    <button class="btn btn-sm btn-danger"
                                                            onclick="return confirm('Yakin ingin menghapus toko?');"
                                                    >
                                                        <span class="mdi mdi-delete"></span>
                                                    </button>
                                                </form>
                                            </td>
                                        </tr>
                                    @empty
                                    <td class="text-center" colspan="8"> Produk tidak ditemukan </td>
                                    @endforelse
                                </tbody>
                               </table>
                            <div class="form-footer pt-4 text-right">
                                @if ($store->is_active == '1')
                                    <a href="{{ route('products.create') }}" class="btn btn-primary btn-sm btn-default">Tambah Produk</a>
                                @endif
                            </div>
                        </div>
                    </div>

                    <div class="tab-pane fade" id="settings" role="tabpanel" aria-labelledby="settings-tab">

                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
</div>
@endsection
