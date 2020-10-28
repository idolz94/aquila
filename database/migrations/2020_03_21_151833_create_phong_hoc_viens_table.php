<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreatePhongHocViensTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('phong_hoc_viens', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('phong_id')->unsigned();
            $table->integer('hoc_vien_id')->unsigned();
            $table->string('ly_do')->nullable();
            $table->tinyInteger('type')->default(1);
            $table->foreign('phong_id')->references('id')->on('phongs')->onDelete('cascade');
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
        Schema::dropIfExists('phong_hoc_viens');
    }
}
