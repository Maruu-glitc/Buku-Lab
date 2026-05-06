@extends('admin.dashboard')
@section('content')
    <div class="container">
        <h1>Daftar Aktif Penggunaan Lab</h1>

        <!-- Debug info -->
        @if($penggunaanLabs)
            <div class="grid grid-cols-1 md:grid-cols-2">
                <div  class="bg-amber-300/25 backdrop-blur-lg border-1 border-orange-400 rounded-md p-2 px-3 my-3 w-1/2 shadow-md shadow-amber-500/60">
                    <p><strong class="text-amber-500">Total Pengunjung Aktif</strong></p>

                    <div class="flex items-center justify-between gap-2">

                        <span class="text-4xl text-zinc-900">{{ $penggunaanLabs->count() }}

                        </span>
                        <i class="bx bx-info-circle "></i>
                    </div>

                </div>
            </div>
        @else
            <div style="background: #ffcccc; padding: 10px; margin: 10px 0; border-radius: 5px;">
                <p><strong style="color: red;">ERROR: Variable $penggunaanLabs is null!</strong></p>
            </div>
        @endif

        <div class="flex justify-between items-center mb-4">
            <h4 class="text-1xl font-semibold">Daftar Aktif</h4>

            <form method="GET">
                <select name="sort" onchange="this.form.submit()"
                    class="border border-gray-300 rounded-lg px-3 py-2 text-sm focus:ring-2 focus:ring-blue-500">
                    <option value="terbaru" {{ request('sort') == 'terbaru' ? 'selected' : '' }}>
                        Terbaru
                    </option>
                    <option value="terlama" {{ request('sort') == 'terlama' ? 'selected' : '' }}>
                        Terlama
                    </option>
                </select>
            </form>
        </div>

        <table class="table table-bordered">
            <thead>
                <tr>
                    <th>No</th>
                    <th>Nama Pengguna</th>
                    <th>Program Studi</th>
                    <th>Lab</th>
                    <th>Keperluan</th>
                    <th>Jam Masuk</th>
                    <th>Status Pengguna</th>
                    <th>Tanggal</th>
                </tr>
            </thead>
            <tbody>
                @forelse($penggunaanLabs ?? [] as $index => $penggunaan)
                    <tr>
                        <td>{{ $index + 1 }}</td>
                        <td>{{ $penggunaan->pengunjung->nama_lengkap }}</td>
                        <td>{{ $penggunaan->pengunjung->prodi }}</td>
                        <td>{{ $penggunaan->lab->nama_lab }}</td>
                        <td>{{ $penggunaan->keperluan->nama_keperluan }}</td>
                        <td>{{ $penggunaan->jam_masuk }}</td>
                        <td>{{ $penggunaan->pengunjung->tipe_pengguna }}</td>
                        <td>{{ $penggunaan->tanggal }}</td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="8" class="text-center">
                            <span class="inline-flex flex-col items-center justify-center gap-2">
                                <i class="bx bx-search-x text-5xl opacity-35"></i>
                                <span>Tidak ada pengguna yang aktif</span>
                            </span>
                        </td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>
@endsection