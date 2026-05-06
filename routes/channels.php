<?php

use Illuminate\Support\Facades\Broadcast;

Broadcast::channel('App.Models.User.{id}', function ($user, $id) {
    return (int) $user->id === (int) $id;
});

// Ganti Broadcast::private menjadi Broadcast::channel
Broadcast::channel('notifikasi', function ($user) {
    // Pastikan user sudah login untuk bisa mendengar notifikasi ini
    return auth()->check();
}); 