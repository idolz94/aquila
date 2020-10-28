<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateThoiKhoaBieusTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('thoi_khoa_bieus', function (Blueprint $table) {
            $table->increments('id');
            $table->string('sang')->nullable();
            $table->string('chieu')->nullable();
            $table->string('ngay');
            $table->unsignedInteger('lop_hoc_id')->unsigned()->index();
            $table->foreign('lop_hoc_id')->references('id')->on('lop_hocs')->onDelete('cascade');
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
        Schema::dropIfExists('thoi_khoa_bieus');
    }
}
