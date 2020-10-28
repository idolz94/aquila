<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateDiemMonHocsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('diem_mon_hocs', function (Blueprint $table) {
            $table->increments('id');
            $table->unsignedInteger('lop_hoc_id')->unsigned()->index();
            $table->unsignedInteger('hoc_vien_id')->unsigned()->index();
            $table->char('diem')->nullable();
            $table->unsignedInteger('ly_do_id')->unsigned()->index();
            $table->foreign('hoc_vien_id')->references('id')->on('hoc_viens')->onDelete('cascade');
            $table->foreign('lop_hoc_id')->references('id')->on('lop_hocs')->onDelete('cascade');
            $table->foreign('ly_do_id')->references('id')->on('ly_do_diem')->onDelete('cascade');
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
        Schema::dropIfExists('diem_mon_hocs');
    }
}
