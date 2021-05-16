<?php

namespace App\Observers;

use App\Models\Outward;
use App\Notifications\DataChangeEmailNotification;
use Illuminate\Support\Facades\Notification;

class OutwardActionObserver
{
    public function created(Outward $model)
    {
        $data  = ['action' => 'created', 'model_name' => 'Outward'];
        $users = \App\Models\User::whereHas('roles', function ($q) { return $q->where('title', 'Admin'); })->get();
        Notification::send($users, new DataChangeEmailNotification($data));
    }

    public function updated(Outward $model)
    {
        $data  = ['action' => 'updated', 'model_name' => 'Outward'];
        $users = \App\Models\User::whereHas('roles', function ($q) { return $q->where('title', 'Admin'); })->get();
        Notification::send($users, new DataChangeEmailNotification($data));
    }
}
