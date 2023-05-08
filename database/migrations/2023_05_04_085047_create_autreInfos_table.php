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
        Schema::create('autreInfos', function (Blueprint $table) {
            $table->id();
            $table->String('titre');
            $table->String('infCheckBox');
            $table->String('codeAutre');
            $table->String('qrCodeAutre');
            $table->bigInteger('evn_id')->unsigned();
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
        Schema::dropIfExists('autreInfos');
    }
};
