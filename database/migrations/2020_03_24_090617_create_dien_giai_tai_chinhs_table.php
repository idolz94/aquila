<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateDienGiaiTaiChinhsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('dien_giai_tai_chinhs', function (Blueprint $table) {
            $table->increments('id');
            $table->string('ten_dien_giai');
            $table->tinyInteger('thu_chi')->nullable();
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
        Schema::dropIfExists('dien_giai_tai_chinhs');
    }
}
