<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateNgayHocViensTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('ngay_hoc_viens', function (Blueprint $table) {
            $table->increments('id');
            $table->unsignedInteger('hoc_vien_id')->unsigned()->index();
            $table->date('ngay_tron');
            $table->date('ngay_tro_lai');
            $table->text('noi_dung');
            $table->tinyInteger('ly_do');
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
        Schema::dropIfExists('ngay_hoc_viens');
    }
}
