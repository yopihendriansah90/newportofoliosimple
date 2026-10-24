<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        if (Schema::hasColumn('profiles', 'cv_path')) {
            Schema::table('profiles', function (Blueprint $table): void {
                $table->dropColumn('cv_path');
            });
        }

        if (Schema::hasTable('site_settings')) {
            DB::table('site_settings')->where('key', 'download_cv_label')->delete();
        }
    }

    public function down(): void
    {
        if (! Schema::hasColumn('profiles', 'cv_path')) {
            Schema::table('profiles', function (Blueprint $table): void {
                $table->string('cv_path')->nullable();
            });
        }
    }
};
