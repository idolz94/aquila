<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateGiaoViensTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('giao_viens', function (Blueprint $table) {
            $table->increments('id');
            $table->string('ten')->unique();
            $table->string('email');
            $table->unsignedInteger('he_phai_id')->unsigned()->index();
            $table->unsignedInteger('chuc_vu_id')->unsigned()->index();
            $table->string('quoc_gia');
            $table->date('ngay_sinh');
            $table->string('doi_tac')->nullable();
            $table->string('so_dien_thoai');
            $table->text('anh_dai_dien')->nullable();
            $table->text('nguoi_gioi_thieu')->nullable();
            $table->string('ghi_chu')->nullable();
            $table->foreign('he_phai_id')->references('id')->on('he_phais')->onDelete('cascade');
            $table->foreign('chuc_vu_id')->references('id')->on('chuc_vus')->onDelete('cascade');
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
        Schema::dropIfExists('giao_viens');
    }
}
