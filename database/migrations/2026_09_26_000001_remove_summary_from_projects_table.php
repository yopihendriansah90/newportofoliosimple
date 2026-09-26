<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        DB::table('projects')
            ->whereNull('description')
            ->whereNotNull('summary')
            ->update(['description' => DB::raw('summary')]);

        Schema::table('projects', function (Blueprint $table) {
            $table->dropColumn('summary');
        });
    }

    public function down(): void
    {
        Schema::table('projects', function (Blueprint $table) {
            $table->string('summary')->nullable();
        });
    }
};
