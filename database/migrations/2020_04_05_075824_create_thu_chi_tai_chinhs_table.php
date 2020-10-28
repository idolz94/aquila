<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateThuChiTaiChinhsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('thu_chi_tai_chinhs', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('tai_chinh_id')->unsigned()->index();
            $table->integer('dien_giai_tai_chinh_id')->unsigned()->index();
            $table->decimal('thu',20,0)->nullable();
            $table->decimal('chi',20,0)->nullable();
            $table->string('ghi_chu')->nullable();
            $table->foreign('tai_chinh_id')->references('id')->on('tai_chinhs')->onDelete('cascade');
            $table->foreign('dien_giai_tai_chinh_id')->references('id')->on('dien_giai_tai_chinhs')->onDelete('cascade');
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
        Schema::dropIfExists('thu_chi_tai_chinhs');
    }
}
