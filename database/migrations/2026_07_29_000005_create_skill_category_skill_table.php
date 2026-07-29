<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('skill_category_skill', function (Blueprint $table): void {
            $table->foreignId('skill_category_id')->constrained()->cascadeOnDelete();
            $table->foreignId('skill_id')->constrained()->cascadeOnDelete();
            $table->unsignedInteger('sort_order')->default(0);
            $table->unique(['skill_category_id', 'skill_id']);
        });

        DB::table('skills')
            ->whereNotNull('skill_category_id')
            ->orderBy('id')
            ->get(['skill_category_id', 'id', 'sort_order'])
            ->each(function (object $skill): void {
                DB::table('skill_category_skill')->insert([
                    'skill_category_id' => $skill->skill_category_id,
                    'skill_id' => $skill->id,
                    'sort_order' => $skill->sort_order,
                ]);
            });
    }

    public function down(): void
    {
        Schema::dropIfExists('skill_category_skill');
    }
};
