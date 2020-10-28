<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreatePhongsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('phongs', function (Blueprint $table) {
            $table->increments('id');
            $table->string('ten_phong')->unique();
            $table->string('vi_tri');
            $table->string('ten_truong_phong')->nullable();
            $table->string('ghi_chu')->nullable();
            $table->date('ngay_ghi_chu')->nullable();
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
        Schema::dropIfExists('phongs');
    }
}
