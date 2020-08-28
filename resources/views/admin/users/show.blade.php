@extends('admin.layout')

@section('content')
<div class="content">
    <div class="bg-white border rounded">
        {{-- session sukses --}}
        @include('admin.partials.flash')
        <div class="row no-gutters">
            <div class="col-lg-4 col-xl-3">
                <div class="profile-content-left profile-left-spacing pt-5 pb-3 px-3 px-xl-5">
                    <div class="card text-center widget-profile px-0 border-0">
                        <div class="card-img mx-auto rounded-circle">
                            @if ($user->profile_photo == '')
                            <img src="{{url('storage/foto_user/kosong.png')}}" width="100%" />
                            @else
                            <img src="{{ route('gambar', ['path' => $user->profile_photo])  }}" alt="profile toko" height="100%">
                            @endif
                        </div>
                        <div class="card-body">
                            <h4 class="py-2 text-dark">{{ $user->name }}</h4>


                        </div>
                    </div>

                    <hr class="w-100">
                    <div class="contact-info pt-4">
                        <h5 class="text-dark mb-1">Contact Information</h5>
                        <p class="text-dark font-weight-medium pt-4 mb-2">Email address</p>
                        <p>{{ $user->email }}</p>
                        <p class="text-dark font-weight-medium pt-4 mb-2">Phone Number</p>
                        <p>{{ $user->phone_number }}</p>




                    </div>
                </div>
            </div>
            <div class="col-lg-8 col-xl-9">
                <div class="profile-content-right profile-right-spacing py-5">
                    <ul class="nav nav-tabs px-3 px-xl-5 nav-style-border" id="myTab" role="tablist">


                        <li class="nav-item">
                            <a class="nav-link active" id="settings-tab" data-toggle="tab" href="#settings" role="tab"
                                aria-controls="settings" aria-selected="false">Edit Biodata</a>
                        </li>
                    </ul>
                    <div class="tab-content px-3 px-xl-5" id="myTabContent">


                        <div class="tab-pane fade show active" id="settings" role="tabpanel"
                            aria-labelledby="settings-tab">
                            <div class="tab-pane-content mt-5">
                                <form action="{{ route('users.update', $user->id) }}" method="POST"
                                    enctype="multipart/form-data">
                                    @method('PUT')
                                    @csrf
                                    <div class="form-group row mb-4">
                                        <label for="coverImage" class="col-sm-4 col-lg-2 col-form-label">User
                                            Image</label>
                                        <div class="col-sm-8 col-lg-10">
                                            <div class="custom-file mb-1">
                                                <input type="file" name="profile_photo" id="coverImage">
                                                <div class="invalid-feedback">Example invalid custom file feedback</div>
                                            </div>
                                        </div>
                                    </div>


                                    <div class="form-group mb-4">
                                        <label for="userName">Nama</label>
                                        <input type="text" class="form-control" name="name" id="userName"
                                            value="{{ $user->name }}">
                                        <span class="d-block mt-1">* Wajib diisi</span>
                                    </div>

                                    <div class="form-group mb-4">
                                        <label for="email">Email</label>
                                        <input type="email" class="form-control" name="email" id="email"
                                            value="{{ $user->email }}">
                                        <span class="d-block mt-1">* Wajib diisi</span>
                                    </div>

                                    <div class="form-group mb-4">
                                        <label for="email">No. HP</label>
                                        <input type="number" class="form-control" name="phone_number" id="email"
                                            value="{{ $user->phone_number }}">
                                        <span class="d-block mt-1">* Wajib diisi</span>
                                    </div>

                                    <div class="d-flex justify-content-end mt-5">
                                        <button type="submit" class="btn btn-primary mb-2 btn-pill">Update
                                            Profile</button>
                                    </div>

                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
