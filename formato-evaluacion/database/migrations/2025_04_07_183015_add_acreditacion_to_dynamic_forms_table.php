<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::table('dynamic_forms', function (Blueprint $table) {
            $table->text('acreditacion')->nullable()->after('table_data');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('dynamic_forms', function (Blueprint $table) {
            $table->dropColumn('acreditacion');
        });
    }
};