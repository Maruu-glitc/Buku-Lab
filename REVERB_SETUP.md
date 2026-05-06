# Setup Laravel Reverb untuk Real-Time Notifications

## Langkah-Langkah Instalasi:

### 1. Install Laravel Reverb Package
```bash
composer require laravel/reverb
```

### 2. Publish Configuration
```bash
php artisan reverb:install
```

### 3. Update .env File
Tambahkan atau update konfigurasi berikut:
```
BROADCAST_DRIVER=reverb
REVERB_APP_ID=your-app-id
REVERB_APP_KEY=your-app-key
REVERB_APP_SECRET=your-app-secret
REVERB_HOST=localhost
REVERB_PORT=8080
REVERB_SCHEME=http
```

### 4. Install JavaScript Dependencies
```bash
npm install laravel-echo pusher-js
```

### 5. Setup Laravel Echo (app.js)
Pastikan di `resources/js/app.js` sudah ada konfigurasi Echo:

```javascript
import Echo from 'laravel-echo';
import Pusher from 'pusher-js';

window.Pusher = Pusher;

window.Echo = new Echo({
    broadcaster: 'reverb',
    key: import.meta.env.VITE_REVERB_APP_KEY,
    wsHost: import.meta.env.VITE_REVERB_HOST,
    wsPort: import.meta.env.VITE_REVERB_PORT,
    wssPort: import.meta.env.VITE_REVERB_PORT,
    forceTLS: (import.meta.env.VITE_REVERB_SCHEME ?? 'https') === 'https',
    encrypted: true,
    enabledTransports: ['ws', 'wss'],
});
```

### 6. Setup .env.example
Tambahkan ke file .env.example:
```
BROADCAST_DRIVER=reverb
REVERB_APP_ID=
REVERB_APP_KEY=
REVERB_APP_SECRET=
REVERB_HOST=localhost
REVERB_PORT=8080
REVERB_SCHEME=http

VITE_REVERB_APP_KEY="${REVERB_APP_KEY}"
VITE_REVERB_HOST="${REVERB_HOST}"
VITE_REVERB_PORT="${REVERB_PORT}"
REVERB_SCHEME="${REVERB_SCHEME}"
```

### 7. Jalankan Development Servers

**Terminal 1 - Laravel Server:**
```bash
php artisan serve
```

**Terminal 2 - Reverb WebSocket Server:**
```bash
php artisan reverb:start
```

**Terminal 3 - Vite Dev Server:**
```bash
npm run dev
```

## Cara Kerja:

1. **User masuk lab** → Trigger `PenggunaanLabController@store`
2. **Event `NotificationBroadcast` di-dispatch** → Broadcast ke channel `notifikasi`
3. **JavaScript di navbar listen** → Terima event dan update UI secara real-time
4. **Notifikasi muncul otomatis** tanpa perlu reload browser

## File-File yang Dibuat/Diubah:

- ✅ `config/broadcasting.php` - Broadcasting configuration
- ✅ `routes/channels.php` - Broadcast channels
- ✅ `app/Events/NotificationBroadcast.php` - Event untuk broadcast
- ✅ `app/Http/Controllers/PenggunaanLabController.php` - Dispatch event saat user masuk lab
- ✅ `resources/views/admin/partials/navbar.blade.php` - Listen ke event dan update UI

## Testing:

1. Buka aplikasi di 2 tab browser dengan role yang berbeda
2. Tab 1: Admin/Dashboard
3. Tab 2: Form Entry Pengunjung
4. Submit form di Tab 2
5. Notifikasi akan muncul real-time di Tab 1 tanpa reload

## Troubleshooting:

- Jika notifikasi tidak muncul, pastikan Reverb server running: `php artisan reverb:start`
- Cek console browser (F12) untuk error
- Pastikan CSRF token ada di meta tag: `<meta name="csrf-token" content="{{ csrf_token() }}">`
- Verifikasi konfigurasi di `config/broadcasting.php` sesuai .env
