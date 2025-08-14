<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\DB;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        // Get all users with potentially unhashed passwords
        $users = DB::table('users')->get();
        
        foreach ($users as $user) {
            // Check if password is not hashed (less than 60 characters and doesn't start with $2y$)
            if (strlen($user->password) < 60 || !str_starts_with($user->password, '$2y$')) {
                // Hash the password
                DB::table('users')
                    ->where('id', $user->id)
                    ->update(['password' => Hash::make($user->password)]);
            }
        }
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        // This migration cannot be safely reversed
        // as we cannot recover the original plain text passwords
    }
}; 