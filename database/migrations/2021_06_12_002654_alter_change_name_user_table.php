<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AlterChangeNameUserTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::rename('prodi', 'prodis');
        Schema::table('users', function (Blueprint $table) {
            $table->dropForeign(['prodi']);
        });
        Schema::table('users', function (Blueprint $table) {
            $table->foreign('prodi')->references('id')->on('prodis');
         });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        
        Schema::table('users', function (Blueprint $table) {
            $table->dropForeign(['prodi']);
        });
        Schema::rename('prodis', 'prodi');
    }
}
