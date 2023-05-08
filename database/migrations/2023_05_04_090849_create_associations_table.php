<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('associations', function (Blueprint $table) {
            $table->id();
            $table->bigInteger('hote_id')->unsigned();
            $table->foreign('hote_id')->references('id')->on('hotesses');
            $table->bigInteger('ivn_table_id')->unsigned();
            $table->foreign('ivn_table_id')->references('id')->on('ivn_tables');



            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('associations');
    }
};
