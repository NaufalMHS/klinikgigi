@extends('user.layout.main')

@section('content')
<div class="container-xxl flex-grow-1 container-p-y">
    <h4 class="fw-bold py-3 mb-4"><span class="text-muted fw-light"><a href="/user-area" class="a-breadcrumbs">Beranda</a> /</span> Data Transaksi</h4>
    @include('user.layout.alert')
    <div class="card">
        <h5 class="card-header">
            <div class="row">
                <div class="col-md-6">
                    Data Transaksi
                    <!-----<a href="/user-area/pasien" class="btn btn-primary btn-sm pl-4">Data Baru</a>--->
                </div>
                <div class="col-md-6">
                    <div class="d-flex flex-row-reverse">
                        <div class="row mb-4">
                            <div class="col-auto">
                                <label for="cari" class="col-form-label">Cari Pasien</label>
                            </div>
                            <div class="col-auto">
                                <form action="/user-area/pasien" method="POST" enctype="multipart/form-data">
                                    @csrf
                                    <div class="input-group">
                                        <input required type="text" id="cari" class="form-control" name="cari" placeholder="Masukkan keyword...">
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
                <a href="{{ route('Pasien.export')}}">
                    <button class="btn btn-outline-primary" type="submit">Export</button>
                </a>
            </div>
        </h5>
        <div class="table-responsive text-nowrap">
            <table class="table table-hover">
                <thead>
                    <tr class="text-nowrap">
                        <th>No</th>
                        <th>Transaksi Kode</th>
                        <th>Fee Dokter</th>
                        <th>Fee Rumah Sakit</th>
                        <th>Total</th>
                        <th>Status</th>
                        <th>Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    @if (count($transaksi) === 0 || Session::has('message'))
                    <tr>
                        <td colspan="4" class="text-center">Tidak Ada Data!</td>
                    </tr>
                    @else
                    @foreach ($transaksi as $data)
                    <tr>
                        <th scope="row">{{ $loop -> iteration }}</th>
                        <td>{{ $data -> transaction_code}}</td>
                        <td>{{ $data -> fee_doctor }}</td>
                        <td>{{ $data -> fee_hospital }}</td>
                        <td>{{ $data -> total }}</td>
                        <td>
                            @php
                            $statusArray = get_object_vars($data);
                            $status = $statusArray['status'];
                            @endphp

                            @if ($status == 2)
                            Payment Completed
                            @elseif ($status == 1)
                            Waiting Payment
                            @else
                            N/A
                            @endif
                        </td>


                        <td>



                        </td>
                    </tr>
                    @endforeach
                    @endif
                </tbody>
            </table>
        </div>

        {{ $transaksi->links('user.layout.pagination') }}
    </div>

</div>
@endsection