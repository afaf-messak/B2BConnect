<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('users', function (Blueprint $table) {
            $table->string('avatar')->nullable()->after('email');
            $table->string('ice')->nullable()->after('company_name');
            $table->string('account_status')->default('active')->after('role');
            $table->boolean('onboarding_completed')->default(false)->after('account_status');
        });

        DB::table('users')->update([
            'onboarding_completed' => true,
            'account_status' => 'active',
        ]);

        Schema::table('users', function (Blueprint $table) {
            $table->string('role')->nullable()->default(null)->change();
        });
    }

    public function down(): void
    {
        Schema::table('users', function (Blueprint $table) {
            $table->string('role')->default('client')->nullable(false)->change();
            $table->dropColumn(['avatar', 'ice', 'account_status', 'onboarding_completed']);
        });
    }
};
