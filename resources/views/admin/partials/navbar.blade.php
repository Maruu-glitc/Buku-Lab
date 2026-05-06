<header class="app-header">
    <nav class="navbar navbar-expand-lg navbar-light">
        <ul class="navbar-nav">
            <li class="nav-item d-block d-xl-none">
                <a class="nav-link sidebartoggler nav-icon-hover" id="headerCollapse" href="javascript:void(0)">
                    <i class="ti ti-menu-2"></i>
                </a>
            </li>

            <li class="nav-item dropdown">
                <!-- Icon Lonceng dengan Trigger Dropdown -->
                <a class="nav-link nav-icon-hover" href="javascript:void(0)" id="dropNotification"
                    data-bs-toggle="dropdown" aria-expanded="false">
                    <i class="ti ti-bell-ringing"></i>
                    @if($notifikasiBaru->count() > 0)
                        <div class="notification bg-primary rounded-circle d-flex align-items-center justify-content-center text-white"
                            style="width: 18px; height: 18px; font-size: 10px; position: absolute; top: 12px; right: 8px; border: 2px solid #fff;">
                            {{ $notifikasiBaru->count() }}
                        </div>
                    @endif
                </a>


                <!-- Menu Dropdown Notifikasi -->
                <div class="dropdown-menu dropdown-menu-start dropdown-menu-animate-up"
                    aria-labelledby="dropNotification" style="min-width: 320px;">
                    <div class="message-body">
                        <div class="d-flex align-items-center justify-content-between px-3 py-2 border-bottom bg-light">
                            <h6 class="mb-0 fw-semibold fs-3">Notifikasi</h6>
                            @if($notifikasiBaru->count() > 0)
                                <form action="{{ route('notifikasi.markAllRead') }}" method="POST">
                                    @csrf
                                    <button type="submit" class="btn btn-sm p-0 text-primary fw-bold fs-2"
                                        style="background: none; border: none;">
                                        Tandai semua dibaca
                                    </button>
                                </form>
                            @endif
                        </div>
                        {{-- <h6 class="dropdown-header fw-semibold fs-4 mb-2">Notifikasi Masuk Lab</h6>
                        <div>
                            <i class="bx bx-trash"></i>
                        </div> --}}
                        <div id="notifikasi-list">
                            @forelse($notifikasiBaru as $notif)
                                <div class="d-flex align-items-center dropdown-item py-3 border-bottom justify-content-between"
                                    data-notif-id="{{ $notif->id }}">
                                    <!-- Bagian Info Notifikasi -->
                                    <a href="javascript:void(0)"
                                        class="d-flex align-items-center gap-3 flex-grow-1 text-decoration-none text-dark">
                                        <div
                                            class="text-white {{ $notif->pengunjung->tipe_pengguna == 'dosen' ? 'bg-primary' : 'bg-secondary' }} rounded-circle p-2 d-flex align-items-center justify-content-center">
                                            <i class="ti ti-user fs-6"></i>
                                        </div>
                                        <div style="white-space: normal;">
                                            <h6 class="mb-0 fs-3 fw-semibold">{{ $notif->pengunjung->nama_lengkap }}</h6>
                                            <span class="fs-2 text-muted">
                                                Masuk ke <b>{{ $notif->lab->nama_lab ?? 'Lab' }}</b>
                                                <br>
                                                <small>{{ $notif->created_at->diffForHumans() }}</small>
                                            </span>
                                        </div>
                                    </a>

                                    <!-- Tombol Hapus -->
                                    <form action="{{ route('notifikasi.destroy', $notif->id) }}" method="POST">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn btn-sm text-danger px-2" title="Hapus Notifikasi">
                                            <i class="ti ti-x fs-5"></i>
                                        </button>
                                    </form>
                                </div>
                            @empty
                                <div class="p-3 text-center text-muted" id="empty-state">
                                    <i class="ti ti-bell-off fs-7 d-block mb-2"></i>
                                    <span>Belum ada aktivitas</span>
                                </div>
                            @endforelse
                        </div>

                        <a href="#" class="btn btn-outline-primary mx-3 mt-3 d-block">Lihat Semua Aktivitas</a>
                    </div>
                </div>

                @push('scripts')
                    <script>
                        let lastNotificationId = 0;
                        let pollInterval;

                        document.addEventListener('DOMContentLoaded', function () {
                            // Mulai polling notifikasi setiap 3 detik
                            pollNotifications();
                            pollInterval = setInterval(pollNotifications, 3000);
                        });

                        function pollNotifications() {
                            fetch('/api/notifications')
                                .then(response => response.json())
                                .then(data => {
                                    // Update UI jika ada notifikasi baru
                                    if (data.notifications && data.notifications.length > 0) {
                                        data.notifications.forEach(notif => {
                                            // Cek apakah notif sudah ditampilkan
                                            if (!document.querySelector(`[data-notif-id="${notif.id}"]`)) {
                                                addNotificationToUI(notif);
                                            }
                                        });
                                        updateNotificationBadge(data.count);
                                    }
                                })
                                .catch(err => console.error('Error fetching notifications:', err));
                        }

                        function addNotificationToUI(data) {
                            const notifikasiList = document.getElementById('notifikasi-list');
                            const emptyState = document.getElementById('empty-state');

                            // Hapus empty state jika ada
                            if (emptyState) {
                                emptyState.remove();
                            }

                            // Buat HTML notifikasi
                            const notifHTML = `
                                    <div class="d-flex align-items-center dropdown-item py-3 border-bottom justify-content-between" data-notif-id="${data.id}">
                                        <a href="javascript:void(0)" class="d-flex align-items-center gap-3 flex-grow-1 text-decoration-none text-dark">
                                            <div class="text-white ${data.pengunjung.tipe_pengguna == 'dosen' ? 'bg-primary' : 'bg-secondary'} rounded-circle p-2 d-flex align-items-center justify-content-center">
                                                <i class="ti ti-user fs-6"></i>
                                            </div>
                                            <div style="white-space: normal;">
                                                <h6 class="mb-0 fs-3 fw-semibold">${data.pengunjung.nama_lengkap}</h6>
                                                <span class="fs-2 text-muted">
                                                    Masuk ke <b>${data.lab.nama_lab}</b>
                                                    <br>
                                                    <small>${data.created_at}</small>
                                                </span>
                                            </div>
                                        </a>
                                        <form action="/notifikasi/${data.id}" method="POST" style="display: inline;">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="btn btn-sm text-danger px-2" title="Hapus Notifikasi" onclick="deleteNotification(event, ${data.id})">
                                                <i class="ti ti-x fs-5"></i>
                                            </button>
                                        </form>
                                    </div>
                                `;

                            // Insert di awal list
                            notifikasiList.insertAdjacentHTML('afterbegin', notifHTML);

                            // Play sound (opsional)
                            playNotificationSound();
                        }

                        function deleteNotification(event, notifId) {
                            event.preventDefault();

                            fetch(`/notifikasi/${notifId}`, {
                                method: 'DELETE',
                                headers: {
                                    'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content'),
                                    'Content-Type': 'application/json'
                                }
                            }).then(() => {
                                document.querySelector(`[data-notif-id="${notifId}"]`).remove();
                                updateNotificationBadge();
                            });
                        }

                        function updateNotificationBadge(count) {
                            const badge = document.querySelector('.notification');
                            const notifList = document.querySelectorAll('#notifikasi-list [data-notif-id]');
                            const totalNotif = count || notifList.length;

                            if (totalNotif > 0) {
                                if (badge) {
                                    badge.textContent = totalNotif;
                                } else {
                                    const bellIcon = document.getElementById('dropNotification');
                                    const newBadge = document.createElement('div');
                                    newBadge.className = 'notification bg-primary rounded-circle d-flex align-items-center justify-content-center text-white';
                                    newBadge.style.cssText = 'width: 18px; height: 18px; font-size: 10px; position: absolute; top: 12px; right: 8px; border: 2px solid #fff;';
                                    newBadge.textContent = totalNotif;
                                    bellIcon.appendChild(newBadge);
                                }
                            } else if (badge) {
                                badge.remove();
                            }
                        }

                        function playNotificationSound() {
                            // Optional: Uncomment jika punya notification sound
                            // const audio = new Audio('/path/to/notification-sound.mp3');
                            // audio.play();
                        }
                    </script>
                @endpush

            </li>

        </ul>
        <div class="navbar-collapse justify-content-end px-0" id="navbarNav">
            <ul class="navbar-nav flex-row ms-auto align-items-center justify-content-end">

                <li class="nav-item dropdown">
                    <a class="nav-link nav-icon-hover" href="javascript:void(0)" id="drop2" data-bs-toggle="dropdown"
                        aria-expanded="false">
                        <img src="../assets/images/profile/user-1.jpg" alt="" width="35" height="35"
                            class="rounded-circle">
                    </a>
                    <div class="dropdown-menu dropdown-menu-end dropdown-menu-animate-up" aria-labelledby="drop2">
                        <div class="message-body">
                            <a href="javascript:void(0)" class="d-flex align-items-center gap-2 dropdown-item">
                                <i class="ti ti-user fs-6"></i>
                                <p class="mb-0 fs-3">My Profile</p>
                            </a>
                            <a href="javascript:void(0)" class="d-flex align-items-center gap-2 dropdown-item">
                                <i class="ti ti-mail fs-6"></i>
                                <p class="mb-0 fs-3">My Account</p>
                            </a>
                            <a href="javascript:void(0)" class="d-flex align-items-center gap-2 dropdown-item">
                                <i class="ti ti-list-check fs-6"></i>
                                <p class="mb-0 fs-3">My Task</p>
                            </a>
                            <form action="{{ route('logout') }}" method="post">
                                @csrf
                                <button type="submit" class="btn btn-outline-primary mx-3 mt-2 d-block">
                                    Logout
                                </button>
                            </form>
                        </div>
                    </div>
                </li>
            </ul>
        </div>
    </nav>
</header>