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
            $table->String('nomInv')->nullable();
            $table->String('telephoneInv')->nullable();
            $table->String('emailInv')->nullable();
            $table->String('nbreInv')->nullable();
            $table->String('codeInv')->unique()->nullable();
            $table->String('qrCodeInv')->nullable();
            $table->bigInteger('evn_id')->unsigned();
            $table->foreign('evn_id')->references('id')->on('evenements')->nullable();
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
