<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class RenameLanguagesToLanguagesRequiredInCompanyOffersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('company_offers', function (Blueprint $table) {
            $table->text('languages_required')->nullable()->after('languages');
        });

        DB::table('company_offers')->update(['languages_required' => DB::raw('languages')]);

        Schema::table('company_offers', function (Blueprint $table) {
            $table->dropColumn('languages');
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
            $table->text('languages')->nullable()->after('languages_required');
        });

        DB::table('company_offers')->update(['languages' => DB::raw('languages_required')]);

        Schema::table('company_offers', function (Blueprint $table) {
            $table->dropColumn('languages_required');
        });
    }
}
