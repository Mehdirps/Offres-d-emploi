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
        Schema::table('company_offers', function (Blueprint $table) {
            $table->string('city');
            $table->string('location');
            $table->text('experience');
            $table->text('languages');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('company_offers', function (Blueprint $table) {
            $table->dropColumn('city');
            $table->dropColumn('location');
            $table->dropColumn('experience');
            $table->dropColumn('languages');
        });
    }
};
