@extends('admin.layout')

@section('content')
    <div class="content">
        <div class="row">
            <div class="col-lg-12">
                <div class="card card-default">
                    <div class="card-header card-header-border-bottom">
                        <h2>Produk</h2>
                    </div>

                    {{-- session sukses --}}
                    @include('admin.partials.flash')

                    <div class="card-body">
                        <table id="basic-data-table" class="table nowrap" style="width:100%">
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
                                                        onclick="return confirm('Yakin ingin menghapus produk?');"
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
                            @if (Auth::user()->role_id == '2' && $store->is_active == '1')
                            <a href="{{ route('products.create') }}"
                                class="btn btn-primary btn-sm btn-default">Tambah Produk</a>
                            @endif
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
