<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateSuKiensTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('su_kiens', function (Blueprint $table) {
            $table->increments('id');
            $table->string('ten')->unique();
            $table->date('ngay_bat_dau');
            $table->date('ngay_ket_thuc');
            $table->text('noi_dung')->nullable();
            $table->text('ket_qua')->nullable();
            $table->string('ma_mau')->default('#007bff');
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
        Schema::dropIfExists('su_kiens');
    }
}
