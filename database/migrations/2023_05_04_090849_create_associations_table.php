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
            $table->bigInteger('hote_id')->unsigned()->nullable();
            $table->foreign('hote_id')->references('id')->on('hotesses')->nullable();;
            $table->bigInteger('ivn_table_id')->unsigned()->nullable();
            $table->foreign('ivn_table_id')->references('id')->on('ivn_tables')->nullable();;

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
