@extends('admin.dashboard')
@section('content')
        <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

    <h1>Daftar Lab</h1>
    <div class="relative overflow-x-auto bg-neutral-primary-soft shadow-xs rounded-base border border-default">
        <div class="">
            <div class="flex items-center justify-between p-4">
                <a href="{{ route('lab.create') }}"
                    class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded">Tambah Lab</a>
            </div>
        </div>
        <table class="w-full flex-row  text-sm text-left rtl:text-right text-body">
            <thead class="text-sm text-body bg-neutral-secondary-soft border-b rounded-base border-default">
                <tr>
                    <th scope="col" class="px-6 py-3 font-medium">
                        No
                    </th>
                    <th scope="col" class="px-6 py-3 font-medium">
                        Nama Lab
                    </th>
                    <th scope="col" class="px-6 py-3 font-medium">
                        Kapasitas Sekarang
                    </th>
                    <th scope="col" class="px-6 py-3 font-medium">
                        Aksi
                    </th>

                </tr>
            </thead>
            <tbody>
                @forelse ($labs as $l)
                    <tr class="bg-neutral-primary border-b border-default ">
                        <th scope="row" class="px-6 py-4 font-medium text-heading whitespace-nowrap">
                            {{ $loop->iteration }}
                        </th>
                        <th scope="row" class="px-6 py-4 font-medium text-heading whitespace-nowrap">
                            {{ $l->nama_lab }}
                        </th>
                        <td class="px-6 py-4">
                            {{ $l->aktif_count }}/{{ $l->kapasitas }}
                        </td>
                        <td class="px-1 py-4">
                            <a href="{{ route('lab.edit', $l->id) }}"
                                class="bg-yellow-400 hover:bg-yellow-700 text-white font-bold py-2 px-4 mx-3 rounded">Edit</a>
                            <form action="{{ route('lab.destroy', $l->id) }}" method="POST" class="inline">
                                @csrf
                                @method('DELETE')
                                <button type="button" class="bg-red-500 hover:bg-red-700 text-white font-bold py-2 px-4 rounded btn-hapus"
                                   >Hapus</button>
                            </form>
                        </td>

                    </tr>
                @empty

                @endforelse


            </tbody>
        </table>
    </div>

    <script>
        // Gunakan DOMContentLoaded agar script jalan setelah halaman siap
        document.addEventListener('DOMContentLoaded', function () {

            // 1. Notifikasi Sukses Tambah/Edit
            @if(session('success'))
                Swal.fire({
                    icon: 'success',
                    title: 'Berhasil!',
                    text: "{{ session('success') }}",
                    showConfirmButton: false,
                    timer: 2000
                });
            @endif

            // 2. Notifikasi Setelah Berhasil Hapus
            @if(session('deleted'))
                Swal.fire({
                    icon: 'success',
                    title: 'Terhapus!',
                    text: "{{ session('deleted') }}",
                    showConfirmButton: false,
                    timer: 2000
                });
            @endif

            // 3. Konfirmasi Klik Tombol Hapus
            document.addEventListener('click', function (e) {
                if (e.target.classList.contains('btn-hapus')) {
                    e.preventDefault();
                    const form = e.target.closest('form');

                    Swal.fire({
                        title: 'Apakah Anda yakin?',
                        text: "Data lab ini akan dihapus permanen!",
                        icon: 'warning',
                        showCancelButton: true,
                        confirmButtonColor: '#ef4444',
                        cancelButtonColor: '#6b7280',
                        confirmButtonText: 'Ya, Hapus!',
                        cancelButtonText: 'Batal'
                    }).then((result) => {
                        if (result.isConfirmed) {
                            form.submit();
                        }
                    });
                }
            });
        });
    </script>
@endsection

