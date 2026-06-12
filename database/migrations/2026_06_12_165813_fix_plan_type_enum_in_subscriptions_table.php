<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        DB::statement("ALTER TABLE subscriptions MODIFY COLUMN plan_type ENUM('monthly','annual','solo','company') NOT NULL DEFAULT 'monthly'");
    }

    public function down(): void
    {
        DB::statement("ALTER TABLE subscriptions MODIFY COLUMN plan_type ENUM('solo','company') NOT NULL DEFAULT 'solo'");
    }
};
