@extends('admin.dashboard')
@section('content')
    <div class="container-fluid">
        <h1>Tambah Lab</h1>
        <div class="card">
            <div class="card-body">
                <h5 class="card-title fw-semibold mb-4">Forms Tambah Lab</h5>
                <div class="card">
                    <div class="card-body">
                        <form action="{{ route('lab.store') }}" method="POST">
                            @csrf
                            <div class="mb-3">
                                <label for="namaLab" class="form-label">Nama Lab</label>
                                <input type="text" class="form-control" id="namaLab" name="nama_lab" required>
                            </div>
                            <div class="mb-3">
                                <label for="kapasitas" class="form-label">Kapasitas</label>
                                <input type="number" class="form-control" id="kapasitas" name="kapasitas" min="1" required>
                            </div>
                            
                            <button type="submit" class="btn btn-primary">Simpan</button>
                        </form>
                    </div>
                </div>
                
            </div>
        </div>
    </div>
@endsection