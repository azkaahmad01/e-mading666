<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\DB;

return new class extends Migration
{
    public function up(): void
    {
        // Update existing 'user' role to 'siswa'
        DB::table('users')->where('role', 'user')->update(['role' => 'siswa']);
        
        // Modify the enum to include new values
        DB::statement("ALTER TABLE users MODIFY COLUMN role ENUM('admin', 'pembina', 'siswa') DEFAULT 'siswa'");
    }

    public function down(): void
    {
        // Revert back to original enum
        DB::statement("ALTER TABLE users MODIFY COLUMN role ENUM('admin', 'user') DEFAULT 'user'");
        
        // Update 'siswa' and 'pembina' back to 'user'
        DB::table('users')->whereIn('role', ['siswa', 'pembina'])->update(['role' => 'user']);
    }
};