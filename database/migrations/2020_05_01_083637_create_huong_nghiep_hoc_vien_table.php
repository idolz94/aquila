<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateHuongNghiepHocVienTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('huong_nghiep_hoc_vien', function (Blueprint $table) {
            $table->increments('id');
            $table->unsignedInteger('hoc_vien_id')->unsigned()->index();
            $table->unsignedInteger('huong_nghiep_id')->unsigned()->index();
            $table->foreign('hoc_vien_id')->references('id')->on('hoc_viens')->onDelete('cascade');
            $table->foreign('huong_nghiep_id')->references('id')->on('huong_nghieps')->onDelete('cascade');
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
        Schema::dropIfExists('huong_nghiep_hoc_vien');
    }
}
