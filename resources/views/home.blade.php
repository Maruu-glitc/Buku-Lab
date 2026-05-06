<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="icon" href="{{ asset('icon/unibba.png') }}" type="image/png">
    {{-- CDN --}}
    <script src="https://cdn.jsdelivr.net/npm/@tailwindcss/browser@4"></script>
    <!-- Basic Icons -->
    <link href="https://cdn.boxicons.com/3.0.8/fonts/basic/boxicons.min.css" rel="stylesheet">
    <!-- Filled Icons -->
    <link href="https://cdn.boxicons.com/3.0.8/fonts/filled/boxicons-filled.min.css" rel="stylesheet">
    <!-- Brand Icons -->
    <link href="https://cdn.boxicons.com/3.0.8/fonts/brands/boxicons-brands.min.css" rel="stylesheet">
    <script>
        (function () {
            const stored = localStorage.getItem('theme');
            const prefersDark = window.matchMedia('(prefers-color-scheme: dark)').matches;
            if (stored === 'dark' || (!stored && prefersDark)) {
                document.documentElement.classList.add('dark');
            } else {
                document.documentElement.classList.remove('dark');
            }
        })();
    </script>
    <title>{{ config('app.name') }}</title>

    <style>
        @keyframes fadeInUp {
            from {
                opacity: 0;
                transform: translateY(20px);
            }
    
            to {
                opacity: 1;
                transform: translateY(0);
            }
        }
    
        .animate-fade-in-up {
            animation: fadeInUp 0.8s ease-out forwards;
        }
    
      
        .delay-100 {
            animation-delay: 0.1s;
        }
    
        .delay-200 {
            animation-delay: 0.2s;
        }
    
        .delay-300 {
            animation-delay: 0.3s;
        }
    </style>
</head>

<body class="bg-white text-slate-900 dark:bg-slate-950 dark:text-slate-100">
    {{-- Nav --}}
    <nav class="bg-blue-600 dark:bg-slate-900 w-full z-20 top-0 start-0 ">
        <div class="max-w-screen-xl flex flex-wrap items-center justify-between mx-auto p-4">
            <a href="http://127.0.0.1:8000/" class="flex items-center space-x-3 animate-fade-in-up opacity-0 rtl:space-x-reverse ">
                <img src="{{ asset('icon/unibba.png') }}" class="h-12 hover:-translate-y-1 transition-all duration-500" alt="Unibba Logo" />
                <span class="self-center text-xl text-white font-bold whitespace-nowrap" data-i18n="title">UNIBBA Lab
                    Access </span>
            </a>
            
            <div class="md:order-last">
                <button id="lang-toggle"
                    class="px-3 py-1.5 text-sm rounded-lg bg-white/20 text-white hover:bg-white/30 hover:shadow-sm shadow-blue-500/60 transition">
                    EN
                </button>
            </div>
        </div>
    </nav>

    {{-- Main Content --}}
    <section class="bg-gray-100 dark:bg-slate-950 py-10 px-4 sm:px-6 lg:px-8">
        <div class="max-w-6xl mx-auto grid md:grid-cols-3 gap-6">

            <!-- FORM -->
            <div class="md:col-span-2 bg-white dark:bg-slate-900 p-6 rounded-xl shadow animate-fade-in-up opacity-0">

                <div class="flex justify-center">
                    <img src="{{ asset('icon/lab.png') }}" class="h-29 mb-4">
                </div>

                <h2 data-i18n="form_title" class="text-xl font-semibold text-center mb-1">Form Masuk Lab</h2>
                <p data-i18n="form_desc" class="text-sm text-gray-500 text-center mb-6">
                    Silakan isi data di bawah ini untuk menggunakan lab
                </p>

                <form id="formLab" action="{{ route('penggunaan-lab.store') }}" method="POST">
                    @csrf

                    <div class="grid gap-4 sm:grid-cols-2">

                        <!-- NAMA -->
                        <div class="sm:col-span-2">
                            <label data-i18n="nama" class="text-sm font-medium">Nama Lengkap</label>
                            <input type="text" name="nama" class="w-full mt-1 px-4 py-2.5 rounded-md 
bg-white/70 dark:bg-slate-800/70 
border border-slate-200 dark:border-slate-700 
text-slate-700 dark:text-white 
placeholder:text-slate-400
focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-transparent focus:shadow-md shadow-blue-500/65
transition duration-200" placeholder="Masukan Nama Lengkap" required>
                        </div>

                        <!-- TIPE -->
                        <div>
                            <label class="text-sm font-medium">Status Pengguna</label>
                            <div class="mt-2 space-y-2 ">
                                <label class="flex items-center gap-3 cursor-pointer hover:bg-gray-100 dark:hover:bg-slate-700 rounded-lg px-3 py-2 transition">
                                    <input type="radio" name="tipe_pengguna" value="mahasiswa"
                                        class="w-4 h-4 text-blue-600 bg-gray-100 border-gray-300 focus:ring-blue-500 cursor-pointer">
                                    <span class="text-sm">Mahasiswa</span>
                                </label>
                                <label class="flex items-center gap-3 cursor-pointer hover:bg-gray-100 dark:hover:bg-slate-700 rounded-lg px-3 py-2 transition">
                                    <input type="radio" name="tipe_pengguna" value="dosen"
                                        class="w-4 h-4 text-blue-600 bg-gray-100 border-gray-300 focus:ring-blue-500 cursor-pointer">
                                    <span class="text-sm">Dosen</span>
                                </label>
                                <label class="flex items-center gap-3 cursor-pointer hover:bg-gray-100 dark:hover:bg-slate-700 rounded-lg px-3 py-2 transition">
                                    <input type="radio" name="tipe_pengguna" value="pegawai"
                                        class="w-4 h-4 text-blue-600 bg-gray-100 border-gray-300 focus:ring-blue-500 cursor-pointer">
                                    <span class="text-sm">Pegawai</span>
                                </label>
                            </div>
                        </div>

                        <!-- NIM -->
                        <div>
                            <label class="text-sm font-medium">NIM <span class="opacity-50">(Opsional)</span></label>
                            <input type="number" name="nim" class="w-full mt-1 px-4 py-2.5 rounded-md 
bg-white/70 dark:bg-slate-800/70 
border border-slate-200 dark:border-slate-700 
text-slate-700 dark:text-white 
placeholder:text-slate-400
focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-transparent focus:shadow-md shadow-blue-500/65
transition duration-200" placeholder="Masukan NIM">
                        </div>

                        <!-- PRODI -->
                        <div>
                            <label class="text-sm font-medium">Program Studi</label>
                            <input type="text" name="prodi" class="w-full mt-1 px-4 py-2.5 rounded-md 
bg-white/70 dark:bg-slate-800/70 
border border-slate-200 dark:border-slate-700 
text-slate-700 dark:text-white 
placeholder:text-slate-400
focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-transparent focus:shadow-md shadow-blue-500/65
transition duration-200" placeholder="Masukan program studi" required>
                        </div>

                        <!-- LAB -->
                        <div>
                            <label class="text-sm font-medium">Lab</label>
                            <select name="lab_id" class="w-full mt-1 px-4 py-2.5 rounded-md 
                                   bg-white/70 dark:bg-slate-800/70 
                                   border border-slate-200 dark:border-slate-700 
                                   text-slate-700 dark:text-white 
                                   placeholder:text-slate-400
                                   focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-transparent focus:shadow-md shadow-blue-500/65
                                   transition duration-200">

                                <option class="text-black">Pilih lab</option>

                                @foreach ($lab as $l)
                                    <option class="text-black dark:text-white" value="{{ $l->id }}">{{ $l->nama_lab }}
                                    </option>
                                @endforeach
                            </select>
                        </div>

                        <!-- KEPERLUAN -->
                        <!-- KEPERLUAN -->
                        <div>
                            <label class="text-sm font-medium">Keperluan</label>
                            <select id="select-keperluan" name="keperluan_id"
                                class="w-full mt-1 px-4 py-2.5 rounded-md bg-white/70 dark:bg-slate-800/70 border border-slate-200 dark:border-slate-700 text-slate-700 dark:text-white focus:outline-none focus:ring-2 focus:ring-blue-500 transition duration-200">
                                <option value="">Pilih keperluan</option>
                                @foreach ($keperluan as $k)
                                    {{-- Pastikan value "Lainnya" sesuai dengan yang ada di database Anda --}}
                                    <option value="{{ $k->id }}" data-nama="{{ $k->nama_keperluan }}">{{ $k->nama_keperluan }}</option>
                                @endforeach
                            </select>
                        </div>
                        
                        <!-- INPUT TAMBAHAN (Sembunyi secara default) -->
                        <div id="input-lainnya-container" class="hidden sm:col-span-2 mt-2">
                            <label class="text-sm font-medium text-blue-600 dark:text-blue-400">Tuliskan Keperluan Anda</label>
                            <input type="text" name="keperluan_spesifik" id="keperluan_spesifik"
                                class="w-full mt-1 px-4 py-2.5 rounded-xl bg-blue-50 dark:bg-slate-800 border-2 border-blue-200 dark:border-blue-900 focus:ring-2 focus:ring-blue-500 outline-none transition duration-200"
                                placeholder="Masukan Keperluan">
                        </div>

                        <!-- KETERANGAN -->
                        <div class="sm:col-span-2">
                            <label class="text-sm font-medium">Keterangan <span class="text-slate-400">(Opsional)</span></label>
                            <textarea name="keterangan" class="w-full mt-1 px-4 py-2.5 rounded-md
                                   bg-white/70 dark:bg-slate-800/70 
                                   border border-slate-200 dark:border-slate-700 
                                   text-slate-700 dark:text-white 
                                   placeholder:text-slate-400
                                   focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-transparent focus:shadow-md shadow-blue-500/65
                                   transition duration-200" placeholder="Masukan keterangan"></textarea>
                        </div>

                    </div>

                    <button type="submit"
                        class="w-full mt-6 flex items-center cursor-pointer justify-center gap-2 bg-blue-600 text-white py-3 rounded-lg hover:bg-blue-700 transition">
                        <i class="bx bx-arrow-from-bottom-stroke text-2xl"></i>
                        <span class="font-medium">Masuk Lab</span>
                    </button>
                </form>
            </div>

            <!-- SIDEBAR -->
            <div class="space-y-6 animate-fade-in-up opacity-0 delay-200">

                <!-- INFO -->
                <div class=" dark:bg-slate-900 p-4 rounded-xl shadow">
                    <h3 class="font-semibold mb-2">Informasi</h3>

                    <!-- Container dengan background gelap agar efek glassmorphism terlihat -->
                   
                    
                        <div class="bg-sky-500/10 backdrop-blur-lg border border-white/20  shadow-2xl p-4 rounded-xl text-white/70">
                            <div class="flex items-start gap-3">
                    
                                <!-- ICON -->
                                <i class="bx bx-info-circle text-2xl mt-0.5 text-blue-400"></i>
                    
                                <!-- TEXT -->
                                <p class="text-justify leading-relaxed opacity-90">
                                    Pastikan data yang Anda masukkan sudah benar. Waktu masuk akan tercatat otomatis saat
                                    klik tombol MASUK LAB.
                                </p>
                    
                            </div>
                        </div>
                    
                   
                </div>

                <!-- LAB TERSEDIA -->
                <div class=" dark:bg-slate-900 p-4 rounded-xl shadow">
                    <h3 class="font-semibold mb-3">Lab Tersedia</h3>

                    <ul class="space-y-2 text-sm">
                        @foreach ($lab as $l)
                            <li class="flex justify-between">
                                <span class="flex items-center gap-2">
                                    <span class="w-2 h-2 bg-green-500 rounded-full"></span>
                                    {{ $l->nama_lab }}
                                </span>
                                <span class="text-green-600"></span>{{ $l->aktif_count }}/{{ $l->kapasitas }}</span>
                            </li>
                        @endforeach
                    </ul>
                </div>

            </div>
        </div>
    </section>

    {{-- Footer --}}
    <footer class="bg-slate-900 text-slate-100">
        <div class="  px-4 py-8 sm:px-6 lg:px-8">
            <div class="flex flex-col gap-6  sm:flex-row sm:items-center sm:justify-between">
                <div>
                    <p class="text-xl font-semibold">{{ config('app.name') }}</p>
                    <p class="mt-1 text-sm text-slate-400">Buku tamu digital untuk pencatatan lab yang rapi dan modern.
                    </p>
                </div>
                <div class="space-y-1 text-sm text-slate-400 sm:text-right">
                    <p>Designed for easy visit logging.</p>
                    <p>&copy; {{ date('Y') }} {{ config('app.name') }}. All rights reserved.</p>
                </div>
            </div>
        </div>
    </footer>

    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    @if(session('success'))
        <script>
            Swal.fire({
                icon: 'success',
                title: 'Berhasil!',
                text: '{{ session('success') }}',
                timer: 2000,
                showConfirmButton: false
            });
        </script>
    @endif

    @if($errors->any())
        <script>
            Swal.fire({
                icon: 'error',
                title: 'Gagal!',
                html: `{!! implode('<br>', $errors->all()) !!}`,
            });
        </script>
    @endif

    <script>
        const root = document.documentElement;
        const toggleButton = document.getElementById('theme-toggle');
        const darkIcon = document.getElementById('theme-toggle-dark-icon');
        const lightIcon = document.getElementById('theme-toggle-light-icon');

        const applyTheme = (theme) => {
            if (theme === 'dark') {
                root.classList.add('dark');
                darkIcon?.classList.add('hidden');
                lightIcon?.classList.remove('hidden');
            } else {
                root.classList.remove('dark');
                lightIcon?.classList.add('hidden');
                darkIcon?.classList.remove('hidden');
            }
        };

        const initTheme = () => {
            const stored = localStorage.getItem('theme');
            const prefersDark = window.matchMedia('(prefers-color-scheme: dark)').matches;
            applyTheme(stored || (prefersDark ? 'dark' : 'light'));
        };

        initTheme();

        toggleButton?.addEventListener('click', () => {
            const isDark = !root.classList.contains('dark');
            localStorage.setItem('theme', isDark ? 'dark' : 'light');
            applyTheme(isDark ? 'dark' : 'light');
        });

        document.getElementById('formLab').addEventListener('submit', function () {
            Swal.fire({
                title: 'Menyimpan...',
                text: 'Mohon tunggu',
                allowOutsideClick: false,
                didOpen: () => {
                    Swal.showLoading()
                }
            });
        });

        document.addEventListener('DOMContentLoaded', function () {
                const selectKeperluan = document.getElementById('select-keperluan');
                const containerLainnya = document.getElementById('input-lainnya-container');
                const inputLainnya = document.getElementById('keperluan_spesifik');

                selectKeperluan.addEventListener('change', function () {
                    // Ambil teks dari opsi yang dipilih
                    const selectedText = this.options[this.selectedIndex].text.toLowerCase();

                    if (selectedText.includes('lainnya')) {
                        // Tampilkan input dan beri efek fokus
                        containerLainnya.classList.remove('hidden');
                        inputLainnya.setAttribute('required', 'true'); // Wajib isi jika muncul
                        inputLainnya.focus();
                    } else {
                        // Sembunyikan dan hapus nilai jika user berubah pikiran
                        containerLainnya.classList.add('hidden');
                        inputLainnya.removeAttribute('required');
                        inputLainnya.value = '';
                    }
                });
            });
    </script>

    <script>
        const translations = {
            id: {
                title: "UNIBBA Lab Access",
                form_title: "Form Masuk Lab",
                form_desc: "Silakan isi data di bawah ini untuk menggunakan lab",
                nama: "Nama Lengkap",

            },
            en: {
                title: "UNIBBA Lab Access",
                form_title: "Lab Entry Form",
                form_desc: "Please fill in the form below to access the lab",
                nama: "Full Name",
            }
        };

        const setLanguage = (lang) => {
            localStorage.setItem("lang", lang);

            document.querySelectorAll("[data-i18n]").forEach(el => {
                const key = el.getAttribute("data-i18n");
                el.innerText = translations[lang][key] || key;
            });

            document.getElementById("lang-toggle").innerText = lang === "id" ? "EN" : "ID";
        };

        const currentLang = localStorage.getItem("lang") || "id";
        setLanguage(currentLang);

        document.getElementById("lang-toggle").addEventListener("click", () => {
            const newLang = localStorage.getItem("lang") === "id" ? "en" : "id";
            setLanguage(newLang);
        });
    </script>

   
</body>

</html>