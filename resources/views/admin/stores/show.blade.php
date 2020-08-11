@extends('admin.layout')

@section('content')
<div class="content">							<div class="bg-white border rounded">
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
                        <a class="nav-link" id="profile-tab" data-toggle="tab" href="#profile" role="tab" aria-controls="profile" aria-selected="true">Profile</a>
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
                    <div class="tab-pane fade" id="profile" role="tabpanel" aria-labelledby="profile-tab">

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
