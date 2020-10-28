<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateNhomsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('nhoms', function (Blueprint $table) {
            $table->increments('id');
            $table->string('ten')->unique();
            $table->unsignedInteger('truong_nhom_id')->unsigned()->index();
            $table->date('ngay_bat_dau');
            $table->date('ngay_ket_thuc')->nullable();;
            $table->text('ghi_chu')->nullable();
            $table->string('ket_qua')->nullable();
            $table->unsignedInteger('nhom_cha_id')->unsigned()->index()->nullable();
            $table->foreign('truong_nhom_id')->references('id')->on('hoc_viens')->onDelete('cascade');
            $table->foreign('nhom_cha_id')->references('id')->on('nhom_chas')->onDelete('cascade');
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
        Schema::dropIfExists('nhoms');
    }
}
