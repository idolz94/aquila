<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateSucKhoeToanThanTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('suc_khoe_toan_than', function (Blueprint $table) {
            $table->Increments('id');
            $table->unsignedInteger('kham_suc_khoe_id')->unsigned()->index();
            $table->text('toan_than')->nullable();
            $table->text('mach')->nullable();
            $table->text('huyet_ap')->nullable();
            $table->text('nhiet_do')->nullable();
            $table->text('can_nang')->nullable();
            $table->text('nhip_tho')->nullable();
            $table->foreign('kham_suc_khoe_id')->references('id')->on('kham_suc_khoes')->onDelete('cascade');
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
        Schema::dropIfExists('suc_khoe_toan_than');
    }
}
