<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateHocViensTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('hoc_viens', function (Blueprint $table) {
            $table->increments('id');
            $table->unsignedInteger('nguoi_bao_ho_id')->unsigned()->index();
            $table->string('ma_hoc_vien');
            $table->string('ten');
            $table->string('dia_chi')->nullable();
            $table->string('ngay_vao')->nullable();
            $table->string('ngay_tot_nghiep')->nullable();
            $table->string('ngay_sinh')->nullable();
            $table->string('gioi_tinh')->nullable();
            $table->string('so_cmnd')->nullable();
            $table->date('ngay_cap_cmnd')->nullable();
            $table->string('noi_cap_cmnd')->nullable();
            $table->string('trinh_do_van_hoa')->nullable();
            $table->string('hon_nhan')->nullable();
            $table->string('vo_chong')->nullable();
            $table->string('con_1')->nullable();
            $table->string('con_2')->nullable();
            $table->string('nghe_nghiep')->nullable();
            $table->string('tien_su_benh_ly')->nullable();
            $table->string('tinh_trang')->nullable();
            $table->tinyInteger('tien_an')->nullable();
            $table->string('ve_toi_tien_an')->nullable();
            $table->tinyInteger('tien_su')->nullable();
            $table->string('ve_toi_tien_su')->nullable();
            $table->string('ma_tuy_su_dung')->nullable();
            $table->string('hinh_thuc_su_dung')->nullable();
            $table->integer('chieu_cao')->nullable();
            $table->integer('can_nang')->nullable();
            $table->decimal('tai_chinh_con_lai',25,2)->nullable();
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
        Schema::dropIfExists('hoc_viens');
    }
}
