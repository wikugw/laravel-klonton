@extends('admin.layout')

@section('content')
    <div class="content">
        <div class="row">
            @if (Auth::user()->role_id == "1")
            <div class="col-lg-12 ">
            @else
            <div class="col-lg-8 ">
            @endif
                <div class="card card-default">
                    <div class="card-header card-header-border-bottom">
                        <h2>Bank Toko</h2>
                    </div>

                    {{-- session sukses --}}
                    @include('admin.partials.flash')

                    <div class="card-body">

                            <table id="basic-data-table" class="table nowrap" style="width:100%">
                                <thead>
                                  <tr>
                                  <th>#</th>
                                  @if (Auth::user()->role_id == "1")
                                    <th>Toko</th>
                                  @endif
                                  <th>Nama Bank</th>
                                  <th>Nomor Rekening</th>
                                  <th>Atas Nama</th>
                                  <th>Action</th>
                                 </tr>
                                </thead>

                                <tbody>
                                    @forelse ($store_banks as $store_bank)
                                        <tr>
                                            <td>{{ $store_bank->id }}</td>
                                            @if (Auth::user()->role_id == "1")
                                                <td>{{$store_bank->store->name}}</td>
                                            @endif
                                            <td>{{ $store_bank->bank_name }}</td>
                                            <td>{{ $store_bank->nomor_rekening }}</td>
                                            <td>{{ $store_bank->atas_nama }}</td>
                                            <td>
                                                <a  href="{{ route('store_banks.edit', $store_bank->id) }}" class="btn btn-sm btn-success"><span class="mdi mdi-pencil"></span></a>
                                                <form action="{{ route('store_banks.destroy', $store_bank->id) }}" method="post" class="d-inline">
                                                    @method('delete')
                                                    @csrf
                                                    <button class="btn btn-sm btn-danger"
                                                            onclick="return confirm('Yakin ingin menghapus Bank?');"
                                                    >
                                                        <span class="mdi mdi-delete"></span>
                                                    </button>
                                                </form>
                                            </td>
                                        </tr>
                                    @empty
                                    <td class="text-center" colspan="5"> Anda Belum memasukkan Bank </td>
                                    @endforelse
                                </tbody>
                               </table>

                    </div>
                </div>
            </div>
            @if (Auth::user()->role_id == "2")
            <div class="col-lg-4">
                <div class="card card-default">
                    <div class="card-header card-header-border-bottom">
                        Tambah Bank
                    </div>
                    <div class="card-body">
                        <form action="{{ route('store_banks.store') }}" method="POST">
                            @csrf
                            <div class="form-group">
                                <label for="bank_name">Nama Bank</label>
                                <input type="text" class="form-control" id="bank_name" name="bank_name" placeholder="Masukkan nama Bank">
                                <span class="mt-2 d-block">* Wajib diisi.</span>
                            </div>
                            <div class="form-group">
                                <label for="nomor_rekening">Nomor Rekening</label>
                                <input type="text" class="form-control" id="nomor_rekening" name="nomor_rekening" placeholder="Masukkan Nomor Rekening">
                                <span class="mt-2 d-block">* Harus unik.</span>
                            </div>
                            <div class="form-group">
                                <label for="atas_nama">Atas Nama</label>
                                <input type="text" class="form-control" id="atas_nama" name="atas_nama" placeholder="Masukkan Atas Nama">
                                <span class="mt-2 d-block">* Wajib diisi.</span>
                            </div>
                            <div class="form-footer pt-2 border-top">
                                <button type="submit" class="btn btn-primary btn-default">Tambah</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
            @else
            @endif
        </div>
    </div>
@endsection
