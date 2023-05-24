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
        Schema::create('programmes', function (Blueprint $table) {
            $table->id();
            $table->String('libProg')->nullable();
            $table->String('dateProg')->nullable();
            $table->String('heureProg')->nullable();
            $table->String('lieuProg')->nullable();
            $table->text('descriptionProg')->nullable();
            $table->String('longitude')->nullable();
            $table->String('latitude')->nullable();
            $table->String('codeProg')->nullable();
            $table->String('qrCodeProg')->nullable();
            $table->bigInteger('evn_id')->unsigned()->nullable();
            $table->foreign('evn_id')->references('id')->on('evenements')->nullable();
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
        Schema::dropIfExists('programmes');
    }
};
