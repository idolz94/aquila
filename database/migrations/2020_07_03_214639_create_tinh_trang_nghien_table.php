<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTinhTrangNghienTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('tinh_trang_nghien', function (Blueprint $table) {
            $table->Increments('id');
            $table->unsignedInteger('hoc_vien_id')->unsigned()->index();
            $table->text('cac_benh_kem_theo')->nullable();
            $table->text('thuong_xuyen_su_dung')->nullable();
            $table->text('co_dia_di_ung')->nullable();
            $table->text('gia_dinh_ai_nghien')->nullable();
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
        Schema::dropIfExists('tinh_trang_nghien');
    }
}
