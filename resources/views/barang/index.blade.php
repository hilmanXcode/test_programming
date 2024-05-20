@extends('layout.main')

@section('content')
    <div class="row">
        <div class="col-lg-12">
            <div class="card">
                <div class="card-body p-4">
                    <a href="{{ route('barang.add') }}" class="btn btn-primary">
                        <span>
                            <i class="ti ti-circle-plus"></i>
                        </span>
                        Tambah Barang</a>
                    @if ($barang != '[]')
                        <h5 class="card-title fw-semibold my-4">Daftar Transaksi</h5>
                        <div class="table-responsive">
                            <table class="table table-bordered text-nowrap mb-0 align-middle" id="daftar_transaksi_table">
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
                                                <p class="mb-0 fw-normal">{{ number_format($data->harga, 2) }}</p>
                                            </td>
                                            <td class="d-flex gap-4">
                                                <a href='{{ route('barang.edit', $data->id) }}'
                                                    class="btn btn-warning">Edit</a>
                                                <form method="POST" action="{{ route('barang.delete', $data->id) }}">
                                                    @csrf
                                                    <input type="hidden" name="_method" value="DELETE" />
                                                    <button type="submit"
                                                        class="btn btn-danger show_confirm">Delete</button>
                                                </form>
                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>

                            </table>
                        </div>
                    @else
                        <h5 class="card-title fw-semibold text-center">No Data</h5>
                    @endif
                </div>
            </div>
        </div>
    </div>
@endsection
