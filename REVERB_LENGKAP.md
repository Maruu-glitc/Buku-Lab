# PANDUAN LENGKAP: SETUP LARAVEL REVERB UNTUK REAL-TIME NOTIFICATIONS

## 📋 Overview
Sistem ini menggunakan **Laravel Reverb** (WebSocket server) untuk menampilkan notifikasi real-time tanpa perlu reload browser. Ketika user masuk lab, notifikasi langsung muncul di dashboard admin.

---

## 🚀 INSTALASI & SETUP

### Step 1: Install Package
```bash
composer require laravel/reverb
```

### Step 2: Publish Configuration
```bash
php artisan reverb:install
```
Jika diminta untuk setup "Reverb with SSL", pilih **No** untuk development.

### Step 3: Generate App Credentials
Jika belum ada, generate credentials di `.env`:
```bash
php artisan generate-reverb-credentials
```

Atau manual set di `.env`:
```env
REVERB_APP_ID=1
REVERB_APP_KEY=your-secret-key
REVERB_APP_SECRET=your-secret
```

### Step 4: Install NPM Dependencies
```bash
npm install
```

Pastikan `laravel-echo` dan `pusher-js` terinstall:
```bash
npm install laravel-echo pusher-js
```

---

## ⚙️ KONFIGURASI

### .env Setup
Update file `.env` dengan:
```env
BROADCAST_DRIVER=reverb
BROADCAST_CONNECTION=reverb

# Reverb Configuration
REVERB_APP_ID=1
REVERB_APP_KEY=your-app-key
REVERB_APP_SECRET=your-app-secret
REVERB_HOST=localhost
REVERB_PORT=8080
REVERB_SCHEME=http

# Vite Environment Variables
VITE_REVERB_APP_KEY="${REVERB_APP_KEY}"
VITE_REVERB_HOST="${REVERB_HOST}"
VITE_REVERB_PORT="${REVERB_PORT}"
VITE_REVERB_SCHEME="${REVERB_SCHEME}"
```

### Check Broadcasting Config
File `config/broadcasting.php` sudah dikonfigurasi dengan driver `reverb`.

### Check Bootstrap
File `resources/js/bootstrap.js` sudah setup Echo dengan Reverb.

---

## 🎯 IMPLEMENTASI

### 1. Event yang Sudah Dibuat ✅
**File:** `app/Events/NotificationBroadcast.php`
- Broadcast event ketika user masuk lab
- Channel: `notifikasi` (private)
- Event name: `notifikasi.baru`

### 2. Controller yang Sudah Updated ✅
**File:** `app/Http/Controllers/PenggunaanLabController.php`
- Method `store()` di-update untuk dispatch `NotificationBroadcast` event

### 3. Routes yang Sudah Setup ✅
**File:** `routes/channels.php`
- Private channel `notifikasi` untuk broadcast

### 4. Navbar yang Sudah Updated ✅
**File:** `resources/views/admin/partials/navbar.blade.php`
- JavaScript listener untuk real-time updates
- Dynamic UI updates tanpa reload

---

## 🏃 MENJALANKAN APLIKASI

### Terminal 1: Laravel Server
```bash
php artisan serve
```
Aplikasi berjalan di: http://localhost:8000

### Terminal 2: Reverb WebSocket Server
```bash
php artisan reverb:start
```
Server WebSocket berjalan di: ws://localhost:8080

### Terminal 3: Vite Development Server (Optional)
```bash
npm run dev
```

**ATAU** gunakan command all-in-one yang sudah setup di `composer.json`:
```bash
composer run dev
```
Ini akan menjalankan: Server + Queue + Logs + Vite dalam satu command.

---

## ✨ CARA KERJA

### Flow Diagram:
```
┌─────────────────────────────────────────────────────────────────┐
│ 1. User Submit Form "Masuk Lab" di Form Entry Page               │
└─────────────────────┬───────────────────────────────────────────┘
                      │
┌─────────────────────▼───────────────────────────────────────────┐
│ 2. PenggunaanLabController@store() di-trigger                    │
│    - Save ke database                                            │
│    - Dispatch NotificationBroadcast event                        │
└─────────────────────┬───────────────────────────────────────────┘
                      │
┌─────────────────────▼───────────────────────────────────────────┐
│ 3. NotificationBroadcast Event                                   │
│    - Broadcast ke channel 'notifikasi'                          │
│    - Event name: 'notifikasi.baru'                              │
│    - Include data: id, pengunjung, lab, created_at             │
└─────────────────────┬───────────────────────────────────────────┘
                      │
┌─────────────────────▼───────────────────────────────────────────┐
│ 4. Reverb WebSocket Server                                       │
│    - Terima event dari Laravel                                  │
│    - Broadcast ke semua client yang subscribe ke channel        │
└─────────────────────┬───────────────────────────────────────────┘
                      │
┌─────────────────────▼───────────────────────────────────────────┐
│ 5. Browser JavaScript (Navbar)                                   │
│    - Listen ke event 'notifikasi.baru'                          │
│    - Receive data dan update UI                                 │
│    - Add notification ke list                                   │
│    - Update badge count                                         │
└─────────────────────┬───────────────────────────────────────────┘
                      │
┌─────────────────────▼───────────────────────────────────────────┐
│ 6. REAL-TIME NOTIFICATION MUNCUL DI DASHBOARD ✨                 │
│    - Tanpa reload browser                                       │
│    - Instant update untuk semua admin yang online              │
└─────────────────────────────────────────────────────────────────┘
```

---

## 🧪 TESTING

### Test Case 1: Single Browser
1. Buka http://localhost:8000/admin (pastikan sudah login)
2. Buka form entry pengunjung di tab baru/window baru
3. Submit form entry
4. Lihat notifikasi muncul di admin dashboard **tanpa reload**

### Test Case 2: Multiple Browsers/Admin Users
1. Buka dashboard admin di 2 browser berbeda (Chrome + Firefox)
2. Submit form entry pengunjung
3. Notifikasi akan muncul **di kedua browser secara bersamaan** ✨

### Verify WebSocket Connection
Buka browser DevTools (F12) → Console tab, lihat:
```javascript
// Pastikan tidak ada error
// Harus ada message seperti: "Notification event received"
```

Atau cek di Application tab → WebSockets untuk melihat koneksi aktif.

---

## 🐛 TROUBLESHOOTING

### Issue 1: Notifikasi Tidak Muncul
**Solusi:**
1. Pastikan 3 server berjalan: Laravel, Reverb, Vite
2. Cek console browser (F12) untuk error
3. Cek terminal Reverb untuk message `Reverb running on ws://localhost:8080`

```bash
# Kill dan restart Reverb
php artisan reverb:start
```

### Issue 2: WebSocket Connection Error
**Error:** `Failed to construct 'WebSocket': Invalid URL`

**Solusi:**
- Check .env variable sudah benar
- Pastikan `VITE_REVERB_APP_KEY`, `VITE_REVERB_HOST`, `VITE_REVERB_PORT` didefinisikan
- Build ulang frontend:
```bash
npm run build
```

### Issue 3: CSRF Token Error
**Error:** `419 Middleware \VerifyCsrfToken`

**Solusi:**
- Pastikan meta csrf-token ada di layout:
```blade
<meta name="csrf-token" content="{{ csrf_token() }}">
```

### Issue 4: Event Tidak Broadcast
**Solusi:**
- Verify `ShouldBroadcast` interface implemented di event
- Check `broadcastAs()` method return value
- Check channel name dan auth logic di `routes/channels.php`

---

## 📝 FILE YANG DIMODIFIKASI/DIBUAT

### ✅ Files Created:
- `app/Events/NotificationBroadcast.php`
- `config/broadcasting.php`
- `routes/channels.php`
- `REVERB_SETUP.md` (dokumentasi ini)

### ✅ Files Modified:
- `app/Http/Controllers/PenggunaanLabController.php` (import event + dispatch)
- `resources/js/bootstrap.js` (setup Echo + Reverb)
- `resources/views/admin/partials/navbar.blade.php` (JavaScript listener)
- `.env.example` (Reverb config)

---

## 🔐 PRODUCTION DEPLOYMENT

### Untuk Production:
1. Use SSL (HTTPS):
```env
REVERB_SCHEME=https
VITE_REVERB_SCHEME=https
```

2. Update host dan port sesuai server:
```env
REVERB_HOST=yourdomain.com
REVERB_PORT=443
```

3. Setup reverse proxy (Nginx/Apache) untuk WebSocket

4. Run Reverb dengan supervisor atau process manager:
```bash
# Supervisor config
command=php /path/to/artisan reverb:start
```

---

## 📚 REFERENSI

- [Laravel Reverb Documentation](https://laravel.com/docs/11.x/reverb)
- [Laravel Broadcasting](https://laravel.com/docs/11.x/broadcasting)
- [Laravel Echo](https://laravel.com/docs/11.x/echo)

---

## ❓ FAQ

**Q: Apakah harus install Redis?**
A: Tidak untuk development. Reverb berjalan standalone. Redis hanya diperlukan jika menggunakan Redis driver untuk broadcasting (opsional).

**Q: Bagaimana dengan performance?**
A: Reverb lightweight dan efficient. Untuk production scale besar, pertimbangkan Pusher atau Ably.

**Q: Apakah support SSL?**
A: Ya, setup di .env dengan `REVERB_SCHEME=https` dan `REVERB_PORT=443`

---

Semoga berhasil! 🚀
