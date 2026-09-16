<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        // ============================================================
        // USERS
        // ============================================================
        Schema::dropIfExists('users');
        Schema::create('users', function (Blueprint $table) {
            $table->id();
            $table->string('tel', 20)->nullable();
            $table->string('verificationCode')->nullable();
            $table->string('status', 30)->nullable()->default('unverified');
            $table->string('type', 30)->nullable()->default('user');
            $table->boolean('is_agent')->default(false);
            $table->string('name', 100)->nullable();
            $table->string('lname', 100)->nullable();
            $table->string('company')->nullable();
            $table->string('agency_name')->nullable();
            $table->text('bio')->nullable();
            $table->string('avatar')->nullable();
            $table->string('address')->nullable();
            $table->string('email')->nullable()->unique();
            $table->string('password')->nullable();
            $table->string('instagram')->nullable();
            $table->string('telegram')->nullable();
            $table->string('whatsapp')->nullable();
            $table->boolean('show_in_menu')->default(false);
            $table->timestamp('email_verified_at')->nullable();
            $table->rememberToken();
            $table->timestamps();
        });

        // ============================================================
        // ADMINS
        // ============================================================
        Schema::create('admins', function (Blueprint $table) {
            $table->id();
            $table->string('username');
            $table->string('password');
            $table->string('tel', 20)->nullable();
            $table->string('name', 100)->nullable();
            $table->string('lname', 100)->nullable();
            $table->string('verificationCode')->nullable();
            $table->string('status', 30)->nullable()->default('active');
            $table->string('type', 30)->nullable()->default('admin');
            $table->timestamp('email_verified_at')->nullable();
            $table->rememberToken();
            $table->timestamps();
        });

        // ============================================================
        // CITIES
        // ============================================================
        Schema::dropIfExists('cties');
        Schema::create('cties', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('tag')->nullable();
            $table->string('order')->default('0');
            $table->string('image')->nullable();
            $table->string('date_created')->nullable();
            $table->string('date_updated')->nullable();
        });

        // ============================================================
        // NEIGHBORHOODS
        // ============================================================
        Schema::dropIfExists('neighborhoods');
        Schema::create('neighborhoods', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('tag')->nullable();
            $table->unsignedBigInteger('city_id');
            $table->string('order')->default('0');
            $table->boolean('showInMenu')->default(false);
            $table->string('image')->nullable();
            $table->foreign('city_id')->references('id')->on('cties')->onDelete('cascade');
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('neighborhoods');
        Schema::dropIfExists('cties');
        Schema::dropIfExists('admins');
        Schema::dropIfExists('users');
    }
};
