<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateSoLanCaiNghienTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('so_lan_cai_nghien', function (Blueprint $table) {
            $table->Increments('id');
            $table->unsignedInteger('tinh_trang_nghien_id')->unsigned()->index();
            $table->tinyInteger('lan_cai_nghien')->nullable();
            $table->string('lan_thu_nhat')->nullable();
            $table->string('thoi_gian_lan_thu_nhat')->nullable();
            $table->string('phuong_phap_lan_thu_nhat')->nullable();
            $table->string('ly_do_tai_nghien_lan_thu_nhat')->nullable();
            $table->string('lan_thu_hai')->nullable();
            $table->string('thoi_gian_lan_thu_hai')->nullable();
            $table->string('phuong_phap_lan_thu_hai')->nullable();
            $table->string('ly_do_tai_nghien_lan_thu_hai')->nullable();
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
        Schema::dropIfExists('so_lan_cai_nghien');
    }
}
