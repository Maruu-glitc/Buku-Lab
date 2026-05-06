<aside class="left-sidebar">
    <!-- Sidebar scroll-->
    <div>
        <div class="brand-logo d-flex align-items-center justify-content-between">
            <a href="#" class="text-nowrap logo-img flex ">

                <i class="bx bx-hard-drive text-6xl mx-2"></i>
                <span class="text-1xl font-bold text-slate-900 text-wrap w">Lab Visitor Management System</span>
            </a>
            <div class="close-btn d-xl-none d-block sidebartoggler cursor-pointer" id="sidebarCollapse">
                <i class="ti ti-x fs-8"></i>
            </div>
        </div>
        <!-- Sidebar navigation-->
        <nav class="sidebar-nav scroll-sidebar" data-simplebar="">

            <ul id="sidebarnav">
                <li class="nav-small-cap">
                    <i class="ti ti-dots nav-small-cap-icon fs-4"></i>
                    <span class="hide-menu">Home</span>
                </li>
                <li class="sidebar-item">
                    <a class="sidebar-link" href="{{ route('admin.content') }}" aria-expanded="false">
                        <span>
                            <i class="ti ti-layout-dashboard"></i>
                        </span>
                        <span class="hide-menu">Dashboard</span>
                    </a>
                </li>
                <li class="nav-small-cap">
                    <i class="ti ti-dots nav-small-cap-icon fs-4"></i>
                    <span class="hide-menu">Penggunaan Lab</span>
                </li>



                <li class="sidebar-item">
                    <a class="sidebar-link" href="{{ route('lab.index') }}" aria-expanded="false">
                        <span>
                            <i class="bx bx-test-tube text-2xl"></i>
                        </span>
                        <span class="hide-menu">Lab</span>
                    </a>
                </li>
                <li class="sidebar-item">
                    <a class="sidebar-link" href="#" aria-expanded="false">
                        <span>
                            <i class="bx bx-door-open text-2xl"></i>
                        </span>
                        <span class="hide-menu">Masuk Lab</span>
                    </a>
                </li>
                <li class="sidebar-item">
                    <a class="sidebar-link" href="{{ route('daftar-aktif') }}" aria-expanded="false">
                        <span>
                            <i class="bx bx-radio-circle-marked text-2xl"></i>
                        </span>
                        <span class="hide-menu">Daftar Aktif</span>
                    </a>
                </li>
                <li class="sidebar-item">
                    <a class="sidebar-link" href="#" aria-expanded="false">
                        <span>
                            <i class="bx bx-history text-2xl"></i>
                        </span>
                        <span class="hide-menu">Riwayat</span>
                    </a>
                </li>

                <li class="nav-small-cap">
                    <i class="ti ti-dots nav-small-cap-icon fs-4"></i>
                    <span class="hide-menu">Daftar Lab</span>
                </li>

                @forelse($labs ?? [] as $lab)
                    <li class="sidebar-item">
                        <a href="{{ route('lab.show', $lab->id) }}" class="sidebar-link" aria-expanded="false">
                            <span class="">
                                <i class="bx bx-monitor-wide mx-3 text-2xl"></i>
                                <span class="hide-menu">{{ $lab->nama_lab }}</span>
                                {{-- <span
                                    class="ms-3 flex items-center justify-center bg-blue-400 text-white rounded-full w-6 h-6 text-xs">
                                    {{ $lab->id }}
                                </span> --}}
                            </span>
                        </a>
                    </li>
                @empty
                    <li class="sidebar-item">
                        <span class="text-gray-500 text-sm px-4 py-2">Belum ada lab</span>
                    </li>
                @endforelse
                {{-- <li class="sidebar-item">
                    <a class="sidebar-link" href="./ui-forms.html" aria-expanded="false">
                        <span>
                            <i class="bx bx-edit text-2xl"></i>
                        </span>
                        <span class="hide-menu">Forms</span>
                    </a>
                </li> --}}



            </ul>

        </nav>
        <!-- End Sidebar navigation -->
    </div>
    <!-- End Sidebar scroll-->
</aside>