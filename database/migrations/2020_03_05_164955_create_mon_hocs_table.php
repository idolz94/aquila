<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateMonHocsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('mon_hocs', function (Blueprint $table) {
            $table->increments('id');
            $table->string('mon_hoc')->unique();
            $table->unsignedInteger('bo_mon_id')->unsigned()->index();
            $table->string('nhan_xet')->nullable();
            $table->string('ghi_chu')->nullable();
            $table->tinyInteger('loai_hinh');
            $table->tinyInteger('giai_doan');
            $table->tinyInteger('do_kho');
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
        Schema::dropIfExists('mon_hocs');
    }
}
