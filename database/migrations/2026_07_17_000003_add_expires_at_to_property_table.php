<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('property', function (Blueprint $table) {
            $table->timestamp('expires_at')->nullable()->after('date_updated');
        });
    }

    public function down(): void
    {
        Schema::table('property', function (Blueprint $table) {
            $table->dropColumn('expires_at');
        });
    }
};
