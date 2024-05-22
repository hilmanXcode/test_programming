@extends('layout.main')

@section('content')
    <div class="row">
        <div class="col-lg-12">
            <div class="card w-100">
                <div class="card-body p-4">
                    <h5 class="card-title fw-semibold mb-4">Daftar Transaksi</h5>
                    <div class="table-responsive">
                        <table class="table table-bordered text-nowrap mb-0 align-middle" id="datatable">
                            <thead class="text-dark fs-4">
                                <tr>
                                    <th class="border-bottom-0">
                                        <h6 class="fw-semibold mb-0">No</h6>
                                    </th>
                                    <th class="border-bottom-0">
                                        <h6 class="fw-semibold mb-0">No Transaksi</h6>
                                    </th>
                                    <th class="border-bottom-0">
                                        <h6 class="fw-semibold mb-0">Tanggal</h6>
                                    </th>
                                    <th class="border-bottom-0">
                                        <h6 class="fw-semibold mb-0">Nama Customer</h6>
                                    </th>
                                    <th class="border-bottom-0">
                                        <h6 class="fw-semibold mb-0">Jumlah Barang</h6>
                                    </th>
                                    <th class="border-bottom-0">
                                        <h6 class="fw-semibold mb-0">Sub Total</h6>
                                    </th>
                                    <th class="border-bottom-0">
                                        <h6 class="fw-semibold mb-0">Diskon</h6>
                                    </th>
                                    <th class="border-bottom-0">
                                        <h6 class="fw-semibold mb-0">Ongkir</h6>
                                    </th>
                                    <th class="border-bottom-0">
                                        <h6 class="fw-semibold mb-0">Total</h6>
                                    </th>

                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($datas as $data)
                                    
                                <tr>
                                    <td class="border-bottom-0">
                                        <h6 class="fw-normal mb-0">{{ $loop->iteration }}</h6>
                                    </td>
                                    <td class="border-bottom-0">
                                        <p class="mb-0 fw-normal">{{ $data->sales->kode }}</p>
                                    </td>
                                    <td class="border-bottom-0">
                                        <p class="mb-0 fw-normal">{{ date("d F Y", strtotime($data->sales->tgl)); }}</p>
                                    </td>
                                    <td class="border-bottom-0">
                                        <h6 class="fw-normal">{{ $data->sales->customer->name }}</h6>
                                    </td>
                                    <td class="border-bottom-0">
                                        <p class="mb-0 fw-normal">{{ $data->qty }}</p>
                                    </td>
                                    <td class="border-bottom-0">
                                        <p class="mb-0 fw-normal">{{ number_format($data->harga_bandrol, 2) }}</p>
                                    </td>
                                    <td class="border-bottom-0">
                                        <p class="mb-0 fw-normal">{{ number_format($data->diskon_nilai, 2) }}</p>
                                    </td>
                                    <td class="border-bottom-0">
                                        <p class="mb-0 fw-normal">{{ number_format($data->sales->ongkir, 2) }}</p>
                                    </td>
                                    <td class="border-bottom-0">
                                        <p class="mb-0 fw-normal">{{ number_format($data->total, 2) }}</p>
                                    </td>
                                </tr>
                                @endforeach
                                
                            </tbody>
                            <tr>
                                <th></th>
                                <th></th>
                                <th></th>
                                <th></th>
                                <th class="text-center" colspan="4">
                                    <h6 class="fw-semibold">Grand Total</h6>
                                </th>
                                <th>{{ number_format($grandtotals, 2) }}</th>
                            <tr>

                        </table>
                    </div>
                </div>
            </div>


        </div>
    </div>
@endsection
