<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateNguoiBaoHosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('nguoi_bao_hos', function (Blueprint $table) {
            $table->tinyIncrements('id');
            $table->string('ten');
            $table->string('email')->nullable();
            $table->string('password');
            $table->string('so_dien_thoai', 15);
            $table->string('quan_he_hoc_vien')->nullable();
            $table->rememberToken();
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
        Schema::dropIfExists('nguoi_bao_hos');
    }
}
