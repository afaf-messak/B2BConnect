<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('supplier_profiles', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->unique()->constrained()->cascadeOnDelete();
            $table->string('slug')->unique();
            $table->string('tagline')->nullable();
            $table->text('bio')->nullable();
            $table->string('industry')->nullable();
            $table->string('city')->nullable();
            $table->string('region')->nullable();
            $table->string('country')->default('Morocco');
            $table->string('website')->nullable();
            $table->string('phone')->nullable();
            $table->json('services')->nullable();
            $table->json('certifications')->nullable();
            $table->json('portfolio')->nullable();
            $table->unsignedSmallInteger('response_time_hours')->default(24);
            $table->boolean('is_public')->default(true);
            $table->timestamps();

            $table->index(['industry', 'city']);
        });

        Schema::create('supplier_reviews', function (Blueprint $table) {
            $table->id();
            $table->foreignId('client_id')->constrained('users')->cascadeOnDelete();
            $table->foreignId('supplier_id')->constrained('users')->cascadeOnDelete();
            $table->foreignId('order_id')->nullable()->constrained()->nullOnDelete();
            $table->unsignedTinyInteger('rating');
            $table->text('body')->nullable();
            $table->timestamps();

            $table->unique(['client_id', 'supplier_id', 'order_id']);
            $table->index(['supplier_id', 'rating']);
        });

        Schema::create('favorite_suppliers', function (Blueprint $table) {
            $table->id();
            $table->foreignId('client_id')->constrained('users')->cascadeOnDelete();
            $table->foreignId('supplier_id')->constrained('users')->cascadeOnDelete();
            $table->timestamps();

            $table->unique(['client_id', 'supplier_id']);
        });

        Schema::table('products', function (Blueprint $table) {
            $table->string('category')->nullable()->after('description');
            $table->unsignedInteger('moq')->default(1)->after('stock');
            $table->string('unit')->default('unit')->after('moq');
            $table->boolean('is_active')->default(true)->after('unit');
        });

        Schema::table('orders', function (Blueprint $table) {
            $table->foreignId('supplier_id')->nullable()->after('user_id')->constrained('users')->nullOnDelete();
            $table->foreignId('product_id')->nullable()->after('demande_id')->constrained()->nullOnDelete();
            $table->foreignId('offre_id')->nullable()->after('product_id')->constrained('offres')->nullOnDelete();
        });

        Schema::table('messages', function (Blueprint $table) {
            $table->string('attachment_path')->nullable()->after('body');
        });
    }

    public function down(): void
    {
        Schema::table('messages', function (Blueprint $table) {
            $table->dropColumn('attachment_path');
        });

        Schema::table('orders', function (Blueprint $table) {
            $table->dropConstrainedForeignId('offre_id');
            $table->dropConstrainedForeignId('product_id');
            $table->dropConstrainedForeignId('supplier_id');
        });

        Schema::table('products', function (Blueprint $table) {
            $table->dropColumn(['category', 'moq', 'unit', 'is_active']);
        });

        Schema::dropIfExists('favorite_suppliers');
        Schema::dropIfExists('supplier_reviews');
        Schema::dropIfExists('supplier_profiles');
    }
};
