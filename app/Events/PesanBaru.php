<?php

namespace App\Events;

use App\Models\Komentar;
use Illuminate\Broadcasting\Channel;
use Illuminate\Broadcasting\InteractsWithSockets;
use Illuminate\Contracts\Broadcasting\ShouldBroadcast;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Queue\SerializesModels;

class PesanBaru implements ShouldBroadcast
{
    use Dispatchable, InteractsWithSockets, SerializesModels;

    public $komentar;

    public function __construct(Komentar $komentar)
    {
        $this->komentar = $komentar;
    }

    public function broadcastOn(): array
    {
        if ($this->komentar->materi_id) {
            return [
                new Channel('diskusi.materi.' . $this->komentar->materi_id),
            ];
        } else {
            return [
                new Channel('forum-diskusi-umum'),
            ];
        }
    }
}