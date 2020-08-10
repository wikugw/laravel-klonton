@extends('admin.layout')

@section('content')
    <div class="content">
        <div class="row">
            <div class="col-lg-12">
                <div class="card card-default">
                    <div class="card-header card-header-border-bottom">
                        <h2>Stores</h2>
                    </div>

                    <div class="card-body">
                        <table id="basic-data-table" class="table nowrap" style="width:100%">
                            <thead>
                              <tr>
                              <th>#</th>
                              <th>Nama Toko</th>
                              <th>User</th>
                              <th>Action</th>
                             </tr>
                            </thead>

                            <tbody>
                                @forelse ($stores as $store)
                                    <tr>
                                        <td>{{ $store->id }}</td>
                                        <td>{{ $store->name }}</td>
                                        <td>{{ $store->user_id }}</td>
                                        <td>
                                            <a  href="{{ route('stores.edit', $store->id) }}" class="btn btn-success">Edit</a>
                                        </td>
                                    </tr>
                                @empty
                                <td class="text-center" colspan="4"> Toko tidak ditemukan </td>
                                @endforelse
                             {{-- <tr>
                              <td>Tiger</td>
                              <td>Nixon</td>
                              <td>System Architect</td>
                              <td>Edinburgh</td>
                              <td>61</th>
                              <td>2011/04/25</td>
                              <td>$320,800</td>
                              <th>5421</td>
                              <td>t.nixon@datatables.net</td>
                             </tr> --}}
                            </tbody>
                           </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
