<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\User;
use Illuminate\Support\Facades\Hash;

class PembinaSeeder extends Seeder
{
    public function run(): void
    {
        User::create([
            'name' => 'Pembina OSIS',
            'email' => 'pembina@test.com',
            'password' => Hash::make('pembina123'),
            'role' => 'pembina',
        ]);
    }
}