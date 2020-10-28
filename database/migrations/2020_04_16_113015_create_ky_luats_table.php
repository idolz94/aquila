<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateKyLuatsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('ky_luats', function (Blueprint $table) {
            $table->increments('id');
            $table->unsignedInteger('hoc_vien_id')->unsigned()->index();
            $table->date('ngay')->nullable();
            $table->string('ghi_chu')->nullable();
            $table->text('ly_do')->nullable();
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
        Schema::dropIfExists('ky_luats');
    }
}
