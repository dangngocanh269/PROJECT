<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class GiaoVien extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('giaovien', function (Blueprint $table) {
            $table->increments('id');
            $table->string('magv');
            $table->string('hoten');
            $table->string('hoten_slug');
            $table->string('email')->nullable();
            $table->integer('SDT')->nullable();
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
        //
    }
}
