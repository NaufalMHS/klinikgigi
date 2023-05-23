@extends('admin.layout.main')
@section('content')
<!-- Content -->

<div class="container-xxl flex-grow-1 container-p-y">
    <div class="row">
        <div class="col-lg-12 mb-4 order-0">
            <div class="card">
                <div class="d-flex align-items-end row">
                    <div class="col-sm-7">
                        <div class="card-body">
                            <h5 class="card-title text-primary">Selamat datang, {{ Auth::user()->name }} 🎉</h5>
                            <p class="mb-4">
                            </p>
                        </div>
                    </div>
                    <div class="col-sm-5 text-center text-sm-left">
                        <div class="card-body pb-0 px-0 px-md-4">
                            <img src="{{ asset('admin/img/illustrations/man-with-laptop-light.png') }}" height="140"
                                alt="View Badge User" />
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="col-12 col-lg-6 mb-4 order-1">
            <div class="card h-100">
                <div class="card-header d-flex align-items-center justify-content-between">
                    <h5 class="card-title m-0 me-2">Status Data</h5>
                </div>
                <div class="card-body">
                    <ul class="p-0 m-0">

                        <li class="d-flex mb-4 pb-1">
                            <div class="avatar flex-shrink-0 me-3">
                                <span class="bx bx-info-circle"></span>
                            </div>
                            <div class="d-flex w-100 flex-wrap align-items-center justify-content-between gap-2">
                                <div class="me-2">
                                    <h6 class="mb-0">Informasi Umum</h6>
                                </div>
                                <div class="user-progress d-flex align-items-center gap-1">
                                    <h6 class="mb-0">@if ($information_count === 1) Filled @else Empty @endif </h6>
                                    <a href="/admin-area/informasi-umum" class="btn btn-sm btn-outline-primary">Open</a>
                                </div>
                            </div>
                        </li>
                        <li class="d-flex mb-4 pb-1">
                            <div class="avatar flex-shrink-0 me-3">
                                <span class="bx bx-group"></span>
                            </div>
                            <div class="d-flex w-100 flex-wrap align-items-center justify-content-between gap-2">
                                <div class="me-2">
                                    <h6 class="mb-0">Dokter</h6>
                                </div>
                                <div class="user-progress d-flex align-items-center gap-1">
                                    <h6 class="mb-0"></h6>
                                    <span class="text-muted">Data</span>
                                    <a href="/admin-area/dokter" class="btn btn-sm btn-outline-primary">Open</a>
                                </div>
                            </div>
                        </li>
                        <li class="d-flex mb-4 pb-1">
                            <div class="avatar flex-shrink-0 me-3">
                                <span class="bx bx-images"></span>
                            </div>
                            <div class="d-flex w-100 flex-wrap align-items-center justify-content-between gap-2">
                                <div class="me-2">
                                    <h6 class="mb-0">Galeri Foto</h6>
                                </div>
                                <div class="user-progress d-flex align-items-center gap-1">
                                    <h6 class="mb-0"></h6>
                                    <span class="text-muted">Photos</span>
                                    <a href="/admin-area/galeri" class="btn btn-sm btn-outline-primary">Open</a>
                                </div>
                            </div>
                        </li>
                        <li class="d-flex mb-4 pb-1">
                            <div class="avatar flex-shrink-0 me-3">
                                <span class="bx bxs-user-account"></span>
                            </div>
                            <div class="d-flex w-100 flex-wrap align-items-center justify-content-between gap-2">
                                <div class="me-2">
                                    <h6 class="mb-0">Pengguna</h6>
                                </div>
                                <div class="user-progress d-flex align-items-center gap-1">
                                    <h6 class="mb-0">{{ $user_count }}</h6>
                                    <span class="text-muted">Users</span>
                                    <a href="/admin-area/akun" class="btn btn-sm btn-outline-primary">Open</a>
                                </div>
                            </div>
                        </li>
                    </ul>
                </div>
            </div>
        </div>

        <!-- Total Revenue -->
        <div class="col-12 col-lg-6 order-2  order-md-3 order-lg-2 mb-4">
            <div class="card h-100">
                <div class="card-header">
                    <div class="card-title mb-0">
                        <h5 class="m-0 me-2"></h5>
                    </div>
                </div>
                <div class="card-body px-0">
                    <div class="tab-content p-0">
                        <div class="tab-pane fade show active">

                        </div>
                    </div>
                </div>
            </div>
        </div>

    </div>
</div>
<!-- / Content -->

@endsection