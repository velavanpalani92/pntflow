<?php

namespace App\Observers;

use App\Models\Instock;
use App\Notifications\DataChangeEmailNotification;
use Illuminate\Support\Facades\Notification;

class InstockActionObserver
{
    public function created(Instock $model)
    {
        $data  = ['action' => 'created', 'model_name' => 'Instock'];
        $users = \App\Models\User::whereHas('roles', function ($q) { return $q->where('title', 'Admin'); })->get();
        Notification::send($users, new DataChangeEmailNotification($data));
    }

    public function updated(Instock $model)
    {
        $data  = ['action' => 'updated', 'model_name' => 'Instock'];
        $users = \App\Models\User::whereHas('roles', function ($q) { return $q->where('title', 'Admin'); })->get();
        Notification::send($users, new DataChangeEmailNotification($data));
    }
}
