<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateSucKhoeCoQuanTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('suc_khoe_co_quan', function (Blueprint $table) {
            $table->Increments('id');
            $table->unsignedInteger('kham_suc_khoe_id')->unsigned()->index();
            $table->text('ho_hap')->nullable();
            $table->text('tuan_hoan')->nullable();
            $table->text('tieu_hoa')->nullable();
            $table->text('tiet_nieu_sinh_duc')->nullable();
            $table->text('mat')->nullable();
            $table->foreign('kham_suc_khoe_id')->references('id')->on('kham_suc_khoes')->onDelete('cascade');
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
        Schema::dropIfExists('suc_khoe_co_quan');
    }
}
