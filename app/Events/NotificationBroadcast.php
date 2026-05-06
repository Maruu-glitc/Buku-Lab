<?php

namespace App\Events;

use Illuminate\Broadcasting\Channel;
use Illuminate\Broadcasting\InteractsWithSockets;
use Illuminate\Broadcasting\PresenceChannel;
use Illuminate\Broadcasting\PrivateChannel;
use Illuminate\Contracts\Broadcasting\ShouldBroadcast;
use Illuminate\Contracts\Broadcasting\ShouldBroadcastNow;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Queue\SerializesModels;

class NotificationBroadcast implements ShouldBroadcastNow
{
    use Dispatchable, InteractsWithSockets, SerializesModels;

    public $notifikasi;
    public $pengunjung;
    public $lab;

    /**
     * Create a new event instance.
     */
    public function __construct($notifikasi)
    {
        $this->notifikasi = $notifikasi;
        $this->pengunjung = $notifikasi->pengunjung;
        $this->lab = $notifikasi->lab;
    }

    /**
     * Get the channels the event should broadcast on.
     *
     * @return array<int, \Illuminate\Broadcasting\Channel>
     */
    public function broadcastOn(): array
    {
        return [
            new PrivateChannel('notifikasi'),
        ];
    }

    /**
     * Get the data to broadcast.
     */
    public function broadcastWith(): array
    {
        return [
            'id' => $this->notifikasi->id,
            'pengunjung' => [
                'id' => $this->pengunjung->id,
                'nama_lengkap' => $this->pengunjung->nama_lengkap,
                'tipe_pengguna' => $this->pengunjung->tipe_pengguna,
            ],
            'lab' => [
                'id' => $this->lab->id,
                'nama_lab' => $this->lab->nama_lab ?? 'Lab',
            ],
            'created_at' => $this->notifikasi->created_at,
        ];
    }

    /**
     * The event's broadcast name.
     */
    public function broadcastAs(): string
    {
        return 'notifikasi.baru';
    }
}
