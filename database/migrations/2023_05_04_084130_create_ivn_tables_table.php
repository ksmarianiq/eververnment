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
        Schema::create('ivn_tables', function (Blueprint $table) {
            $table->id();
            $table->String('nomTableInv')->nullable();
            $table->String('nbrePlaceInv')->nullable();
            $table->text('descriptionTableInv')->nullable();
            $table->bigInteger('evn_id')->unsigned()->nullable();
            $table->foreign('evn_id')->references('id')->on('evenements');
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
        Schema::dropIfExists('ivn_tables');
    }
};
