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
                              <th>Nama</th>
                              <th>Email</th>
                              <th>No. HP</th>
                              <th>Role</th>
                              <th>Toko</th>
                              <th>Action</th>
                             </tr>
                            </thead>

                            <tbody>
                                @forelse ($users as $user)
                                    <tr>
                                        <td>{{ $user->id }}</td>
                                        <td>{{ $user->name }}</td>
                                        <td>{{ $user->email }}</td>
                                        <td>{{ $user->phone_number }}</td>
                                        <td>
                                            @if ($user->role_id == '1')
                                                <span class="badge badge-primary">Admin</span>
                                            @else
                                                <span class="badge badge-success">User</span>
                                            @endif
                                        </td>
                                        <td>
                                            @if ($user->store_id == '')
                                                -
                                            @else
                                            {{ $user->store['name'] }}
                                            @endif
                                        </td>
                                        <td>
                                            <a  href="{{ route('users.show', $user->id) }}" class="btn btn-sm btn-info"><span class="mdi mdi-eye"></span></a>
                                            <form action="{{ route('users.destroy', $user->id) }}" method="post" class="d-inline">
                                                @method('delete')
                                                @csrf
                                                <button class="btn btn-sm btn-danger"
                                                        onclick="return confirm('Yakin ingin menghapus user?');"
                                                >
                                                    <span class="mdi mdi-delete"></span>
                                                </button>
                                            </form>
                                        </td>
                                    </tr>
                                @empty
                                <td class="text-center" colspan="7"> User tidak ditemukan </td>
                                @endforelse
                            </tbody>
                           </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
