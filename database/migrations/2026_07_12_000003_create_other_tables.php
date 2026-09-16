<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        // ============================================================
        // PRODUCTS
        // ============================================================
        Schema::dropIfExists('products');
        Schema::create('products', function (Blueprint $table) {
            $table->id();
            $table->string('name')->nullable();
            $table->decimal('price', 15, 2)->nullable();
            $table->text('description')->nullable();
            $table->string('category')->nullable();
            $table->json('tags')->nullable();
            $table->integer('stock')->default(0);
            $table->timestamps();
        });

        // ============================================================
        // BLOGS
        // ============================================================
        Schema::dropIfExists('blogs');
        Schema::create('blogs', function (Blueprint $table) {
            $table->id();
            $table->string('title')->nullable();
            $table->string('slug')->unique();
            $table->text('summary')->nullable();
            $table->longText('content')->nullable();
            $table->string('image')->nullable();
            $table->string('category')->nullable();
            $table->json('tags')->nullable();
            $table->string('status')->default('draft');
            $table->unsignedInteger('views_count')->default(0);
            $table->string('published_at')->nullable();
            $table->string('date_created')->nullable();
            $table->string('date_updated')->nullable();
        });

        // ============================================================
        // PAGES
        // ============================================================
        Schema::dropIfExists('pages');
        Schema::create('pages', function (Blueprint $table) {
            $table->id();
            $table->string('title')->nullable();
            $table->string('tag')->nullable();
            $table->string('slug')->nullable();
            $table->text('description')->nullable();
            $table->longText('content')->nullable();
            $table->string('image')->nullable();
            $table->string('date_created')->nullable();
            $table->string('date_updated')->nullable();

            // Contact page
            $table->string('item1_title')->nullable();
            $table->string('item2_title')->nullable();
            $table->string('item3_title')->nullable();
            $table->string('value1')->nullable();
            $table->string('value2')->nullable();
            $table->string('value3')->nullable();

            // Hero section
            $table->string('hero_title')->nullable();
            $table->text('hero_description')->nullable();
            $table->string('hero_button_text')->nullable();
            $table->string('hero_button_link')->nullable();
            $table->json('hero_images')->nullable();

            // Why section
            $table->string('why_title')->nullable();
            $table->json('why_items')->nullable();

            // Steps section
            $table->string('steps_title')->nullable();
            $table->string('steps_image')->nullable();
            $table->json('steps_items')->nullable();

            // Team section
            $table->string('team_title')->nullable();
            $table->json('team_members')->nullable();

            // Testimonials
            $table->string('testimonials_title')->nullable();
            $table->json('testimonials')->nullable();

            // CTA section
            $table->string('cta_title')->nullable();
            $table->text('cta_description')->nullable();
            $table->string('cta_button_text')->nullable();
            $table->string('cta_button_link')->nullable();
            $table->string('cta_image')->nullable();

            // FAQ related
            $table->string('category')->nullable();
            $table->string('question')->nullable();
            $table->text('answer')->nullable();
            $table->string('order')->nullable();
            $table->boolean('is_active')->default(true);
        });

        // ============================================================
        // FAQS
        // ============================================================
        Schema::dropIfExists('faqs');
        Schema::create('faqs', function (Blueprint $table) {
            $table->id();
            $table->string('question')->nullable();
            $table->text('answer')->nullable();
            $table->string('category')->nullable();
            $table->string('slug')->nullable();
            $table->string('order')->default('0');
            $table->boolean('is_active')->default(true);
            $table->string('date_created')->nullable();
            $table->string('date_updated')->nullable();
        });

        // ============================================================
        // ABOUTS
        // ============================================================
        Schema::dropIfExists('abouts');
        Schema::create('abouts', function (Blueprint $table) {
            $table->id();
            $table->string('hero_title')->nullable();
            $table->text('hero_description')->nullable();
            $table->string('hero_button_text')->nullable();
            $table->string('hero_button_link')->nullable();
            $table->json('hero_images')->nullable();
            $table->string('why_title')->nullable();
            $table->json('why_items')->nullable();
            $table->string('steps_title')->nullable();
            $table->string('steps_image')->nullable();
            $table->json('steps_items')->nullable();
            $table->string('team_title')->nullable();
            $table->json('team_members')->nullable();
            $table->string('testimonials_title')->nullable();
            $table->json('testimonials')->nullable();
            $table->string('cta_title')->nullable();
            $table->text('cta_description')->nullable();
            $table->string('cta_button_text')->nullable();
            $table->string('cta_button_link')->nullable();
            $table->string('cta_image')->nullable();
            $table->string('date_updated')->nullable();
        });

        // ============================================================
        // CONTACTS_FORMS
        // ============================================================
        Schema::dropIfExists('contacts_forms');
        Schema::create('contacts_forms', function (Blueprint $table) {
            $table->id();
            $table->string('name')->nullable();
            $table->string('tel', 20)->nullable();
            $table->text('message')->nullable();
            $table->string('date_created')->nullable();
            $table->string('date_updated')->nullable();
        });

        // ============================================================
        // SECTIONS
        // ============================================================
        Schema::dropIfExists('sections');
        Schema::create('sections', function (Blueprint $table) {
            $table->id();
            $table->string('position')->nullable();
            $table->string('title')->nullable();
            $table->text('desc')->nullable();
            $table->string('pic')->nullable();
            $table->string('link')->nullable();
            $table->string('link_title')->nullable();
            $table->string('type')->nullable();
            $table->string('date_created')->nullable();
            $table->string('date_updated')->nullable();
        });

        // ============================================================
        // TOP_AGENTS
        // ============================================================
        Schema::dropIfExists('top_agents');
        Schema::create('top_agents', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('user_id');
            $table->text('custom_text')->nullable();
            $table->string('order')->default('0');
            $table->timestamps();
            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('top_agents');
        Schema::dropIfExists('sections');
        Schema::dropIfExists('contacts_forms');
        Schema::dropIfExists('abouts');
        Schema::dropIfExists('faqs');
        Schema::dropIfExists('pages');
        Schema::dropIfExists('blogs');
        Schema::dropIfExists('products');
    }
};
