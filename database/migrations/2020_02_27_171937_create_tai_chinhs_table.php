<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTaiChinhsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('tai_chinhs', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('hoc_vien_id')->unsigned()->index();
            $table->tinyInteger('tong_ngay_ngi');
            $table->tinyInteger('tong_ngay_co_mat');
            $table->string('thang');
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
        Schema::dropIfExists('tai_chinhs');
    }
}
