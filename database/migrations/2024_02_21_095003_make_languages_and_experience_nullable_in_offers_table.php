<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class MakeLanguagesAndExperienceNullableInOffersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('company_offers', function (Blueprint $table) {
            $table->text('languages')->nullable()->change();
            $table->text('experience')->nullable()->change();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('company_offers', function (Blueprint $table) {
            $table->text('languages')->nullable(false)->change();
            $table->text('experience')->nullable(false)->change();
        });
    }
}
