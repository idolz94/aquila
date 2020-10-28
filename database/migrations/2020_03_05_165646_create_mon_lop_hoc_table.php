<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateMonLopHocTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('mon_lop_hoc', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('mon_hoc_id')->unsigned();
            $table->integer('lop_hoc_id')->unsigned();
            $table->foreign('mon_hoc_id')->references('id')->on('mon_hocs')->onDelete('cascade');
            $table->foreign('lop_hoc_id')->references('id')->on('lop_hocs')->onDelete('cascade');
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
        Schema::dropIfExists('mon_lop_hoc');
    }
}
