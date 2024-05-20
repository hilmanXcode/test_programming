@extends('layout.main')

@section('content')
    <div class="row">
        <div class="col-lg-12">
            <div class="card">
                <div class="card-body p-4">
                    <h1 class="fs-6 text-center fw-semibold mb-4">Edit Customer</h1>
                    <form method="POST" action="{{ route('customer.update', $data->id) }}">
                        @csrf
                        <div class="row">
                            <div class="col-lg-12">
                                <div class="mb-3">
                                    <label for="kode" class="form-label">Kode Customer</label>
                                    <input type="text" class="form-control" id="kode" name="kode"
                                        value="{{ $data->kode }}">
                                </div>
                                <div class="mb-3">
                                    <label for="name" class="form-label">Nama Customer</label>
                                    <input type="text" class="form-control" id="name" name="name"
                                        value="{{ $data->name }}">
                                </div>
                                <div class="mb-3">
                                    <label for="telp" class="form-label">Telp Customer</label>
                                    <input type="number" class="form-control" id="telp" name="telp"
                                        value="{{ $data->telp }}">
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
