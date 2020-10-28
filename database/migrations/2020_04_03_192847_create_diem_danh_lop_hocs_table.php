<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateDiemDanhLopHocsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('diem_danh_lop_hocs', function (Blueprint $table) {
            $table->increments('id');
            $table->unsignedInteger('lop_hoc_id')->unsigned()->index();
            $table->unsignedInteger('hoc_vien_id')->unsigned()->index();
            $table->tinyInteger('ca_hoc')->unsigned()->index();
            $table->string('ngay')->nullable();
            $table->foreign('lop_hoc_id')->references('id')->on('lop_hocs')->onDelete('cascade');
            $table->foreign('hoc_vien_id')->references('id')->on('hoc_viens')->onDelete('cascade');
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
        Schema::dropIfExists('diem_danh_lop_hocs');
    }
}
