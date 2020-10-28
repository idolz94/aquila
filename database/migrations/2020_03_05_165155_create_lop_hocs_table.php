<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateLopHocsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('lop_hocs', function (Blueprint $table) {
            $table->increments('id');
            $table->string('ma_lop_hoc')->unique();;
            $table->unsignedInteger('giao_vien_id')->unsigned()->index();
            $table->date('ngay_bat_dau');
            $table->date('ngay_ket_thuc');
            $table->string('ghi_chu')->nullable();
            $table->foreign('giao_vien_id')->references('id')->on('giao_viens')->onDelete('cascade');
            $table->integer('mon_hoc_id')->unsigned()->index();
            $table->foreign('mon_hoc_id')->references('id')->on('mon_hocs')->onDelete('cascade');
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
        Schema::dropIfExists('lop_hocs');
    }
}
