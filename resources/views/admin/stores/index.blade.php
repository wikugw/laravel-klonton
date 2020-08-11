@extends('admin.layout')

@section('content')
    <div class="content">
        <div class="row">
            <div class="col-lg-12">
                <div class="card card-default">
                    <div class="card-header card-header-border-bottom">
                        <h2>Stores</h2>
                    </div>

                    {{-- session sukses --}}
                    @include('admin.partials.flash')

                    <div class="card-body">
                        <table id="basic-data-table" class="table nowrap" style="width:100%">
                            <thead>
                              <tr>
                              <th>#</th>
                              <th>Nama Toko</th>
                              <th>User</th>
                              <th>Status</th>
                              <th>Action</th>
                             </tr>
                            </thead>

                            <tbody>
                                @forelse ($stores as $store)
                                    <tr>
                                        <td>{{ $store->id }}</td>
                                        <td>{{ $store->name }}</td>
                                        <td>{{ $store->user->name }}</td>
                                        <td>
                                            @if ($store->is_active == '0')
                                                <span class="badge badge-warning">Pending</span>
                                            @else
                                                <span class="badge badge-success">Active</span>
                                            @endif
                                        </td>
                                        <td>
                                            @if ($store->is_active == '0')
                                            <a  href="{{ route('stores.activate', $store->id) }}"
                                                class="btn btn-sm btn-primary"
                                                onclick="return confirm('Yakin ingin mengaktifkan toko?');"
                                            >
                                                <span class="mdi mdi-check"></span>
                                            </a>
                                            @endif
                                            <a  href="{{ route('stores.edit', $store->id) }}" class="btn btn-sm btn-success"><span class="mdi mdi-pencil"></span></a>
                                            <a  href="{{ route('stores.show', $store->id) }}" class="btn btn-sm btn-info"><span class="mdi mdi-eye"></span></a>
                                            <form action="{{ route('stores.destroy', $store->id) }}" method="post" class="d-inline">
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
                                <td class="text-center" colspan="5"> Toko tidak ditemukan </td>
                                @endforelse
                            </tbody>
                           </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
