@extends('admin.dashboard')

@section('content')
    <div class="container-fluid">
        <!-- Header -->
        <div class="py-4 mb-4">
            <div class="flex items-center justify-between">
                <div>
                    <h3 class="font-bold text-2xl">{{ $lab->nama_lab }}</h3>
                    <p class="text-gray-500 text-sm mt-1">Kapasitas: {{ $lab->kapasitas }} orang</p>
                </div>
                <a href="{{ route('lab.index') }}" class="px-4 py-2 bg-gray-500 text-white rounded-lg hover:bg-gray-600">
                    <i class="bx bx-arrow-back"></i> Kembali
                </a>
            </div>
        </div>

        <!-- Stats Cards -->
        <div class="grid grid-cols-1 md:grid-cols-3 gap-6 mb-6">
            <div class="bg-gradient-to-br from-blue-400 to-blue-500 rounded-lg shadow-md p-6 text-white">
                <div class="flex items-center justify-between">
                    <div>
                        <p class="text-sm font-medium opacity-90">Total Pengunjung</p>
                        <p class="text-4xl font-bold mt-2">{{ $pengunjung->count() }}</p>
                    </div>
                    <i class="bx bx-user-plus text-5xl opacity-20"></i>
                </div>
            </div>

            <div class="bg-gradient-to-br from-green-400 to-green-500 rounded-lg shadow-md p-6 text-white">
                <div class="flex items-center justify-between">
                    <div>
                        <p class="text-sm font-medium opacity-90">Sedang Menggunakan</p>
                        <p class="text-4xl font-bold mt-2">{{ $pengunjung->whereNull('jam_keluar')->count() }}</p>
                    </div>
                    <i class="bx bx-check-circle text-5xl opacity-20"></i>
                </div>
            </div>

            <div class="bg-gradient-to-br from-orange-400 to-orange-500 rounded-lg shadow-md p-6 text-white">
                <div class="flex items-center justify-between">
                    <div>
                        <p class="text-sm font-medium opacity-90">Sudah Keluar</p>
                        <p class="text-4xl font-bold mt-2">{{ $pengunjung->whereNotNull('jam_keluar')->count() }}</p>
                    </div>
                    <i class="bx bx-log-out text-5xl opacity-20"></i>
                </div>
            </div>
        </div>

        <!-- Daftar Pengunjung -->
        <div class="bg-white rounded-lg shadow-md p-6">
            <h3 class="text-lg font-semibold text-gray-800 mb-4">Daftar Pengunjung</h3>

            @if($pengunjung->count() > 0)
                <div class="overflow-x-auto">
                    <table class="w-full">
                        <thead>
                            <tr class="border-b border-gray-200">
                                <th class="px-4 py-3 text-left text-sm font-semibold text-gray-700">No</th>
                                <th class="px-4 py-3 text-left text-sm font-semibold text-gray-700">Nama Pengunjung</th>
                                <th class="px-4 py-3 text-left text-sm font-semibold text-gray-700">Status Pengguna</th>
                                <th class="px-4 py-3 text-left text-sm font-semibold text-gray-700">Keperluan</th>
                                <th class="px-4 py-3 text-left text-sm font-semibold text-gray-700">Jam Masuk</th>
                                <th class="px-4 py-3 text-left text-sm font-semibold text-gray-700">Jam Keluar</th>
                                <th class="px-4 py-3 text-left text-sm font-semibold text-gray-700">Status</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse($pengunjung as $item)
                                <tr class="border-b border-gray-100 hover:bg-gray-50">
                                    <td class="px-4 py-3 text-sm text-gray-800">{{ $loop->iteration }}</td>
                                    <td class="px-4 py-3 text-sm">
                                        <p class="font-medium text-gray-800">{{ $item->pengunjung->nama_lengkap ?? '-' }}</p>
                                        <p class="text-gray-500 text-xs">{{ $item->pengunjung->email ?? '-' }}</p>
                                    </td>
                                    <td class="px-4 py-3 text-sm">
                                        <span class="bg-blue-100 text-blue-800 px-2 py-1 rounded text-xs font-medium">
                                            {{ ucfirst($item->pengunjung->tipe_pengguna ?? '-') }}
                                        </span>
                                    </td>
                                    <td class="px-4 py-3 text-sm text-gray-600">{{ $item->keperluan->nama_keperluan ?? '-' }}</td>
                                    <td class="px-4 py-3 text-sm text-gray-600">{{ $item->jam_masuk ?? '-' }}</td>
                                    <td class="px-4 py-3 text-sm text-gray-600">{{ $item->jam_keluar ?? '-' }}</td>
                                    <td class="px-4 py-3 text-sm">
                                        @if($item->jam_keluar)
                                            <span class="bg-red-100 text-red-800 px-2 py-1 rounded text-xs font-medium">Keluar</span>
                                        @else
                                            <span class="bg-green-100 text-green-800 px-2 py-1 rounded text-xs font-medium">Aktif</span>
                                        @endif
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="7" class="px-4 py-6 text-center text-gray-500">
                                        Belum ada pengunjung di lab ini
                                    </td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
            @else
                <div class="text-center py-8 text-gray-500">
                    <i class="bx bx-inbox text-5xl opacity-50 block mb-2"></i>
                    <p>Belum ada pengunjung di lab ini</p>
                </div>
            @endif
        </div>
    </div>
@endsection