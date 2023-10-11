<?php

namespace App\Listeners;

use Carbon\Carbon;
use Illuminate\Auth\Events\Login;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;

class SaveLoginInfo
{
    /**
     * Create the event listener.
     */
    public function __construct()
    {
        //
    }

    /**
     * Handle the event.
     */
    public function handle(object $event): void
    {
        /* $event->user->update([
            'last_login_at' => Carbon::now()->toDateTimeString(),
            'last_login_ip' => request()->getClientIp()
        ])->save(); */

        try {
            $user = $event->user;
            $user->last_login_at = now();
            $user->last_login_ip = request()->getClientIp();
            $user->save();
        } catch (\Throwable $th) {
            dd($th);
        }
    }
}
