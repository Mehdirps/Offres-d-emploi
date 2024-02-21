<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::table('company', function (Blueprint $table) {
            $table->text('description')->nullable()->change();
            $table->text('logo')->nullable()->change();
            $table->text('banner')->nullable()->change();

        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('company', function (Blueprint $table) {
            $table->text('description')->nullable(false)->change();
            $table->text('logo')->nullable(false)->change();
            $table->text('banner')->nullable(false)->change();
        });
    }
};
