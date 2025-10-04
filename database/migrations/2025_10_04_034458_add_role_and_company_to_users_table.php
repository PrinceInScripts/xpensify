<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('users', function (Blueprint $table) {
            $table->enum('role', ['admin', 'employee', 'manager', 'finance', 'director', 'cfo'])
                  ->default('employee')
                  ->after('password');

            $table->unsignedBigInteger('company_id')->nullable()->after('role');
            $table->unsignedBigInteger('manager_id')->nullable()->after('company_id');

            $table->foreign('company_id')->references('id')->on('companies')->onDelete('cascade');
            $table->foreign('manager_id')->references('id')->on('users')->onDelete('set null');
        });
    }

    public function down(): void
    {
        Schema::table('users', function (Blueprint $table) {
            $table->dropForeign(['company_id']);
            $table->dropForeign(['manager_id']);
            $table->dropColumn(['role', 'company_id', 'manager_id']);
        });
    }
};
