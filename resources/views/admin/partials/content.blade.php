<!doctype html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <script src="https://cdn.jsdelivr.net/npm/@tailwindcss/browser@4"></script>
    <!-- Basic Icons -->
    <link href="https://cdn.boxicons.com/3.0.8/fonts/basic/boxicons.min.css" rel="stylesheet">
    <!-- Filled Icons -->
    <link href="https://cdn.boxicons.com/3.0.8/fonts/filled/boxicons-filled.min.css" rel="stylesheet">
    <!-- Brand Icons -->
    <link href="https://cdn.boxicons.com/3.0.8/fonts/brands/boxicons-brands.min.css" rel="stylesheet">
    <title>Lab Visitor Management System</title>
    <link rel="shortcut icon" type="image/png" href="{{ asset('icon/unibba.png') }}" />
    <link rel="stylesheet" href="{{ asset('assets/css/styles.min.css') }}" />
</head>

<body>
    <!--  Body Wrapper -->
    <div class="page-wrapper" id="main-wrapper" data-layout="vertical" data-navbarbg="skin6" data-sidebartype="full"
        data-sidebar-position="fixed" data-header-position="fixed">
        <!-- Sidebar Start -->
        @include('admin.partials.sidebar', ['labs' => $labs ?? []])
        <!--  Sidebar End -->

        <!--  Main wrapper -->
        <div class="body-wrapper">
            <!--  Header Start -->
            @include('admin.partials.navbar')
            <!--  Header End -->

            <div class="container-fluid">
                <!-- Header -->
                <div class="py-4 mb-4">
                    <h3 class="font-bold text-2xl">Dashboard</h3>
                </div>

                <!-- Welcome Card -->
                <div class="bg-white rounded-lg shadow-sm p-6 mb-6">
                    <h2 class="text-2xl font-bold text-gray-800 mb-2">Welcome to the Dashboard</h2>
                    <p class="text-gray-500">Ini adalah dashboard manajemen lab dan pengunjung</p>
                </div>

                <!-- Stats Cards -->
                <div class="grid grid-cols-1 md:grid-cols-2 gap-6 mb-6">

                    <!-- Total Lab Card -->
                    <div class="bg-gradient-to-br from-neutral-300/20 to-emerald-300/50 border-1 border-emerald-500/35 rounded-2xl shadow-sm p-6 `">
                        <div class="flex items-center justify-between">
                            <div>
                                <p class="text-sm font-medium opacity-80 text-emerald-500">Total Lab</p>
                                <p class="text-4xl font-bold mt-2 text-zinc-900">{{ $totalLabs }}</p>
                            </div>
                            <i class="bx bx-monitor-wide text-5xl opacity-30 text-emerald-600"></i>
                        </div>
                    </div>

                    <!-- Total Pengguna Aktif Card -->
                    <div class="relative overflow-hidden rounded-2xl p-6 text-neutral-900" style="
                           background: linear-gradient(135deg, rgba(168,85,247,0.18) 0%, rgba(139,92,246,0.10) 40%, rgba(168,85,247,0.06) 60%, rgba(109,40,217,0.14) 100%);
                           backdrop-filter: blur(24px) saturate(180%);
                           -webkit-backdrop-filter: blur(24px) saturate(180%);
                           border: 1px solid rgba(168,85,247,0.35);
                           border-bottom-color: rgba(168,85,247,0.15);
                           border-right-color: rgba(168,85,247,0.15);
                           box-shadow: inset 0 1px 0 rgba(255,255,255,0.55);
                         ">
                    
                        {{-- Shine overlay atas --}}
                        <div class="pointer-events-none absolute inset-x-0 top-0 h-1/2 rounded-t-2xl"
                            style="background: linear-gradient(180deg, rgba(255,255,255,0.40) 0%, transparent 100%);"></div>
                    
                        {{-- Bubble dekoratif --}}
                        <div class="pointer-events-none absolute bottom-[-10px] right-5 h-14 w-14 animate-pulse rounded-full"
                            style="background: radial-gradient(circle at 30% 30%, rgba(255,255,255,0.6), rgba(168,85,247,0.12)); border: 1px solid rgba(255,255,255,0.5);">
                        </div>
                        <div class="pointer-events-none absolute bottom-2 right-20 h-8 w-8 animate-pulse rounded-full"
                            style="background: radial-gradient(circle at 30% 30%, rgba(255,255,255,0.5), rgba(168,85,247,0.10)); border: 1px solid rgba(255,255,255,0.4); animation-delay: 0.5s;">
                        </div>
                    
                        {{-- Konten --}}
                        <div class="relative z-10 flex items-center justify-between">
                            <div>
                                <p class="text-sm font-medium" style="color: rgba(88,28,235,0.75);">Total Pengguna Aktif</p>
                                <p class="mt-2 text-4xl font-bold tracking-tight" style="color: #1e0a4a;">{{ $totalPengguna }}</p>
                            </div>
                            <i class="bx bx-user text-5xl" style="color: rgba(124,58,237,0.20);"></i>
                        </div>
                    </div>
                </div>

                <!-- Recent Activity Table -->
                <div class="bg-white rounded-lg shadow-md p-6 mb-6">
                    <h3 class="text-lg font-semibold text-gray-800 mb-4">Aktivitas Terbaru</h3>
                    <div class="overflow-x-auto">
                        <table class="w-full">
                            <thead>
                                <tr class="border-b border-gray-200">
                                    <th class="px-4 py-3 text-left text-sm font-semibold text-gray-700">Id</th>
                                    <th class="px-4 py-3 text-left text-sm font-semibold text-gray-700">Nama</th>
                                    <th class="px-4 py-3 text-left text-sm font-semibold text-gray-700">Program Studi
                                    </th>
                                    <th class="px-4 py-3 text-left text-sm font-semibold text-gray-700">Keperluan</th>
                                    <th class="px-4 py-3 text-left text-sm font-semibold text-gray-700">Jam</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($pengunjung as $item)
                                    <tr class="border-b border-gray-200">
                                        <td class="px-4 py-3 text-sm text-gray-600">{{ $loop->iteration }}</td>
                                        <td class="px-4 py-3 text-sm text-gray-600">
                                            {{ $item->pengunjung->nama_lengkap ?? 'N/A' }}</td>
                                        <td class="px-4 py-3 text-sm text-gray-600">{{ $item->pengunjung->prodi ?? 'N/A' }}
                                        </td>
                                        <td class="px-4 py-3 text-sm text-gray-600">
                                            {{ $item->keperluan->nama_keperluan ?? 'N/A' }}</td>
                                        <td class="px-4 py-3 text-sm text-gray-600">
                                            {{ $item->created_at->format('H:i') ?? 'N/A' }} WIB</td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>

                <!-- Footer -->
                <div class="py-6 px-6 text-center text-sm text-slate-500">
                    <p class="mb-0">
                        Built with precision for smarter lab management • © {{ date('Y') }}
                    </p>
                    <p class="mb-0">
                        Designed & Developed by
                        <span class="font-semibold text-slate-900 dark:text-slate-400 hover:text-blue-500 transition">
                            System Designer A
                        </span>
                
                    </p>
                </div>
            </div>
        </div>
    </div>
    <script src="{{ asset('assets/libs/jquery/dist/jquery.min.js') }}"></script>
    <script src="{{ asset('assets/libs/bootstrap/dist/js/bootstrap.bundle.min.js') }}"></script>
    <script src="{{ asset('assets/js/sidebarmenu.js') }}"></script>
    <script src="{{ asset('assets/js/app.min.js') }}"></script>
    <script src="{{ asset('assets/libs/apexcharts/dist/apexcharts.min.js') }}"></script>
    <script src="{{ asset('assets/libs/simplebar/dist/simplebar.js') }}"></script>
    <script src="{{ asset('assets/js/dashboard.js') }}"></script>
</body>

</html>