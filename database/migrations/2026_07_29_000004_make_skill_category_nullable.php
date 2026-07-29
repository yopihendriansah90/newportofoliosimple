<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('skills', function (Blueprint $table): void {
            $table->dropForeign(['skill_category_id']);
            $table->unsignedBigInteger('skill_category_id')->nullable()->change();
            $table->foreign('skill_category_id')->references('id')->on('skill_categories')->nullOnDelete();
        });
    }

    public function down(): void
    {
        Schema::table('skills', function (Blueprint $table): void {
            $table->dropForeign(['skill_category_id']);
            $table->unsignedBigInteger('skill_category_id')->nullable(false)->change();
            $table->foreign('skill_category_id')->references('id')->on('skill_categories')->cascadeOnDelete();
        });
    }
};
