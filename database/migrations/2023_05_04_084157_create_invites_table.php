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
        Schema::create('invites', function (Blueprint $table) {
            $table->id();
            $table->String('nomInv');
            $table->String('telephoneInv');
            $table->String('emailInv');
            $table->String('nbreInv');
            $table->String('codeInv');
            $table->String('qrCodeInv');
            $table->bigInteger('evn_id')->unsigned();
            $table->foreign('evn_id')->references('id')->on('evenements');
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
        Schema::dropIfExists('invites');
    }
};
