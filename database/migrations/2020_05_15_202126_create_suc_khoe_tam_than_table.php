<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateSucKhoeTamThanTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('suc_khoe_tam_than', function (Blueprint $table) {
            $table->Increments('id');
            $table->unsignedInteger('kham_suc_khoe_id')->unsigned()->index();
            $table->text('bieu_hien_chung')->nullable();
            $table->text('bieu_hien_khac')->nullable();
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
        Schema::dropIfExists('suc_khoe_tam_than');
    }
}
