@extends('admin.layout')

@section('content')
    <div class="content">
        <div class="col-lg-4">
            <div class="card card-default">
                <div class="card-header card-header-border-bottom">
                    Edit Kategori {{ $category->name }}
                </div>
                <div class="card-body">
                    @include('admin.partials.flash', ['$errors' => $errors])
                    <form action="{{ route('categories.update', $category->id) }}" method="POST">
                        @method('PUT')
                        @csrf
                        <div class="form-group">
                            <label for="name">Nama Kategori</label>
                            <input type="text" class="form-control" id="name"
                                    value="{{ old('name') ? old('name') : $category->name }}"
                                    name="name" placeholder="Masukkan kategori">
                            <span class="mt-2 d-block">* Harus Unik.</span>
                        </div>
                        <div class="form-footer pt-2 border-top">
                            <button type="submit" class="btn btn-primary btn-default">Update</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection
