<?php
namespace App\Events;

use Illuminate\Broadcasting\Channel;
use Illuminate\Broadcasting\InteractsWithSockets;
use Illuminate\Contracts\Broadcasting\ShouldBroadcast; // Pastikan ini ada
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Queue\SerializesModels;

// class TestNotification implements ShouldBroadcast
// {
//     use Dispatchable, InteractsWithSockets, SerializesModels;

//     public $message;

//     public function __construct($message)
//     {
//         // Pesan yang akan dikirim ke browser
//         $this->message = $message;
//     }

//     public function broadcastOn(): array
//     {
//         // Kita gunakan public channel dulu agar gampang tesnya
//         return [
//             new Channel('test-channel'),
//         ];
//     }
// }