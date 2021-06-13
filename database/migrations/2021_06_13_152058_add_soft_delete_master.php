<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddSoftDeleteMaster extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('prodis', function (Blueprint $table) {
            $table->softDeletes();
         });
         Schema::table('labs', function (Blueprint $table) {
            $table->softDeletes();
         });
         Schema::table('modules', function (Blueprint $table) {
            $table->softDeletes();
         });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        //
    }
}
