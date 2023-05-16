@extends('user.layout.main')

@section('content')
<div class="container-xxl flex-grow-1 container-p-y">
    <h4 class="fw-bold py-3 mb-4"><span class="text-muted fw-light"><a href="/admin-area"
                class="a-breadcrumbs">Beranda</a> /</span> Data Appointment</h4>
    @include('user.layout.alert')
    <div class="card">
        <h5 class="card-header">
            <div class="row">
                <div class="col-md-6">
                    Data appointment
                    <!-----<a href="/admin-area/appointment" class="btn btn-primary btn-sm pl-4">Data Baru</a>--->
                </div>
                <div class="col-md-6">
                    <div class="d-flex flex-row-reverse">
                        <div class="row mb-4">
                            <div class="col-auto">
                                <label for="cari" class="col-form-label">Cari appointment</label>
                            </div>
                            <div class="col-auto">
                                <form action="/user-area/appointment" method="POST" enctype="multipart/form-data">
                                    @csrf
                                    <div class="input-group">
                                        <input required type="text" id="cari" class="form-control" name="cari"
                                            placeholder="Masukkan keyword...">
                                        <button class="btn btn-outline-primary" type="submit">Cari</button>
                                    </div>
                                    @error('judul')
                                    <div class="form-text">
                                        <i class="ri-error-warning-line"></i>
                                        Masukkan keyword pencarian yang valid.
                                    </div>
                                    @enderror
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </h5>
        <div class="table-responsive text-nowrap">
            <table class="table table-hover">
                <thead>
                    <tr class="text-nowrap">
                        <th>No</th>
                        <th>Tanggal Janji</th>
                        <th>Jam</th>
                        <th>Status</th>
                        <th>dokter</th>
                        <th>Keluhan</th>

                        <th>Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    @if (count($appointment) === 0 || Session::has('message'))
                    <tr>
                        <td colspan="4" class="text-center">Tidak Ada Data!</td>
                    </tr>
                    @else
                    @foreach ($appointment as $data)
                    <tr>
                        <th scope="row">{{ $loop -> iteration }}</th>
                        <td>{{ $data -> date }}</td>
                        <td>{{ $data -> time }}</td>
                        <td>{{ $data -> status }}</td>
                        <td>{{ $data -> dokter_id }}</td>
                        <td>{{ $data -> deskripsi }}</td>
                        <td>


                        </td>
                    </tr>
                    @endforeach
                    @endif
                </tbody>
            </table>
        </div>

        {{ $appointment->links('admin.layout.pagination') }}
    </div>

</div>
@endsection