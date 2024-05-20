@extends('layout.main')

@section('content')
    <div class="row">
        <div class="col-lg-12">
            <div class="card">
                <div class="card-body p-4">
                    <h1 class="fs-6 text-center fw-semibold mb-4">Tambah Barang</h1>
                    <form method="POST" action="{{ route('barang.store') }}">
                        @csrf
                        <div class="row">
                            <div class="col-lg-12">
                                <div class="mb-3">
                                    <label for="kode" class="form-label">Kode Barang</label>
                                    <input type="text" class="form-control" id="kode" name="kode"
                                        value="{{ old('kode') }}">
                                </div>
                                <div class="mb-3">
                                    <label for="nama" class="form-label">Nama Barang</label>
                                    <input type="text" class="form-control" id="nama" name="nama"
                                        value="{{ old('nama') }}">
                                </div>
                                <div class="mb-3">
                                    <label for="harga" class="form-label">Harga Barang</label>
                                    <input type="number" class="form-control" id="harga" name="harga"
                                        value="{{ old('harga') }}">
                                </div>
                                <button class="btn btn-primary w-100" type="submit">Submit</button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection
