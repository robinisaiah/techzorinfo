<?php

namespace App\Jobs;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldBeQueued;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Facades\Mail;
use Maatwebsite\Excel\Facades\Excel;
use App\Exports\UserExport;

class SendUserListEmail implements ShouldBeQueued
{
    use Queueable, InteractsWithQueue, SerializesModels;

    public function handle()
    {
        $file = Excel::store(new UsersExport, 'users.xlsx', 'local');

        Mail::raw('Attached is the user list.', function ($message) {
            $message->to('admin@example.com')->subject('User List')->attach(storage_path('app/users.xlsx'));
        });
    }
}
