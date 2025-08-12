<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::table('account', function (Blueprint $table) {
        DB::statement("ALTER TABLE account MODIFY purpose ENUM('DEPOSIT','WITHDRAW','SEND','SWAP') DEFAULT 'SEND'");
         DB::statement("ALTER TABLE account MODIFY status ENUM('SEEN','UNSEEN') DEFAULT 'UNSEEN'");
            //
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('account', function (Blueprint $table) {
        DB::statement("ALTER TABLE account MODIFY purpose ENUM('DEPOSIT','WITHDRAW','SEND','SWAP') DEFAULT 'SEND'");
         DB::statement("ALTER TABLE account MODIFY status ENUM('SEEN','UNSEEN') DEFAULT 'UNSEEN'");
            //
        });
    }
};
