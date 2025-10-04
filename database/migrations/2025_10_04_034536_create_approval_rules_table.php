<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('approval_rules', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('company_id');
            $table->enum('rule_type', ['sequential', 'percentage', 'specific', 'hybrid'])->default('sequential');
            $table->integer('percentage_threshold')->nullable(); // e.g. 60
            $table->string('specific_role')->nullable(); // e.g. CFO
            $table->json('sequence')->nullable(); // ["manager","finance","director"]
            $table->timestamps();

            $table->foreign('company_id')->references('id')->on('companies')->onDelete('cascade');
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('approval_rules');
    }
};
