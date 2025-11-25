<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

return new class extends Migration
{
    public function up(): void
    {
        // Update all users with proper bcrypt passwords
        DB::table('users')->update([
            'password' => Hash::make('password123')
        ]);
    }

    public function down(): void
    {
        // Cannot revert password hashes
    }
};