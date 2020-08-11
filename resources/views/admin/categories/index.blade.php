@extends('admin.layout')

@section('content')
    <div class="content">
        <div class="row">
            <div class="col-lg-8 ">
                <div class="card card-default">
                    <div class="card-header card-header-border-bottom">
                        <h2>Kategori  Produk</h2>
                    </div>

                    {{-- session sukses --}}
                    @include('admin.partials.flash')

                    <div class="card-body">

                            <table id="basic-data-table" class="table nowrap" style="width:100%">
                                <thead>
                                  <tr>
                                  <th>#</th>
                                  <th>Nama Kategori</th>
                                  <th>Action</th>
                                 </tr>
                                </thead>

                                <tbody>
                                    @forelse ($categories as $category)
                                        <tr>
                                            <td>{{ $category->id }}</td>
                                            <td>{{ $category->name }}</td>
                                            <td>
                                                <a  href="{{ route('categories.edit', $category->id) }}" class="btn btn-sm btn-success"><span class="mdi mdi-pencil"></span></a>
                                                <form action="{{ route('categories.destroy', $category->id) }}" method="post" class="d-inline">
                                                    @method('delete')
                                                    @csrf
                                                    <button class="btn btn-sm btn-danger"
                                                            onclick="return confirm('Yakin ingin menghapus Kategori?');"
                                                    >
                                                        <span class="mdi mdi-delete"></span>
                                                    </button>
                                                </form>
                                            </td>
                                        </tr>
                                    @empty
                                    <td class="text-center" colspan="5"> Kategori tidak ditemukan </td>
                                    @endforelse
                                </tbody>
                               </table>

                    </div>
                </div>
            </div>
            <div class="col-lg-4">
                <div class="card card-default">
                    <div class="card-header card-header-border-bottom">
                        Tambah Kategori
                    </div>
                    <div class="card-body">
                        <form action="{{ route('categories.store') }}" method="POST">
                            @csrf
                            <div class="form-group">
                                <label for="name">Nama Kategori</label>
                                <input type="text" class="form-control" id="name" name="name" placeholder="Masukkan kategori">
                                <span class="mt-2 d-block">* Harus Unik.</span>
                            </div>
                            <div class="form-footer pt-2 border-top">
                                <button type="submit" class="btn btn-primary btn-default">Tambah</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
