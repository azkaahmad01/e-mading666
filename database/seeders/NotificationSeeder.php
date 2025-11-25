<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Notification;
use App\Models\User;

class NotificationSeeder extends Seeder
{
    public function run()
    {
        $siswaUsers = User::where('role', 'siswa')->get();
        
        foreach ($siswaUsers as $user) {
            Notification::create([
                'user_id' => $user->id,
                'title' => 'Selamat Datang!',
                'message' => 'Selamat datang di E-Mading Digital. Mulai buat artikel pertama Anda!',
                'type' => 'info'
            ]);
        }
    }
}