<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateQuaTrinhSuDungTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('qua_trinh_su_dung', function (Blueprint $table) {
            $table->Increments('id');
            $table->unsignedInteger('tinh_trang_nghien_id')->unsigned()->index();
            $table->string('lan_dau')->nullable();
            $table->text('ly_do')->nullable();
            $table->string('su_dung_hang_ngay')->nullable();
            $table->tinyInteger('ngay_may_lan')->nullable();
            $table->string('ham_luong_su_dung')->nullable();
            $table->string('khong_su_dung')->nullable();
            $table->string('da_dung_loai_nao')->nullable();
            $table->string('hinh_thuc_su_dung')->nullable();
            $table->string('su_dung_gan_nhat')->nullable();
            $table->foreign('tinh_trang_nghien_id')->references('id')->on('tinh_trang_nghien')->onDelete('cascade');
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
        Schema::dropIfExists('qua_trinh_su_dung');
    }
}
