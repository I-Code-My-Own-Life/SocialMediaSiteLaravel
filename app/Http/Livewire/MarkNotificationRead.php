<?php

namespace App\Http\Livewire;

use Livewire\Component;

class MarkNotificationRead extends Component
{
    public $notificationId;

    public function markAsRead()
    {
        $notification = auth()->user()->notifications->find($this->notificationId);

        if ($notification) {
            $notification->markAsRead();
            // Refresh the notifications list to reflect the change
            $this->emit('notificationsUpdated');
        }
    }

    public function render()
    {
        return view('livewire.mark-notification-read');
    }
}
