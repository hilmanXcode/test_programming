@extends('layout.main')

@section('content')
    <div class="row">
        <div class="card">
            <div class="card-body p-4">
                <div class="col-lg-12 mb-5">
                    <h5 class="card-title fw-semibold">Transaksi</h5>

                    <div class="my-3">
                        <label for="no" class="form-label">No</label>
                        <input type="text" class="form-control" id="no" name="no" value="{{ $kode_transaksi }}"
                            disabled>
                    </div>
                    <div class="mb-3">
                        <label for="tanggal" class="form-label">Tanggal</label>
                        <input type="date" class="form-control" id="tanggal" name="tanggal">
                    </div>
                </div>

                <div class="col-lg-12">
                    <h5 class="card-title fw-semibold">Customer</h5>
                    <div class="my-3">
                        <label class="form-label">Kode</label>
                        <select class="form-select" onchange="fetchCustomer(this.value)">
                            <option value="-1">Pilih Customer</option>
                            @foreach ($data_customer as $data)
                                <option value="{{ $data->kode }}">{{ $data->kode }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="mb-3">
                        <label for="name" class="form-label">Nama</label>
                        <input type="text" class="form-control" id="name" name="name">
                    </div>
                    <div class="mb-3">
                        <label for="telp" class="form-label">Telp</label>
                        <input type="text" class="form-control" id="telp" name="telp">
                    </div>
                </div>

                <div class="col-lg-12 mt-5">

                    <!-- Button trigger modal -->

                    <!-- Modal -->
                    <div class="modal fade" id="tambah_barang" tabindex="-1" aria-labelledby="exampleModalLabel"
                        aria-hidden="true">
                        <div class="modal-dialog">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h5 class="modal-title" id="exampleModalLabel">Tambah Barang</h5>
                                    <button type="button" class="btn-close" data-bs-dismiss="modal"
                                        aria-label="Close"></button>
                                </div>
                                <div class="modal-body">
                                    <div class="table-responsive">
                                        <table class="table table-bordered text-nowrap mb-0 align-middle" id="datatable">
                                            <thead class="text-dark fs-4">
                                                <tr>
                                                    <th class="border-bottom-0">
                                                        <h6 class="fw-semibold mb-0">Kode</h6>
                                                    </th>
                                                    <th class="border-bottom-0">
                                                        <h6 class="fw-semibold mb-0">Nama Barang</h6>
                                                    </th>
                                                    <th class="border-bottom-0">
                                                        <h6 class="fw-semibold mb-0">Harga Barang</h6>
                                                    </th>
                                                    <th>
                                                        <h6 class="fw-semibold mb-0">Action</h6>
                                                    </th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                @foreach ($barang as $data)
                                                    <tr>
                                                        <td class="border-bottom-0">
                                                            <h6 class="fw-normal mb-0">{{ $data->kode }}</h6>
                                                        </td>
                                                        <td class="border-bottom-0">
                                                            <p class="mb-0 fw-normal">{{ $data->nama }}</p>
                                                        </td>
                                                        <td class="border-bottom-0">
                                                            <p class="mb-0 fw-normal">{{ number_format($data->harga, 2) }}
                                                            </p>
                                                        </td>
                                                        <td>
                                                            <button class="btn btn-primary"
                                                                onclick="tambah_barang('{{ $data->kode }}')">Tambahkan</button>
                                                        </td>
                                                    </tr>
                                                @endforeach
                                            </tbody>

                                        </table>
                                    </div>
                                </div>
                                <div class="modal-footer">
                                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                                    <button type="button" class="btn btn-primary">Save changes</button>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="table-responsive">
                        <table class="table table-bordered text-nowrap mb-0 align-middle">
                            <thead class="text-dark fs-4">
                                <tr>
                                    <th></th>
                                    <th></th>
                                    <th></th>
                                    <th></th>
                                    <th></th>
                                    <th></th>
                                    <th colspan="2" class="text-center">Diskon</th>
                                    <th></th>
                                </tr>
                                <tr>
                                    <th>
                                        <button class="btn btn-primary mb-4" data-bs-toggle="modal"
                                            data-bs-target="#tambah_barang">Tambah</button>
                                    </th>
                                    <th class="border-bottom-0">
                                        <h6 class="fw-semibold mb-0">No</h6>
                                    </th>
                                    <th class="border-bottom-0">
                                        <h6 class="fw-semibold mb-0">Kode Barang</h6>
                                    </th>
                                    <th class="border-bottom-0">
                                        <h6 class="fw-semibold mb-0">Nama Barang</h6>
                                    </th>
                                    <th class="border-bottom-0">
                                        <h6 class="fw-semibold mb-0">Qty</h6>
                                    </th>
                                    <th class="border-bottom-0">
                                        <h6 class="fw-semibold mb-0">Harga Bandrol</h6>
                                    </th>
                                    <th class="border-bottom-0">
                                        <h6 class="fw-semibold mb-0">(%)</h6>
                                    </th>

                                    <th class="border-bottom-0">
                                        <h6 class="fw-semibold mb-0">(Rp)</h6>
                                    </th>
                                    <th class="border-bottom-0">
                                        <h6 class="fw-semibold mb-0">Harga Diskon</h6>
                                    </th>
                                    <th class="border-bottom-0">
                                        <h6 class="fw-semibold mb-0">Total</h6>
                                    </th>

                                </tr>
                            </thead>
                            <tbody id="data_barang">




                            </tbody>
                            {{-- <tr>
                                <th></th>
                                <th></th>
                                <th></th>
                                <th></th>
                                <th class="text-center" colspan="4">
                                    <h6 class="fw-semibold">Grand Total</h6>
                                </th>
                                <th>490,000.00</th>
                            <tr> --}}

                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
