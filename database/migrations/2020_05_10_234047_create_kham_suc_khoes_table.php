<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateKhamSucKhoesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('kham_suc_khoes', function (Blueprint $table) {
            $table->Increments('id');
            $table->unsignedInteger('hoc_vien_id')->unsigned()->index();
            $table->text('noi_dung')->nullable();
            $table->text('test_nhanh')->nullable();
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
        Schema::dropIfExists('kham_suc_khoes');
    }
}
